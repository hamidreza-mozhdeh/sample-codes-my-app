@extends('layouts.app-main')
@section('main-section-width', 6)

@section('main-section-content')
    <h1>Register</h1>
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
                           aria-describedby="emailHelp" placeholder="example@domain.com">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="emailConfirmationInput" class="form-label">Email address
                        confirmation</label>
                    <input type="email" name="email" class="form-control" id="emailConfirmationInput"
                           placeholder="Please retype email address">
                </div>
                <div class="mb-3">
                    <label for="firstNameInput" class="form-label">First name</label>
                    <input type="text" class="form-control" id="firstNameInput">
                </div>
                <div class="mb-3">
                    <label for="surnameInput" class="form-label">Surname</label>
                    <input type="text" class="form-control" id="shurnameInput">
                </div>
                <div class="mb-3">
                    <label for="passwordInput" class="form-label">Password</label>
                    <input type="password" class="form-control" id="passwordInput">
                </div>
                <div class="mb-3">
                    <label for="passwordConfirmationInput" class="form-label">Password confirmation</label>
                    <input type="password" class="form-control" id="passwordConfirmationInput">
                </div>
                <div class="mb-3">
                    <div class="g-recaptcha" data-sitekey="6LdFgF4UAAAAAJ0YEUW5JpthlyZVp1FIi3jXykIr"></div>
                </div>
                <div class="mb-3 mt-3">
                    <div class="form-text">
                        By registering, you agree with all our
                        <a href="#terms-and-conditions"
                           data-bs-toggle="tooltip" data-bs-placement="top" title="Just smile :-)"
                        >terms & conditions</a>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-lg mt-4 btn-primary" type="submit">Create Account</button>
                </div>
            </form>

        </div>
    </div>
@endsection
