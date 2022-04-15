@extends('index')

@section('meta-tags')
    <meta name="description" content="Get away Serbia, home page">
    <meta name="keywords" content="Get away Serbia, home, tours, serbia, travel">
    <meta property="og:title" content="Home">
    <meta property="og:description" content="Home page">
@endsection

@section('title', '| Home')

@section('content')

<div class="flexslider">
    <ul class="slides">
        @if ($popularTours->count())
        @foreach ($popularTours as $tour)
        <li>
            <div class="overlay"></div>
            <img src="{{ $tour->heroImage() }}" alt="{{ $tour->title }}">
        </li>
        @endforeach
        @else
        <li>
            <div class="overlay"></div>
            <img src="{{ asset('/images/default_main_slider.jpg') }}" alt="travel">
        </li>
        @endif
    </ul>
</div>

@if ($popularTours->count())
<div class="container">
    <div class="row">
        <div class="our-listing owl-carousel">
            @foreach ($popularTours as $tour)
            <div class="list-item">
                <div class="list-thumb">
                    <div class="title">
                        <h4>
                            <a href="{{ route('pages.categoryRelatedTours', $tour->category_slug) }}">
                                {{ $tour->category_name }}
                            </a>
                        </h4>
                    </div>
                    <img src="{{ $tour->thumbnail() }}" alt="{{ $tour->title }}">
                </div>
                <div class="list-content">
                        <h5>
                            <a href="{{ route('pages.tour', $tour->slug) }}">
                                {{ $tour->title }}
                            </a>
                        </h5>
                    <span>
                        From {{ $tour->price }} €
                    </span>
                    <a href="{{ route('pages.contact') }}" class="price-btn">
                        Book Now
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="middle-content"></div>

@endsection