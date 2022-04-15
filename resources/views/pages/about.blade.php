@extends('index')

@section('meta-tags')
    <meta name="description" content="Get away Serbia, about us page">
    <meta name="keywords" content="Get away Serbia, about, tours, serbia, travel">
    <meta property="og:title" content="About us">
    <meta property="og:description" content="About us page">
@endsection

@section('title', '| About')

@section('content')

<div class="page-top" id="about"></div>

<div class="middle-content">
    <div class="container">
        <div class="row">
        
            <div class="col-md-6">
                <div class="widget-item">
                    <div class="sample-thumb">
                        <img src="{{ asset('/images/about_1.jpg') }}" alt="about us" title="about us">
                    </div>
                    <div class="widget-body">
                        <h4 class="consult-title">
                            Our Company
                        </h4>
                        <hr>
                        <div class="description">
                            <p>
                                Duis mattis neque vel rutrum finibus. Mauris vel tincidunt purus. Aenean laoreet ornare purus. Nunc condimentum augue sed massa iaculis, vel blandit sapien consectetur. Curabitur eu aliquam erat. Etiam sollicitudin est eu turpis dapibus aliquet. Ut vitae lacus vel nulla iaculis interdum.
                                <br><br>
                                Suspendisse convallis congue tellus, nec ultricies sem molestie ac. Nunc lobortis elit orci, vitae suscipit urna dictum id. Nullam at elementum magna. Vivamus sit amet ipsum tortor. Nullam molestie eros quis risus pellentesque, eget pellentesque mauris placerat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="widget-item">
                    <div class="sample-thumb">
                        <img src="{{ asset('/images/about_2.jpg') }}" alt="company" title="company">
                    </div>
                    <div class="widget-body">
                        <h4 class="consult-title">
                            Our Team
                        </h4>
                        <hr>
                        <div class="description">
                            <p>
                                Curabitur eu aliquam erat. Etiam sollicitudin est eu turpis dapibus aliquet. Ut vitae lacus vel nulla iaculis interdum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br><br>
                                In hac habitasse platea dictumst. Nulla mollis nisl id ipsum faucibus lacinia. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam sit amet ultricies mauris. Nulla fermentum nisl felis, id blandit nunc vehicula vel.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection