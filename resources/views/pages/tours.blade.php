@extends('index')

@section('title', '| Events')

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
                        <a href="#">
                            <img src="{{ $tour->thumbnail() }}" alt="{{ $tour->title }}">
                        </a>
                    </div>
                    <div class="widget-body">
                        <div class="date">
                            {{ $tour->created_at->format('d M Y') }} &nbsp;&middot;&nbsp; {{ $tour->timeToRead() }}
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
                        <a href="#">
                            <h4 class="consult-title">
                                {{ $tour->title }}
                            </h4>
                        </a>
                        <p class="widget-title">
                            <a href="#">
                                {{ $tour->category->name }}
                            </a>
                        </p>
                        <p>
                            {{ Str::limit(strip_tags($tour->description), 100) }}
                        </p>
    
                        <div>
                            <a href="#" class="read-more" target="_blank">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>                 
            </div>
            @endforeach
            
        </div>
    </div>
</div> 

@endsection