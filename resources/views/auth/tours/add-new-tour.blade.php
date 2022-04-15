@extends('auth.admin-index')

@section('title', 'Add new Tour')

@section('links')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endsection

@section('content')

<h2>Add new Tour</h2>

<div class="page-header"></div>

@component('auth.components.status.all-errors')
@endcomponent

@component('auth.components.status.success')
@endcomponent

<form method="POST" action="{{ route('admin.addNewTour') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group @error('is_popular') has-error @enderror">
        <div class="checkbox">
            <label>
              <input type="checkbox" name="is_popular" value="{{ old('is_popular', 0) }}"> Is tour popular
            </label>
        </div>

        @error('is_popular')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
    </div>
    
    <hr>

    <div class="form-group @error('category_id') has-error @enderror">
        <label for="category">
            Choose tour category
            <sup class="text-danger">*</sup>
        </label>
        <select class="form-control" name="category_id" id="category">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
            @endforeach
        </select>

        @error('category_id')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
    </div>

    <div class="form-group @error('title') has-error @enderror">
        <label for="title">
            Title
            <sup class="text-danger">*</sup>
        </label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="{{ old('title') }}">

        @error('title')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
    </div>

    <div class="form-group @error('subtitle') has-error @enderror">
        <label for="subtitle">
            Subtitle
            <sup class="text-danger">*</sup>
        </label>
        <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="Enter subtitle" value="{{ old('subtitle') }}">

        @error('subtitle')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
    </div>

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
        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}">

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
                    (A brief description of the tour)
                </em>
            </small>
            <sup class="text-danger">*</sup>
        </label>
        <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ old('meta_description') }}">

        @error('meta_description')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">
            Description
            <small>
                <em>
                    (Includes steps, about and concept of tour)
                </em>
            </small>
            <sup class="text-danger">*</sup>
        </label>
        <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>

        @error('description')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="requirements">Tour requirements</label>
        <select class="form-control" name="requirements[]" multiple="multiple" id="requirements"></select>

        @error('requirements')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="tags">Tour tags</label>
        <select class="form-control" name="tags[]" multiple="multiple" id="tags"></select>

        @error('tags')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="heroimage">
            Hero image
            <sup class="text-danger">*</sup>
        </label>
        <input type="file" id="heroimage" name="heroimage" class="filepond" data-max-file-size="1MB">
        <p class="help-block">Upload hero image</p>

        @error('heroimage')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
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
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror

        @error('videos.*.video_link')
            <span class="text-danger">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label>
            Prices
            <sup class="text-danger">*</sup>
        </label>

        @for ($i = 0; $i < 3; $i++)
        <div class="prices">
            <div class="price-name @error("prices.{$i}.name") has-error @enderror">
                <small>
                    People
                </small>

                <input type="text" name="prices[{{ $i }}][name]" class="form-control" value="{{ old("prices.{$i}.name") }}">

                @error("prices.{$i}.name")
                <span class="text-danger">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                @enderror
            </div>
            
            <div class="price-amount @error("prices.{$i}.amount") has-error @enderror">
                <small>
                    Amount
                </small>

                <input type="number" name="prices[{{ $i }}][amount]" class="form-control" value="{{ old("prices.{$i}.amount") }}">

                @error("prices.{$i}.amount")
                <span class="text-danger">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                @enderror
            </div>
        </div>
        @endfor

        @error('prices')
        <span class="text-danger">
            <strong>
                {{ $message }}
            </strong>
        </span>
        @enderror
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
            <div class="lat @error("locations.{$i}.lat") has-error @enderror">
                <small>
                    Latitude
                </small>

                <input type="text" name="locations[{{ $i }}][lat]" class="form-control" value="{{ old("locations.{$i}.lat") }}">

                @error("locations.{$i}.lat")
                <span class="text-danger">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                @enderror
            </div>

            <div class="lng @error("locations.{$i}.lng") has-error @enderror">
                <small>
                    Longitude
                </small>

                <input type="text" name="locations[{{ $i }}][lng]" class="form-control" value="{{ old("locations.{$i}.lng") }}">

                @error("locations.{$i}.lng")
                <span class="text-danger">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                @enderror
            </div>
        </div>
        @endfor

        @error('locations')
        <span class="text-danger">
            <strong>
                {{ $message }}
            </strong>
        </span>
        @enderror
    </div>

    {{-- <div class="form-group">
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
    </div> --}}
    
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
