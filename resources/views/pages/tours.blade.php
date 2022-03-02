@extends('index')

@section('title', '| Tours')

@section('content')

<div class="page-top" id="events" style="background: url({{ asset('/images/header_2.jpg') }});background-repeat: no-repeat;-webkit-background-size: cover;background-size: cover;background-position: center"></div>

<div class="middle-content">
    <div class="container tours-container">
        <div class="row tours-row">

            @foreach ($tours as $tour)
            <div class="col-lg-4 col-md-6 tours-col">
                <div class="widget-item">
                    <div class="sample-thumb">
                        <a href="{{ route('pages.tour', $tour->slug) }}" target="_blank">
                            <img src="{{ $tour->thumbnail() }}" alt="{{ $tour->title }}">
                        </a>
                    </div>
                    <div class="widget-body">
                        @if ($tour->is_popular)
                        <div class="popular">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            Popular
                        </div>
                        @endif

                        <h4 class="consult-title">
                            <a href="{{ route('pages.tour', $tour->slug) }}" target="_blank">
                                {{ $tour->title }}
                            </a>
                        </h4>
                        <p class="consult-subtitle">
                            {{ $tour->subtitle }}
                        </p>
                        <div class="widget-tags">
                            @if ($tour->tags->isNotEmpty())
                                @foreach ($tour->tags as $tag)
                                <a href="{{ route('pages.tagRelatedTours', $tag->slug) }}" target="_blank">
                                    <span class="badge">
                                        {{ $tag->name }}
                                    </span>
                                </a>
                                @endforeach
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="card-price">
                                <span>
                                    From
                                </span>
                                {{ $tour->price }} €
                            </div>
                        </div>
                        
                        <p class="widget-title">
                            <a href="{{ route('pages.categoryRelatedTours', $tour->category_slug) }}" target="_blank">
                                {{ $tour->category_name }}
                            </a>
                        </p>
                        
                        <div>
                            <a href="{{ route('pages.tour', $tour->slug) }}" class="read-more" target="_blank">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="custom-pagination">
            {{ $tours->links() }}
        </div>
    </div>
</div> 

@endsection