@extends('layouts.app')

@section('content')
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h4>Email Verification</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register.post') }}">
                            @csrf
                            @if ($errors->has('verification_code'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('verification_code') }}</strong>
                                </span>
                            @endif
                            <div class="mb-3">
                                <label for="verification_code" class="form-label">Please Enter the Code Sent to Your
                                    Email</label>
                                <input id="verification_code" type="text" class="form-control" name="verification_code"
                                    required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark" id="submitBtn" disabled>Create Account</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <p id="countdown" class="text-muted">Time remaining: 02:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="expires_at"
        value="{{ session('verification_expires_at') ? session('verification_expires_at')->timestamp * 1000 : '' }}">

    @php
        $isExpired = now()->gt(session('verification_expires_at'));
    @endphp

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            const expiresAtInput = document.getElementById('expires_at');
            const countdownElement = document.getElementById("countdown");
            const submitBtn = document.getElementById("submitBtn");
    
            // Parse expiration timestamp (convert to milliseconds)
            const expiresAt = expiresAtInput.value ? parseInt(expiresAtInput.value) : null;
    
            // Case 1: No expiration time found (immediately expired)
            if (!expiresAt) {
                countdownElement.textContent = "Verification code expired!";
                submitBtn.disabled = true;
            } 
            // Case 2: Valid expiration time exists
            else {
                // Initial state while calculating
                countdownElement.textContent = "Calculating time...";
                submitBtn.disabled = true;
    
                // Timer update function (runs every second)
                const updateTimer = () => {
                    const now = new Date().getTime();
                    const distance = expiresAt - now; // ms remaining
    
                    // Handle expired case
                    if (distance <= 0) {
                        countdownElement.textContent = "Verification code expired!";
                        submitBtn.disabled = true;
                        clearInterval(countdownInterval);
                        return;
                    }
    
                    // Calculate minutes and seconds
                    const minutes = Math.floor(distance / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
                    // Update display
                    countdownElement.textContent = 
                        `Time remaining: ${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                    
                    // Only enable submit button when time is valid
                    submitBtn.disabled = false;
                };
    
                // Run immediately (no 1s delay on first run)
                updateTimer();
                
                // Set up recurring interval (every second)
                const countdownInterval = setInterval(updateTimer, 1000);
            }
        });
    </script>
@endsection
