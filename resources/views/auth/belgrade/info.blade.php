@extends('auth.admin-index')

@section('title', 'Belgrade Information')

@section('content')

<h2>Belgrade Information</h2>

<div class="page-header"></div>

@component('auth.components.status.success')
@endcomponent

<form method="POST" action="{{ $belgrade ? route('admin.editBelgradeInfo', $belgrade->id) : route('admin.addBelgradeInfo') }}">
    @csrf

    @if ($belgrade)
    @method('PUT')
    @endif

    <div class="form-group">
        <label for="meta_keywords">
            <strong>SEO keywords</strong>
            <small>
                <em>
                    (Preferebly up to 10 words)
                </em>
            </small>
        </label>
        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $belgrade->meta_keywords ?? old('meta_keywords') }}">

        @error('meta_keywords')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="meta_description">
            <strong>SEO description</strong>
            <small>
                <em>
                    (A brief description of Belgrade)
                </em>
            </small>
        </label>
        <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ $belgrade->meta_description ?? old('meta_description') }}">

        @error('meta_description')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">
            <strong>Description</strong>
            <small>
                <em>
                    (Includes about and Belgrade quotes)
                </em>
            </small>
        </label>
        <textarea name="description" class="form-control" id="description">{{ $belgrade->description ?? old('description') }}</textarea>

        @error('description')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary mt">Save</button>
    <a href="{{ route('admin.getAlltours') }}" class="btn btn-default mt">
        Back
    </a>
</form>

@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>

<script src="{{ asset('js/ckeditor5.js') }}"></script>
@endsection
