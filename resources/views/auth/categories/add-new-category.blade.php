@extends('auth.admin-index')

@section('title', 'Add new category')

@section('content')

<h2>Add new category</h2>

<div class="page-header"></div>

@component('auth.components.status.success')
@endcomponent

<form method="POST" action="{{ route('admin.addNewCategory') }}">
    @csrf
    <div class="form-group @error('name') has-error @enderror">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">

        @error('name')
        <span class="text-danger">
            <strong>
                {{ $message }}
            </strong>
        </span>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary mt">Save</button>
    <a href="{{ route('admin.categories') }}" class="btn btn-default mt">
        Back
    </a>
</form>

@endsection