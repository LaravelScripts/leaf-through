<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ setting('app_name') }}</title>
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
<body class="@yield('body-class')">
    <div id="app">
        <aside class="sidebar active">
            <div class="sidebar-header">
                <!-- <span class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </span> -->
                <a href="{{ url('/home') }}" class="brand-name">{{ setting('app_name') }}</a>
                <form action="{{ url('logout') }}" method="POST">
                    {{ csrf_field() }}
                    <button data-toggle="tooltip" data-placement="left" title="Logout" type="submit" class="logout">
                        <i class="ion-log-out"></i>
                    </button>
                </form>
            </div>
            <form action="" method="POST" class="sidebar-form">
                <input type="text" name="query" id="query" placeholder="Search..">
            </form>
            <div class="links">
                <ul class="no-list-style">
                    <li><a href=""><i class="ion-ios-folder-outline"></i> Inbox <span id = "mailbox-count" class="badge">{{ mailbox()->count() }}</span></a></li>
                    <li><a href="{{ url('archives') }}"><i class="ion-ios-box-outline"></i> Archives</a></li>
                    <li><a href="{{ url('settings') }}"><i class="ion-ios-gear-outline"></i> Settings</a></li>
                    <?php $categoryGroups = categories(); ?>
                    @if (count($categoryGroups))
                    <li class="divider">Category</li>
                    @foreach($categoryGroups as $categoryGroup)
                      <li><a href="">{{ $categoryGroup->name }}
                      <span class="badge">
                        {{ $categoryGroup->categorizedArticle->count() }}
                      </span></a></li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class="share-link active">
                <a href="#add-link" data-toggle="modal">
                    <i class="ion-link"></i> Add Link
                </a>
            </div>
        </aside>
        <section class="main-container">
            @yield('content')
        </section>
        <div class="maximum">
            <a href="#" data-toggle="tooltip" data-placement="left" title="Full Screen Mode">
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

    <div class="modal" id="add-link" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Link</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="link">Link<em>*</em></label>
                            <input type="text" name="link" id="link" class="form-control" placeholder="Enter the link" autofocus>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" v-on:click= "extractHtml" >
                                Save Link
                            </button>
                        </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    <script>
        jQuery(document).ready(function(){
            $('.maximum > a').click(function(e){
                e.preventDefault();
                $('aside.sidebar').toggleClass('active');
                $('.share-link').toggleClass('active');
                $('section.main-container').toggleClass('active');
            });
            $('[data-toggle="tooltip"]').tooltip();

            $('.post-options').click(function(event) {
                event.preventDefault();
                console.log($(this).closest('options'));
                $(this).closest('.options').find('ul').toggleClass('hidden');
            });
        });
    </script>
    <!--<script src="/js/app.js"></script>-->
    <script src = "{{ asset('js/dashboard.js') }}"></script>
    <script src = "{{ asset('js/FReadability.js') }}"></script>

    <script>
      Echo.private('inbox-{{ Auth::user()->id }}' )
        .listen('LinkShared', (e) => {
          console.log(e.user + " shared a link.");
          document.getElementById('mailbox-count').innerHTML = parseInt(document.getElementById('mailbox-count').innerHTML) + 1;
        });
    </script>
    @yield('customjs')
</body>
</html>
