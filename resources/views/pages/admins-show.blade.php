@extends('layouts.app-main')

@section('main-section-content')
    <h1>Admin Name</h1>
    <hr>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="..." class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Admin Name</h5>
                    <p class="card-text">Admin email</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="#" type="button" class="btn btn-sm btn-info text-white"><i data-feather="edit"></i>
                Edit</a>
            <a href="#" type="button" class="btn btn-sm btn-danger text-white"><i
                    data-feather="trash-2"></i> Delete</a>
        </div>
    </div>
@endsection
