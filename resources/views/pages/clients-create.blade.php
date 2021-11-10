@extends('layouts.app-main')

@section('main-section-content')
    <a href="{{ route('clients.index') }}" class="btn btn-primary btn-sm float-end">Clients list</a>
    <h1>Create a new client</h1>
    <p class="text-secondary">
        Don't worry, we will email you an excel file of your clients weekly to keep it safe.
    </p>
    <hr>
    <div class="row">
        <div class="col">
            <form method="post" action="" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="nameInput" class="form-label">Name</label>
                    <input type="name" name="text" class="form-control" id="nameInput"
                           aria-describedby="nameHelp">
                </div>
                <div class="mb-3">
                    <label for="emailInput" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="emailInput"
                           aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" name="image" id="formFile">
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-lg mt-4 btn-primary" type="submit">Add to clients</button>
                </div>
            </form>
        </div>
    </div>
@endsection
