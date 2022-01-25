@extends('index')

@section('title', '| Home')

@section('content')

<div class="flexslider">
    <ul class="slides">
        @foreach ($latestsThree as $tour)
        <li>
            <div class="overlay"></div>
            <img src="{{ $tour->heroImage() }}" alt="{{ $tour->title }}">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-4">
                        <div class="flex-caption visible-lg">
                            <span class="price">$7,500</span>
                            <h3 class="title">Venice, Italy</h3>
                            <p>Travel is a responsive Bootstrap layout from 
                            <span class="blue">template</span><span class="green">mo</span> website.
                                All images used in this template are from 
                                <a rel="nofollow" href="http://unsplash.com" target="_parent">Unsplash</a>.</p>
                            <a href="#" class="slider-btn">Pre-booking</a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div> <!-- /.flexslider -->

<div class="container">
    <div class="row">
        <div class="our-listing owl-carousel">
            <div class="list-item">
                <div class="list-thumb">
                    <div class="title">
                        <h4>Italy</h4>
                    </div>
                    <img src="images/destination_1.jpg" alt="destination 1">
                </div> <!-- /.list-thumb -->
                <div class="list-content">
                    <h5>Rome, Milan, Naples</h5>
                    <span>SILVER HOTEL, 4 NIGHTS, 5 STARS</span>
                    <a href="#" class="price-btn">$1,700 Book Now</a>
                </div> <!-- /.list-content -->
            </div> <!-- /.list-item -->
            <div class="list-item">
                <div class="list-thumb">
                    <div class="title">
                        <h4>France</h4>
                    </div>
                    <img src="images/destination_2.jpg" alt="destination 2">
                </div> <!-- /.list-thumb -->
                <div class="list-content">
                    <h5>Paris, Marseille, Lyon</h5>
                    <span>NEW PALACE, 5 NIGHTS, 5 STARS</span>
                    <a href="#" class="price-btn">$2,200 Book Now</a>
                </div> <!-- /.list-content -->
            </div> <!-- /.list-item -->
            <div class="list-item">
                <div class="list-thumb">
                    <div class="title">
                        <h4>Germany</h4>
                    </div>
                    <img src="images/destination_3.jpg" alt="destination 3">
                </div> <!-- /.list-thumb -->
                <div class="list-content">
                    <h5>Berlin, Hamburg, Munich</h5>
                    <span>LUXE HOTEL, 5 NIGHTS, 6 STARS</span>
                    <a href="#" class="price-btn">$3,300 Book Now</a>
                </div> <!-- /.list-content -->
            </div> <!-- /.list-item -->
            <div class="list-item">
                <div class="list-thumb">
                    <div class="title">
                        <h4>Spain</h4>
                    </div>
                    <img src="images/destination_4.jpg" alt="destination 4">
                </div> <!-- /.list-thumb -->
                <div class="list-content">
                    <h5>Madrid, Bercelona, Valencia</h5>
                    <span>GOOD HOTEL, 4 NIGHTS, 6 STARS</span>
                    <a href="#" class="price-btn">$4,400 Book Now</a>
                </div> <!-- /.list-content -->
            </div> <!-- /.list-item -->
            <div class="list-item">
                <div class="list-thumb">
                    <div class="title">
                        <h4>Netherlands</h4>
                    </div>
                    <img src="images/destination_5.jpg" alt="destination 5">
                </div> <!-- /.list-thumb -->
                <div class="list-content">
                    <h5>Amsterdam, Delft, The Hague</h5>
                    <span>BEST HOTEL, 6 NIGHTS, 7 STARS</span>
                    <a href="#" class="price-btn">$5,500 Book Now</a>
                </div> <!-- /.list-content -->
            </div> <!-- /.list-item -->
            <div class="list-item">
                <div class="list-thumb">
                    <div class="title">
                        <h4>Switzerland</h4>
                    </div>
                    <img src="images/destination_6.jpg" alt="destination 6">
                </div> <!-- /.list-thumb -->
                <div class="list-content">
                    <h5>Zürich, Geneva, Basel</h5>
                    <span>NEW HOTEL, 7 NIGHTS, 7 STARS</span>
                    <a href="#" class="price-btn">$6,600 Book Now</a>
                </div> <!-- /.list-content -->
            </div> <!-- /.list-item -->
        </div> <!-- /.our-listing -->
    </div> <!-- /.row -->
</div> <!-- /.container -->

<div class="middle-content"></div>

@endsection