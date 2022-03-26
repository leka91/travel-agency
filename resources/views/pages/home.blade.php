@extends('index')

@section('title', '| Home')

@section('content')

<div class="flexslider">
    <ul class="slides">
        @if ($latestThree->count())
        @foreach ($latestThree as $tour)
        <li>
            <div class="overlay"></div>
            <img src="{{ $tour->heroImage() }}" alt="{{ $tour->title }}">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-4">
                        <div class="flex-caption visible-lg">
                            <span class="price">
                                <span>From</span> 
                                {{ $tour->price }} €
                            </span>
                            <h3 class="title">
                                {{ $tour->title }}
                            </h3>
                            <p>
                                {{ $tour->subtitle }}
                            </p>
                            <a href="{{ route('pages.contact') }}" class="slider-btn">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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

@if ($latestSix->count())
<div class="container">
    <div class="row">
        <div class="our-listing owl-carousel">
            @foreach ($latestSix as $tour)
            <div class="list-item">
                <div class="list-thumb">
                    <div class="title">
                        <h4>
                            {{ $tour->category_name }}
                        </h4>
                    </div>
                    <img src="{{ $tour->thumbnail() }}" alt="{{ $tour->title }}">
                </div>
                <div class="list-content">
                    <a href="{{ route('pages.tour', $tour->slug) }}" class="price-btn">
                        {{ $tour->title }}
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