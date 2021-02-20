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
                        Login
                    </h3>
                </div>
                <div class="login-form">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">
                                Email address
                            </label>

                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}" autofocus>

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

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                            </label>
                        </div>

                        <button type="submit" class="loginBtn">Login</button>

                        @if (Route::has('password.request'))
                            <a class="btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>

@endsection
