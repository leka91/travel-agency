@extends('auth.admin-index')

@section('title', 'Add new Tour')

@section('links')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endsection

@section('content')

<h2>Add new Tour</h2>

<div class="page-header"></div>

@component('auth.components.status.success')
@endcomponent

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
        <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="{{ old('title') }}">

        @error('title')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="subtitle">Subtitle</label>
        <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="Enter subtitle" value="{{ old('subtitle') }}">

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
        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}">

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
        <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ old('meta_description') }}">

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
        <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>

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
            <option value="{{ $requirement->id }}">
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
        <label for="tags">Tour tags</label>
        <select class="form-control" name="tags[]" multiple="multiple" id="tags">
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">
                {{ $tag->name }}
            </option>
            @endforeach
        </select>

        @error('tags')
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

    <div class="form-group">
        <label for="gallery">Gallery</label>
        <input type="file" id="gallery" name="gallery" class="filepond" multiple data-allow-reorder="true" data-max-file-size="1MB">
        <p class="help-block">Upload images for gallery</p>
    </div>

    <div class="form-group">
        <label>
            <strong>Videos</strong>
            <small>
                <em>
                    (Youtube links)
                </em>
            </small>
        </label>
        <select class="form-control" name="videos[][video_link]" multiple="multiple" id="videos">
            
        </select>
        
        @error('videos')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror

        @error('videos.*.video_link')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label>Prices</label>

        @for ($i = 0; $i < 3; $i++)
        <div class="prices">
            <div class="price-name">
                <small>
                    People
                </small>

                <input type="text" name="prices[{{ $i }}][name]" class="form-control" value="{{ old("prices.{$i}.name") }}">

                @error("prices.{$i}.name")
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="price-amount">
                <small>
                    Amount
                </small>

                <input type="number" name="prices[{{ $i }}][amount]" class="form-control" value="{{ old("prices.{$i}.amount") }}">

                @error("prices.{$i}.amount")
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        @endfor
    </div>

    <div class="form-group">
        <label>
            Locations
            <small>
                <em>
                    (For google map)
                </em>
            </small>
        </label>

        @for ($i = 0; $i < 10; $i++)
        <div class="locations">
            <div class="lat">
                <small>
                    Latitude
                </small>

                <input type="text" name="locations[{{ $i }}][lat]" class="form-control" value="{{ old("locations.{$i}.lat") }}">

                @error("locations.{$i}.lat")
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="lng">
                <small>
                    Longitude
                </small>

                <input type="text" name="locations[{{ $i }}][lng]" class="form-control" value="{{ old("locations.{$i}.lng") }}">

                @error("locations.{$i}.lng")
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        @endfor

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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('js/ckeditor5.js') }}"></script>
<script src="{{ asset('js/filepond.js') }}"></script>
@endsection
