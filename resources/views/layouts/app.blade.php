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
                    <li><a href=""><i class="ion-ios-folder-outline"></i> Inbox <span class="badge">23</span></a></li>
                    <li><a href="{{ url('archives') }}"><i class="ion-ios-box-outline"></i> Archives</a></li>
                    <li><a href="{{ url('settings') }}"><i class="ion-ios-gear-outline"></i> Settings</a></li>
                    <li class="divider">Category</li>
                    <li><a href="">Technology <span class="badge">8</span></a></li>
                    <li><a href="">Electronics </a></li>
                    <li><a href="">Internet of Things <span class="badge">13</span></a></li>
                    <li><a href="">Augemented Reality <span class="badge">1</span></a></li>
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
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="link">Link<em>*</em></label>
                            <input type="text" name="link" id="link" class="form-control" placeholder="Enter the link" autofocus>
                        </div>
                        <!-- <div class="form-group">
                            <label for="to">To Address<em>*</em></label>
                            <input type="text" name="to" id="to" class="form-control"  placeholder="Enter the email address">
                        </div>
                        <div class="form-group">
                            <label for="message">Message (optional)</label>
                            <textarea name="message" id="" cols="30" rows="3" class="form-control"  placeholder="Enter the message"></textarea>
                        </div>
                        <div class="form-group checkbox">
                            <input type="checkbox" name="slack_notification" id="slack_notification">
                            <label for="slack_notification">Send Slack Notification</label>
                        </div>
                        <div class="form-group checkbox">
                            <input type="checkbox" name="send_annotation" id="send_annotation">
                            <label for="send_annotation">Send with Annotation</label>
                        </div> -->
                        <div class="form-group">
                            <button class="btn btn-primary">
                                Save Link
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
            $('[data-toggle="tooltip"]').tooltip();

            $('.post-options').click(function(event) {
                event.preventDefault();
                console.log($(this).closest('options'));
                $(this).closest('.options').find('ul').toggleClass('hidden');
            });
        });
    </script>
    <!--<script src="/js/app.js"></script>-->
    @yield('customjs')
</body>
</html>
