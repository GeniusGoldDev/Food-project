<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="robots" content="noindex, follow">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,600">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css'/>
        <link rel="stylesheet" href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/css/install.css">
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
        <title>@yield('title')</title>
        <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-106310733-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-106310733-1');
    </script>
    <!-- END Google Analytics -->
        @yield("custom-script-one")
    </head>
    <body>
        @yield("custom-script-two")
        <div class="wrapper">
            @yield("thankyou")
            @yield("update")
            @if(!Request::is('install/update'))
                <div class="col-lg-8 col-md-9 col-sm-10 main-col">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="list-inline left-sidebar">
                                <li class="{{ request()->is('install/pre-installation') ? 'active' : 'complete' }}">
                                    1. Pre-Installation
                                </li>
                                <li class="{{ request()->is('install/configuration') ? 'active' : '' }} {{ request()->is('install/complete') ? 'complete' : '' }}">
                                    2. Configuration
                                </li>
                                <li class="{{ request()->is('install/complete') ? 'active' : '' }}">
                                    3. Complete
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="content-wrapper clearfix">
                                <div class="content">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </body>
</html>