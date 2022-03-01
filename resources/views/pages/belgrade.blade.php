@extends('index')

@section('meta-tags')
    @if ($belgrade)
    <meta name="description" content="{{ $belgrade->meta_description }}"/>
    <meta name="keywords" content="{{ $belgrade->meta_keywords }}">
    <meta property="og:title" content="Belgrade">
    <meta property="og:description" content="{{ $belgrade->meta_description }}">
    {{-- <meta property="og:image" content="{{ $belgrade->heroImage() }}"> --}}
    @endif
@endsection

@section('title', '| Belgrade')

@section('content')

<div class="page-top" id="templatemo_services">
</div> <!-- /.page-header -->

<div class="middle-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if ($belgrade)
                <div class="widget-item">
                    <div class="sample-thumb">
                        <img src="{{ asset('/images/default_main_slider.jpg') }}" alt="Belgrade">
                    </div>

                    <div class="widget-body">
                        <div class="description belgrade-description">
                            {!! $belgrade->description !!}
                        </div>    
                    </div>
                </div>
                @endif
            </div>

            <div class="col-md-4">
                <div class="widget-item">
                    <div class="widget-body">
                        <h3 class="service-title">Tour Categories</h3>
                        @foreach ($categories as $category)
                        <div class="service-item">
                            <div class="service-icon">
                                {{ $category->tours_count }}
                            </div>
                            <div class="service-content">
                                <h4>
                                    <a href="{{ route('pages.categoryRelatedTours', $category->slug) }}" target="_blank">
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