@extends('layout')
@section('page-title', 'Blank Page')
@section('page-content')

<div class="form-head d-flex mb-sm-4 mb-3">
    <div class="me-auto">
        <h2 class="text-black font-w600">Blank Page</h2>
        <p class="mb-0">View / Add / Update / Blank Page</p>
    </div>
    <div>
        <a href="javascript:void(0)" class="btn btn-danger me-2 disabled" id="delete_button" data-bs-toggle="modal"
            data-bs-target=".bd-example-modal-lg"><i class="bx bx-trash"></i> Delete</a>
        <a href="#" class="btn btn-primary me-3"><i class='bx bx-plus-circle' ></i> New
            Blank Page</a>
    </div>
</div>


<div class="row">
    <h1>YOUR DATA HERE</h1>
</div> <!-- end row-->
@endsection