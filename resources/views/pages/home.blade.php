@extends('layouts.app-main')
@section('main-section-width', 5)

@section('main-section-content')
    <h1>Welcome</h1>
    <p class="text-secondary">
        Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register.</a>
    </p>
    <hr>
@endsection
