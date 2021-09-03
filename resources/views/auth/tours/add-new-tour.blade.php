@extends('auth.admin-index')

@section('title', 'Add new Tour')

@section('content')

<h2>Add new Tour</h2>

<div class="page-header"></div>

{{-- @if ($errors->all())
    <div class="alert alert-danger alert-dismissible" role="alert">
        @foreach ($errors->all() as $message)
            <p>
                {{ $message }}
            </p>
        @endforeach
    </div>
@endif --}}

<form method="POST" action="{{ route('admin.addNewTour') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="category">Choose tour category</label>
        <select class="form-control" name="category_id" id="category">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
            @endforeach
        </select>

        @error('category_id')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Enter title">

        @error('title')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="subtitle">Subtitle</label>
        <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="Enter subtitle">

        @error('subtitle')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="steps">Steps</label>
        <textarea name="steps" class="form-control" rows="3" id="steps" placeholder="Step by step"></textarea>
    </div>

    <div class="form-group">
        <label for="about">About</label>
        <textarea name="about" class="form-control" rows="3" id="about" placeholder="What is it about?"></textarea>
    </div>

    <div class="form-group">
        <label for="concept">Concept</label>
        <textarea name="concept" class="form-control" rows="3" id="concept" placeholder="What is the concept?"></textarea>
    </div>

    <div class="form-group">
        <label for="requirements">Tour requirements</label>
        <select class="form-control" name="requirements[]" multiple="multiple" id="requirements">
            @foreach ($requirements as $requirement)
            <option value="{{ $requirement->id }}">
                {{ $requirement->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="heroimage">Hero image</label>
        <input type="file" id="heroimage" name="heroimage" class="filepond" data-max-file-size="1MB">
        <p class="help-block">Upload hero image</p>

        @error('heroimage')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="gallery">Gallery</label>
        <input type="file" id="gallery" name="gallery" class="filepond" multiple data-allow-reorder="true" data-max-file-size="1MB">
        <p class="help-block">Upload images for gallery</p>
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" class="form-control" id="price" placeholder="Enter price">
    </div>

    <div class="form-group">
        <label>Locations</label>

        <div id="location_items">
            @for ($i = 0; $i < 10; $i++)
            <div class="locations">
                <div class="latitude">
                    <small>
                        Latitude
                    </small>
                    <input type="text" name="locations[{{ $i }}][latitude]" class="form-control">
                </div>
                <div class="longitude">
                    <small>
                        Longitude
                    </small>
                    <input type="text" name="locations[{{ $i }}][longitude]" class="form-control">
                </div>
            </div>  
            @endfor

            @error('locations')
            <span class="text-danger">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Payment method</label>
        <div class="radio">
            <label for="cash">
                <input type="radio" name="payment_method" id="cash" value="cash" checked>
                Cash
            </label>
          </div>
        <div class="radio">
            <label for="card">
                <input type="radio" name="payment_method" id="card" value="card">
                Credit card
            </label>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary mt">Save</button>
    <a href="{{ route('admin.getAlltours') }}" class="btn btn-default mt">
        Back
    </a>
</form>

@endsection