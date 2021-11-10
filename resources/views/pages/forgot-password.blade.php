@extends('layouts.app-main')
@section('main-section-width', 6)

@section('main-section-content')
    <h1>Forgot password</h1>
    <p class="text-secondary">
        Already have an account?
        <a href="{{ route('login') }}">Click here to login</a>.
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
                    <div class="g-recaptcha" data-sitekey="6LdFgF4UAAAAAJ0YEUW5JpthlyZVp1FIi3jXykIr"></div>
                </div>
                <div class="mb-3 mt-3">
                    <div class="form-text">
                        If you had an account on this site, you will recive an email under 10 minutes. Please check your Inbox and Spam folder.
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-lg mt-4 btn-primary" type="submit">Reset my password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
