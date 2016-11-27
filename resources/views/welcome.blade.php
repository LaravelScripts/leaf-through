<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <title>Leaf Through</title>

        <link rel="stylesheet" href="{{ asset("css/home.css") }}">
    </head>
    <body>
        <div class="position-ref full-height">
            <a href="{{ url('/') }}" class="brand-name">
                <i class="ion-ios-book-outline"></i>
            </a>
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}" class="create-account">Register</a>
                    @endif
                </div>
            @endif
        </div>
        <div class="introduction">
            <span>Introducing</span>
            <h1>Leaf Through</h1>
            <p>
                Enjoy distraction free reading of your favorite articles across websites anywhere.
            </p>
            <a href="{{ url('register') }}" class="get-started">Get Started</a>
        </div>
        <div class="bg-img"></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>
