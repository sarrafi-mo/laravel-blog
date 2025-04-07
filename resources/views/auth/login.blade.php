@extends('layouts.app')

@section('content')
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h4>Login</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf
                            @if ($errors->has('login'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('login') }}</strong>
                                </span>
                            @endif
                            <div class="mb-3 d-none">
                                <label for="username" class="form-label">Username</label>
                                <input id="username" type="text" class="form-control" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>

                            @if (session('login_attempts', 0) >= 2)
                                @livewire('captcha')
                                <input class="form-control mt-1" type="text" name="captcha" id="captcha" required
                                    placeholder="Solve the question to proceed.">
                            @endif

                            @if ($errors->has('captcha'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('captcha') }}</strong>
                                </span>
                            @endif

                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-success">Login</button>
                            </div>
                            <div class="mt-3 text-center">
                                <a href="#" class="text-danger">Forgot Your Password?</a>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer text-center">
                        <p>Don't have an account? <a href="{{ route('register') }}">Register Here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
