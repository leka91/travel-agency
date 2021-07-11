@extends('auth.admin-index')

@section('title', 'Add new Tour')

@section('links')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endsection

@section('content')

<h2>Add new Tour</h2>

<div class="page-header"></div>

<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="category">Choose tour category</label>
        <select class="form-control" name="category" id="category">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Enter title">
    </div>

    <div class="form-group">
        <label for="subtitle">Subtitle</label>
        <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="Enter subtitle">
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
        <label for="tour_requirements">Tour requirements</label>
        <select class="form-control" name="tour_requirements[]" multiple="multiple" id="tour_requirements">
            <option value="1">
                Boots
            </option>
            <option value="2">
                Water
            </option>
            <option value="3">
                Backpack
            </option>
        </select>
    </div>

    <div class="form-group">
        <label for="hero_image">Hero image</label>
        <input type="file" id="hero_image" name="hero_image" class="filepond">
        <p class="help-block">Upload hero image</p>
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" class="form-control" id="price" placeholder="Enter price">
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
    <a href="{{ route('admin.tours') }}" class="btn btn-default mt">
        Back
    </a>
</form>

@endsection

@section('scripts')

    
@endsection