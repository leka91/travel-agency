@extends('index')

@section('meta-tags')
    <meta name="description" content="{{ $tour->meta_description }}"/>
    <meta name="keywords" content="{{ $tour->meta_keywords }}">
    <meta property="og:title" content="{{ $tour->title }}">
    <meta property="og:description" content="{{ $tour->meta_description }}">
    <meta property="og:image" content="{{ $tour->heroImage() }}">
@endsection

@section('title', '| Tour ' . $tour->title)

@section('links')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>

<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css">
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-classic.css">
@endsection

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
                        @if ($tour->category_id == 1)
                        <div class="belgrade">
                            <a href="{{ route('pages.belgrade') }}" class="btn btn-default" target="_blank">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                Check Belgrade
                            </a>
                        </div>
                        @endif
                        <div class="date">
                            <div id="share"></div>
                        </div>
                        <h4 class="consult-title">
                            {{ $tour->title }}
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
                        <p class="widget-title">
                            <a href="{{ route('pages.categoryRelatedTours', $tour->category_slug) }}" target="_blank">
                                {{ $tour->category_name }}
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

                        @if ($tour->galleries->isNotEmpty())
                        <div class="gallery">
                            <div class="fotorama" data-allowfullscreen="true" data-width="100%">
                                @foreach ($tour->galleries as $gallery)
                                <img src="{{ $tour->galleryImage($gallery->image) }}" alt="{{ $tour->title }}">
                                @endforeach

                                @if ($tour->videos->isNotEmpty())
                                    @foreach ($tour->videos as $video)
                                    <a href="{{ $video->video_link }}"></a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="widget-item">
                    <div class="widget-body">
                        <h3 class="service-title">Book this Tour</h3>
                        <table class="table table-striped">
                            <tbody>
                                @foreach ($tour->prices as $price)
                                <tr>
                                    <td>{{ $price->name }} persons</td>
                                    <td>{{ $price->amount }}€</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <a href="{{ route('pages.contact') }}" class="book-now" target="_blank">
                            Book now!
                        </a>
                    </div>
                </div>

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

@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
<script src="{{ asset('js/jssocials.js') }}"></script>
@endsection