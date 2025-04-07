<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Mail\VerificationCodeEmail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /* 
    Show login page or redirect if authenticated 
    */
    public function login()
    {
        if (auth()->check()) {
            return redirect()->intended('posts');
        }
        return view('auth.login');
    }

    /* 
    Handle login request with validation and captcha 
    */
    public function authenticate(Request $request)
    {
        if ($request->filled('username')) {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Add captcha validation if login attempts >= 2
        $validator->sometimes('captcha', 'required|captcha', function ($input) {
            return session('login_attempts', 0) >= 2;
        });

        if ($validator->fails()) {
            $this->check_login_session();
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt authentication
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            session()->forget('login_attempts');
            return redirect()->intended('posts');
        }

        // Increment failed attempt counter
        $this->check_login_session();
        return redirect()->back()->withErrors([
            'login' => 'The provided credentials are incorrect.',
        ])->withInput();
    }

    /* 
    Show registration page or redirect if authenticated 
    */
    public function register()
    {
        if (auth()->check()) {
            return redirect()->intended('posts');
        }
        return view('auth.register');
    }

    /* 
    Create new user after verification 
    */
    public function store(Request $request)
    {
        // Verify the code matches what was sent
        if ($request->verification_code !== session('verification_code')) {
            return redirect()->back()->withErrors([
                'verification_code' => 'The code you entered is incorrect. Please try again.',
            ])->withInput();
        }

        $user = User::create([
            'name' => session('name'),
            'email' => session('email'),
            'password' => Hash::make(session('password')),
        ]);

        Auth::login($user);

        return redirect()->route('posts.index');
    }

    /* 
    Send verification email with code 
    */
    public function verifyEmail(StoreUserRequest $request)
    {
        // Honeypot check
        if ($request->filled('username')) {
            abort(403);
        }

        // Check if verification is already in progress and not expired
        if (session()->has('verification_expires_at')) {
            if (now()->lt(session()->get('verification_expires_at'))) {
                return redirect()->route('email.verify');
            }
        }

        $validated = $request->validated();

        if (!$validated) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        // Generate 6-digit numeric code
        $verificationCode = $this->generateRandomCode(6);

        session([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'verification_code' => $verificationCode,
            'verification_expires_at' => now()->addMinutes(2)
        ]);

        // Send verification email
        try {
            Mail::to($request->email)->send(new VerificationCodeEmail($verificationCode));
            return redirect()->route('email.verify');

        } catch (Exception $e) {

            // Log email sending errors
            Log::error('verification email ERROR : ' . $e->getMessage());

            return redirect()->back()->withErrors([
                'register' => 'We encountered an issue sending the verification email.
                Please check your email address and try again. If the problem persists, contact support.',
            ])->withInput();
        }
    }

    /* 
    Show verification code entry page 
    */
    public function verifyEmailPage()
    {
        if (auth()->check()) {
            return redirect()->intended('posts');
        }
        
        if (session()->has('email')) {
            return view('auth.email_verify');
        } else {
            return view('auth.register');
        }
    }

    /* 
    Logout user and clear session 
    */
    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
    * Track failed login attempts
    */
    private function check_login_session()
    {
        if (session()->has('login_attempts')) {
            session()->increment('login_attempts');
        } else {
            session(['login_attempts' => 1]);
        }
    }

    /** 
    * Generate random numeric code
    */
    private function generateRandomCode($length = 6)
    {
        $characters = '0123456789';
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $code;
    }
}
