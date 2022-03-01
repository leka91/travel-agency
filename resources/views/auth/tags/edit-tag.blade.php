@extends('auth.admin-index')

@section('title', 'Edit tag')

@section('content')

<h2>Edit tag</h2>

<div class="page-header"></div>

@component('auth.components.status.success')
@endcomponent

<form method="POST" action="{{ route('admin.editTag', $tag->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group @error('name') has-error @enderror">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ $tag->name ?? old('name') }}">

        @error('name')
        <span class="text-danger">
            <strong>
                {{ $message }}
            </strong>
        </span>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary mt">Save</button>
    <a href="{{ route('admin.tags') }}" class="btn btn-default mt">
        Back
    </a>
</form>

@endsection