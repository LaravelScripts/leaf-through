@extends('layouts.auth')

@section('title', 'Forgot Password')
@section('body-class', 'forgot-password')
@section('content')
    <div class="create-account">
        <span>Don't have account?</span>
        <a href="{{ url('register') }}" class="get-started">GET STARTED</a>
    </div>
    <div class="container" id="app">
        <div class="row flexbox">
            <div class="col-md-8 col-md-offset-2 item">
                <h1>Forgot Password</h1>
                <p>Enter your email address below and we'll get you back on track. </p>
                @if (session('status'))
                    <div class="help-block">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="johndoe@gmail.com" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Send Password Reset Link
                            </button>
                        </div>
                    </div>
                    <a href="{{ url('login') }}" class="back-to-signin">&#8592; Back to Sign In</a>
                </form>
            </div>
        </div>
    </div>
@endsection