@extends('layouts.app')

@section('title', 'Students Details')
@section('content')


<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-3">
            <h2 class="mb-4 text-white">Students Details</h2>
            <div class="card bg-dark text-white mt-4">
                <div class="card-body border border-sucess rounded">
                    <h5 class="card-title"><strong>Name: </strong>{{ $student->name }}</h5>
                    <p class="card-text">Email: {{ $student->email }}</p>
                    <p class="card-text">Phone: {{ $student->phone }} </p>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
