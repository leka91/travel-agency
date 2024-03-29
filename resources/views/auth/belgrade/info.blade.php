@extends('auth.admin-index')

@section('title', 'Belgrade Information')

@section('links')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endsection

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

    <div class="form-group @error('meta_keywords') has-error @enderror">
        <label for="meta_keywords">
            SEO keywords
            <small>
                <em>
                    (Preferebly up to 10 words)
                </em>
            </small>
            <sup class="text-danger">*</sup>
        </label>
        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $belgrade->meta_keywords ?? old('meta_keywords') }}">

        @error('meta_keywords')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
    </div>

    <div class="form-group @error('meta_description') has-error @enderror">
        <label for="meta_description">
            SEO description
            <small>
                <em>
                    (A brief description of Belgrade)
                </em>
            </small>
            <sup class="text-danger">*</sup>
        </label>
        <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ $belgrade->meta_description ?? old('meta_description') }}">

        @error('meta_description')
            <strong>
                <span class="text-danger">
                    {{ $message }}
                </span>
            </strong>
        @enderror
    </div>

    <div class="form-group">
        <label for="belgradeimage">
            Belgrade image
            @if (!$belgrade)
            <sup class="text-danger">*</sup>
            @endif
        </label>
        <input type="file" id="belgradeimage" name="belgradeimage" class="filepond" data-max-file-size="1MB">
        <p class="help-block">Upload Belgrade image</p>

        @error('belgradeimage')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
    </div>

    @if ($belgrade)
    <div class="form-group">
        <img width="700" src="{{ $belgrade->belgradeImage() }}" alt="Belgrade" class="img-thumbnail">
    </div>
    @endif

    <div class="form-group">
        <label for="description">
            Description
            <small>
                <em>
                    (Includes about and Belgrade quotes)
                </em>
            </small>
            <sup class="text-danger">*</sup>
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
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

<script src="{{ asset('js/ckeditor5.js') }}"></script>
<script src="{{ asset('js/filepond.js') }}"></script>
@endsection
