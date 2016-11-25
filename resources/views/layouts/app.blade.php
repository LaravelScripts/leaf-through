<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tangerine" rel="stylesheet">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <aside class="sidebar active">
            <div class="sidebar-header">
                <span class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
                <a class="brand-name">Leaf Through </a>
                <form action="{{ url('logout') }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="logout">
                        <i class="ion-log-out"></i>
                    </button>
                </form>
            </div>
            <form action="" method="POST" class="sidebar-form">
                <input type="text" name="query" id="query" placeholder="Search..">
            </form>
            <div class="links">
                <ul class="no-list-style">
                    <li><a href="">Inbox <span class="badge">{{ $inbox->count() }}</span></a></li>
                    <li class="divider">Category</li>
                    @foreach($categoryGroups as $categoryGroup)
                      <li><a href="">{{ $categoryGroup->name }}
                      <span class="badge">
                        {{ $categoryGroup->categorizedMail->count() }}
                      </span></a></li>
                    @endforeach
                </ul>
            </div>
            <div class="share-link active">
                <a href="#share-link" data-toggle="modal">
                    <i class="ion-ios-redo-outline"></i> Share Link
                </a>
            </div>
        </aside>
        <section class="main-container">
            @yield('content')
        </section>
        <div class="maximum">
            <a href="">
                <i class="ion-android-expand"></i>
            </a>
        </div>
        <div class="navigate-blog">
            <a class="previous-blog">
                <i class="ion-ios-arrow-up"></i>
            </a>
            <a class="next-blog">
                <i class="ion-ios-arrow-down"></i>
            </a>
        </div>
    </div>

    <div class="modal" id="share-link" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Share Link</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="link">Link<em>*</em></label>
                            <input type="text" name="link" id="link" class="form-control"autofocus>
                        </div>
                        <div class="form-group">
                            <label for="to">To Address<em>*</em></label>
                            <input type="text" name="to" id="to" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="message">Message (optional)</label>
                            <textarea name="message" id="" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">
                                Share Link
                            </button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script>
        jQuery(document).ready(function(){
            $('.maximum > a').click(function(e){
                e.preventDefault();
                $('aside.sidebar').toggleClass('active');
                $('.share-link').toggleClass('active');
                $('section.main-container').toggleClass('active');
            });
        });
    </script>
    <!--<script src="/js/app.js"></script>-->
    @yield('customjs')
</body>
</html>
