@extends('index')

@section('title', '| Tour ' . $tour->title)

@section('content')

<div class="page-top" id="templatemo_services">
</div> <!-- /.page-header -->

<div class="middle-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="widget-item">
                    <div class="sample-thumb">
                        <img src="{{ $tour->heroImage() }}" alt="{{ $tour->title }}">
                    </div>

                    <div class="widget-body">
                        <div class="date">
                            {{ $tour->created_at->format('d M Y') }} &nbsp;&middot;&nbsp; {{ $tour->timeToRead() }}
                        </div>
                        <div class="card-body">
                            <p class="card-price">
                                {{ $tour->price }} €
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
                            {{ $tour->title }}
                        </h4>
                        <p class="consult-subtitle">
                            {{ $tour->subtitle }}
                        </p>
                        <p class="widget-title">
                            <a href="#">
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
                        
                        <div class="description">
                            {!! $tour->description !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="widget-item">
                    <div class="widget-body">
                        <h3 class="service-title">Tour Categories</h3>
                        @foreach ($filteredCategories as $category)
                        <div class="service-item">
                            <div class="service-icon">
                                {{ $category->tours_count }}
                            </div>
                            <div class="service-content">
                                <h4>
                                    <a href="#">
                                        {{ $category->name }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection