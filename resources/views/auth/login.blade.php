<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="/css/login-register.css" rel="stylesheet">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="login">
    <div class="container" id="app">
        <div class="create-account">
            <span>Don't have account?</span>
            <a href="{{ url('register') }}" class="get-started">GET STARTED</a>
        </div>
        <div class="row flexbox">
            <div class="col-md-8 col-md-offset-2 item">
                <h1>Sign In to Leaf Through.</h1>
                <p>Enter your details below.</p>
                @if ($errors->has('failed'))
                    <span class="help-block">
                        <strong>{{ $errors->first('failed') }}</strong>
                        @if(preg_match('/Account not activated/', $errors->first('failed')))
                            <strong>Click <button class = "btn" v-on:click = "sendConfirmation">here</button> to resend confirmation mail.</strong>
                        @endif
                    </span>
                @endif
                <json-reponse v-bind:class="pseudoclass" v-bind:message="message"></json-reponse>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="johndoe@gmail.com" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Enter your password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>

                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src = "{{ asset('js/login.js') }}" type = "text/javascript"></script>
</body>
</html>

