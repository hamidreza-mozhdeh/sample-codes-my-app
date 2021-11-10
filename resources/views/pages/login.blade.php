@extends('layouts.app-main')
@section('main-section-width', 6)

@section('main-section-content')
    <h1>Login to your account</h1>
    <p class="text-secondary">
        Don't have an account?
        <a href="{{ route('register') }}">Click here to register</a>.
    </p>
    <hr>
    <div class="row">
        <div class="col">
            <form>
                <div class="mb-3">
                    <label for="emailInput" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="emailInput"
                           aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="passwordInput" class="form-label">Password</label>
                    <input type="password" class="form-control" id="passwordInput">
                </div>
                <div class="mb-3">
                    <div class="g-recaptcha" data-sitekey="6LdFgF4UAAAAAJ0YEUW5JpthlyZVp1FIi3jXykIr"></div>
                </div>
                <div class="mb-3 mt-3">
                    <div class="form-text">
                        Forgot your password?
                        <a href="{{ route('forgot-password') }}">Click here to reset your password</a>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-lg mt-4 btn-primary" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
