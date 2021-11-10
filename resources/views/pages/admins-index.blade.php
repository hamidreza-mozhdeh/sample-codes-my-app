@extends('layouts.app-main')

@section('main-section-content')
    <a href="{{ route('register') }}" class="btn btn-primary btn-sm float-end">Add a new admin</a>
    <h1>Admins</h1>
    <p class="text-secondary">
        List of my admins
    </p>
    <hr>
    <table class="table table-hover">
        <thead class="table-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td scope="col">1</td>
            <td scope="col">
                <a href="#" target="_blank">
                    Hamidreza
                </a>
            </td>
            <td scope="col">Mozhdeh</td>
            <td scope="col">hamidreza87m@gmail.com</td>
            <td scope="col">
                <i class="text-dark" data-feather="user-check"></i>
                <i class="text-dark" data-feather="user-x"></i>
            </td>
            <td scope="col">
                <a href="#" type="button" class="text-danger"><i data-feather="trash-2"></i></a>
                <a href="#" type="button" class="text-info"><i data-feather="edit"></i></a>
            </td>
        </tr>
        <tr>

        </tbody>
    </table>
@endsection
