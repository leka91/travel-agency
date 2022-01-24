@extends('index')

@section('title', '| Tours')

@section('content')

<div class="page-top" id="templatemo_events">
</div> <!-- /.page-header -->

<div class="middle-content">
    <div class="container">
        <div class="row">

            @foreach ($tours as $tour)
            <div class="col-lg-4 col-md-4">
                <div class="widget-item">
                    <div class="sample-thumb">
                        <a href="{{ route('pages.tour', $tour->slug) }}" target="_blank">
                            <img src="{{ $tour->thumbnail() }}" alt="{{ $tour->title }}">
                        </a>
                    </div>
                    <div class="widget-body">
                        <div class="date">
                            {{ $tour->timeToRead() }}
                        </div>
                        <div class="card-body">
                            <p class="card-price">
                                <span>
                                    From
                                </span>
                                {{ $tour->firstPrice() }}
                            </p>
                        </div>
                        <div class="widget-tags">
                            @if ($tour->tags->isNotEmpty())
                                @foreach ($tour->tags as $tag)
                                <a href="#">
                                    <span class="badge">
                                        {{ $tag->name }}
                                    </span>
                                </a>
                                @endforeach
                            @endif
                        </div>
                        <h4 class="consult-title">
                            <a href="{{ route('pages.tour', $tour->slug) }}" target="_blank">
                                {{ $tour->title }}
                            </a>
                        </h4>
                        <p class="consult-subtitle">
                            {{ $tour->subtitle }}
                        </p>
                        <p class="widget-title">
                            <a href="{{ route('pages.categoryRelatedTours', $tour->category->slug) }}" target="_blank">
                                {{ $tour->category->name }}
                            </a>
                        </p>

                        @if ($tour->requirements->isNotEmpty())
                        <div class="requirements">
                            <p class="requirements-paragraph">
                                Requirements:
                            </p>
                            <p class="requirement-items">
                                @foreach ($tour->requirements as $requirement)
                                    <span class="badge">
                                        {{ $requirement->name }}
                                    </span>
                                @endforeach
                            </p>
                        </div>
                        @endif
                        
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