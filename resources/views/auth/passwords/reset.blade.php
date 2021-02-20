@extends('index')

@section('content')

<div class="page-top"></div>

<div class="login-page">
    <div class="container">
        <div class="row"> 
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="text-center">
                    <h3 class="widget-title">
                        Reset Password
                    </h3>
                </div>
                <div class="login-form">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                        <div class="form-group">
                            <label for="email">
                                Email address
                            </label>

                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $email ?? old('email') }}" autofocus>

                            @error('email')
                                <span class="login-error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">
                                Password
                            </label>

                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">

                            @error('password')
                                <span class="login-error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">
                                Confirm Password
                            </label>

                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password">
                        </div>

                        <button type="submit" class="loginBtn">
                            Reset Password
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>

@endsection
