@extends('index')

@section('title', '| Tour ' . $tour->title)

@section('links')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
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
                        <div class="date">
                            {{ $tour->timeToRead() }}
                        </div>
                        <div class="card-body">
                            <p class="card-price">
                                <span>
                                    From
                                </span>
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

                        @if ($tour->galleries)
                        <div class="gallery">
                            <div class="fotorama" data-allowfullscreen="true" data-width="100%">
                                @foreach ($tour->galleries as $gallery)
                                <img src="{{ $tour->galleryImage($gallery->image) }}" alt="{{ $tour->title }}">
                                @endforeach
                                {{-- <a href="https://www.youtube.com/watch?v=vhd5HPoGV58">Hulk</a> --}}
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
                                <tr>
                                    <td>1-3 persons</td>
                                    <td>339€</td>
                                </tr>
                                <tr>
                                    <td>4-6 persons</td>
                                    <td>399€</td>
                                </tr>
                                <tr>
                                    <td>7-8 persons</td>
                                    <td>459€</td>
                                </tr>
                                <tr>
                                    <td>9-19 persons</td>
                                    <td>799€</td>
                                </tr>
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