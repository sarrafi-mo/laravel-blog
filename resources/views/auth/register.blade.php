@extends('layouts.app')

@section('content')
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('email.verify.submit') }}">
                            @csrf
                            @if ($errors->has('register'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('register') }}</strong>
                                </span>
                            @endif
                            <div class="mb-3 d-none">
                                <label for="username" class="form-label">Username</label>
                                <input id="username" type="text" class="form-control" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required>
                            </div>
                            @if ($errors->has('login'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('login') }}</strong>
                                </span>
                            @endif
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">Verify Email</button>
                            </div>

                            <div class="mt-3 text-center">
                                <p>Already have an account? <a href="{{ route('login') }}">Login Here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
