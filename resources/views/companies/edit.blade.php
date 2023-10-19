@extends('layouts.app')

@section('content')
    <h1>Edit Company</h1>
    <form action="{{ route('companies.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $company->name }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="{{ $company->address }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $company->phone }}" required>
        </div>
        <!-- Add more fields here -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
