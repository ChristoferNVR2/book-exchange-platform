@extends('layouts.app')

@section('title', 'Log In')

@section('content')

<div class="card auth-card">
    <div class="card-header">
        <i class="bi bi-box-arrow-in-right me-2"></i>Log In
    </div>
    <div class="card-body p-4">
        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                       required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 form-check">
                <input class="form-check-input" id="remember" name="remember" type="checkbox">
                <label class="form-check-label text-muted" for="remember">Remember me</label>
            </div>

            <button class="btn btn-be w-100 mb-3" type="submit">
                <i class="bi bi-box-arrow-in-right me-1"></i>Log In
            </button>

            <p class="text-center text-muted mb-0">
                Don't have an account?
                <a href="{{ route('register') }}">Register here</a>
            </p>
        </form>
    </div>
</div>

@endsection
