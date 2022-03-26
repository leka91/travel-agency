@extends('index')

@section('title', '| Tours')

@section('content')

<div class="page-top" id="tours"></div>

<div class="middle-content">
    <div class="container tours-container">
        <div class="row tours-row">

            @foreach ($tours as $tour)
            <div class="col-lg-4 col-md-6 tours-col">
                <div class="widget-item">
                    <div class="sample-thumb">
                        <a href="{{ route('pages.tour', $tour->slug) }}">
                            <img src="{{ $tour->thumbnail() }}" alt="{{ $tour->title }}">
                        </a>
                    </div>
                    <div class="widget-body">
                        @if ($tour->is_popular)
                        <div class="popular">
                            <a href="{{ route('pages.popularTours') }}">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                Popular
                            </a>
                        </div>
                        @endif

                        <h4 class="consult-title">
                            <a href="{{ route('pages.tour', $tour->slug) }}">
                                {{ $tour->title }}
                            </a>
                        </h4>
                        <p class="consult-subtitle">
                            {{ $tour->subtitle }}
                        </p>
                        <div class="widget-tags">
                            @if ($tour->tags->isNotEmpty())
                                @foreach ($tour->tags as $tag)
                                <a href="{{ route('pages.tagRelatedTours', $tag->slug) }}">
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
                            <a href="{{ route('pages.categoryRelatedTours', $tour->category_slug) }}">
                                {{ $tour->category_name }}
                            </a>
                        </p>
                        
                        <div>
                            <a href="{{ route('pages.tour', $tour->slug) }}" class="read-more">
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