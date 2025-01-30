<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            return redirect()->intended('posts');
        }
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        if ($request->filled('username')) {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $validator->sometimes('captcha', 'required|captcha', function ($input) {
            return session('login_attempts', 0) >= 2;
        });

        if ($validator->fails()) {
            $this->check_login_session();
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            session()->forget('login_attempts');
            return redirect()->intended('posts');
        }

        $this->check_login_session();
        return redirect()->back()->withErrors([
            'login' => 'The provided credentials are incorrect.',
        ])->withInput();
    }

    public function register()
    {
        if (auth()->check()) {
            return redirect()->intended('posts');
        }
        return view('auth.register');
    }

    public function store(StoreUserRequest $request)
    {
        if ($request->filled('username')) {
            abort(403);
        }

        $validated = $request->validated();

        if (!$validated) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->intended('posts');
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function check_login_session()
    {
        if (session()->has('login_attempts')) {
            session()->increment('login_attempts');
        } else {
            session(['login_attempts' => 1]);
        }
    }
}
