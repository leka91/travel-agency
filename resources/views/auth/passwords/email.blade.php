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

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
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

                        <button type="submit" class="loginBtn">
                            Send Password Reset Link
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>

@endsection
