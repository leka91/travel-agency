@extends('index')

@section('title', '| Contact')

@section('content')

<div class="page-top" id="contact"></div>

<div class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-6 col-sm-6">
                <h3 class="widget-title">Contact Us</h3>

                @component('auth.components.status.success')
                @endcomponent

                <div class="contact-form">
                    <form name="contactform" id="contactform" action="{{ route('pages.sendContactMessage') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <input type="text" name="name" class="@error('name') has-error @enderror" id="name" placeholder="Your Name" value="{{ old('name') }}">
                    
                            @error('name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input name="email" class="@error('email') has-error @enderror" type="text" id="email" placeholder="Your Email" value="{{ old('email') }}"> 

                            @error('email')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input name="subject" class="@error('subject') has-error @enderror" type="text" id="subject" placeholder="Subject" value="{{ old('subject') }}"> 

                            @error('subject')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="message" class="@error('message') has-error @enderror" id="message" placeholder="Message">{{ old('message') }}</textarea>

                            @error('message')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <input type="submit" class="mainBtn" id="submit" value="Send Message">
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-sm-3"></div>
        </div>
    </div>
</div>

@endsection