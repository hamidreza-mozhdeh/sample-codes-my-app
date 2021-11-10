@extends('layouts.app-main')

@section('main-section-content')
    <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm float-end">Add a new client</a>
    <h1>Clients</h1>
    <p class="text-secondary">
        List of my clients
    </p>
    <hr>
    <table class="table table-hover">
        <thead class="table-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td scope="col">1</td>
            <td scope="col">
                <img src="#" class="img-thumbnail img-fluid" alt="">
                <a href="#" target="_blank">
                    <span>Hamidreza Mozhdeh</span>
                </a>
            </td>
            <td scope="col">hamidreza87m@gmail.com</td>
            <td scope="col">
                <a href="#" type="button" class="text-danger"><i data-feather="trash-2"></i></a>
                <a href="#" type="button" class="text-info"><i data-feather="edit"></i></a>
            </td>
        </tr>
        <tr>

        </tbody>
    </table>
@endsection
