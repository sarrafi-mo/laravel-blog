<?php

namespace App\Mail\Services;

use App\Mail\VerificationCodeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class EmailVerificationService
{
    public function send(string $email, string $code): array
    {
        try {
            Mail::to($email)->send(new VerificationCodeEmail($code));

            return [
                'success' => true,
                'message' => 'Verification email sent successfully'
            ];

        } catch (Exception $e) {

            // Log email sending errors
            Log::error('verification email ERROR : ' . $e->getMessage());
            Session::forget(['verification_expires_at']);
            
            return [
                'success' => false,
                'message' => 'We encountered an issue sending the verification email.Please check your email address and try again. If the problem persists, contact support.'
            ];
        }
    }
}