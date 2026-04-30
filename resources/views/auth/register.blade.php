@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="card auth-card">
    <div class="card-header">
        <i class="bi bi-person-plus me-2"></i>Create an Account
    </div>
    <div class="card-body p-4">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold" for="username">
                    Username <span class="text-danger">*</span>
                </label>
                <input class="form-control @error('username') is-invalid @enderror"
                       id="username" name="username" type="text"
                       placeholder="e.g. johndoe"
                       value="{{ old('username') }}"
                       required autocomplete="username"
                       minlength="3" maxlength="50">
                <div class="form-text">3–50 characters. Letters, numbers, and underscores only.</div>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" for="email">
                    Email address <span class="text-danger">*</span>
                </label>
                <input class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" type="email"
                       placeholder="you@example.com"
                       value="{{ old('email') }}"
                       required autocomplete="email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" for="password">
                    Password <span class="text-danger">*</span>
                </label>
                <input class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password" type="password"
                       placeholder="••••••••"
                       required autocomplete="new-password" minlength="8">
                <div class="form-text">Minimum 8 characters.</div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold" for="password_confirmation">
                    Confirm Password <span class="text-danger">*</span>
                </label>
                <input class="form-control"
                       id="password_confirmation" name="password_confirmation"
                       type="password" placeholder="••••••••"
                       required autocomplete="new-password">
            </div>

            <button class="btn btn-be w-100 mb-3" type="submit">
                <i class="bi bi-person-plus me-1"></i>Register
            </button>

            <p class="text-center text-muted mb-0">
                Already have an account?
                <a href="{{ route('login') }}">Log in here</a>
            </p>
        </form>
    </div>
</div>

@endsection
