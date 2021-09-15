@extends('auth.admin-index')

@section('title', 'Edit Tour')

@section('content')

<h2>Edit Tour</h2>

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

@component('auth.components.status.success')
@endcomponent

<form method="POST" action="{{ route('admin.editTour', $tour->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="category">Choose tour category</label>
        <select class="form-control" name="category_id" id="category">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $tour->category_id == $category->id ? 'selected' : '' }}>
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
        <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="{{ $tour->title ?? old('title') }}">

        @error('title')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="subtitle">Subtitle</label>
        <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="Enter subtitle" value="{{ $tour->subtitle ?? old('subtitle') }}">

        @error('subtitle')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="meta_keywords">
            <strong>SEO keywords</strong>
            <small>
                <em>
                    (Preferebly up to 10 words)
                </em>
            </small>
        </label>
        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $tour->meta_keywords ?? old('meta_keywords') }}">

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
                    (A brief description of the tour)
                </em>
            </small>
        </label>
        <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ $tour->meta_description ?? old('meta_description') }}">

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
                    (Includes steps, about and concept of tour)
                </em>
            </small>
        </label>
        <textarea name="description" class="form-control" id="description">{{ $tour->description ?? old('description') }}</textarea>

        @error('description')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="requirements">Tour requirements</label>
        <select class="form-control" name="requirements[]" multiple="multiple" id="requirements">
            @foreach ($requirements as $requirement)
            <option value="{{ $requirement->id }}" {{ $tour->requirements->contains($requirement->id) ? 'selected' : '' }}>
                {{ $requirement->name }}
            </option>
            @endforeach
        </select>

        @error('requirements')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
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

    @if ($tour->hero_image)
    <div class="form-group">
        <img width="700" src="{{ $tour->heroImage() }}" alt="{{ $tour->title }}" class="img-thumbnail">
    </div>
    @endif

    <div class="form-group">
        <label for="gallery">Gallery</label>
        <input type="file" id="gallery" name="gallery" class="filepond" multiple data-allow-reorder="true" data-max-file-size="1MB">
        <p class="help-block">Upload images for gallery</p>
    </div>

    @if ($tour->galleries)
    <div class="form-group">
        <div id="gallery-info-box"></div>
        @foreach ($tour->galleries as $gallery)
        <div class="gallery-image">
            <img width="320" src="{{ $tour->galleryImage($gallery->image) }}" alt="{{ $tour->title }}" class="img-thumbnail">
            <button type="button" class="btn btn-danger btn-sm gallery-image-btn" data-galleryId="{{ $gallery->id }}">
                <strong>
                    X
                </strong>
            </button>
        </div>
        @endforeach
    </div>
    @endif

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" class="form-control" id="price" placeholder="Enter price" value="{{ $tour->price ?? old('price') }}">

        @error('price')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label>
            <strong>Locations</strong>
            <small>
                <em>
                    (For google map)
                </em>
            </small>
        </label>

        @foreach ($locations as $key => $location)
        <div class="locations">
            <div class="lat">
                <small>
                    Latitude
                </small>

                <input type="text" name="locations[{{ $key }}][lat]" class="form-control" value="{{ $location['lat'] ?? old("locations.{$key}.lat") }}">

                @error("locations.{$key}.lat")
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="lng">
                <small>
                    Longitude
                </small>

                <input type="text" name="locations[{{ $key }}][lng]" class="form-control" value="{{ $location['lng'] ?? old("locations.{$key}.lng") }}">

                @error("locations.{$key}.lng")
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        @endforeach

        @error('locations')
        <span class="text-danger">
            {{ $message }}
        </span>
        @enderror
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
