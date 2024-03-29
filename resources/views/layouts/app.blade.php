<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    {{--<link rel="stylesheet" href="/css/ladda-min.scss">--}}
    {{--<link rel="stylesheet" href="/css/ladda-themed.scss">--}}
    <link rel="stylesheet" href="/css/sweetalert.css">
    <link rel="stylesheet" href="/css/bootstrap-social.css">
    <link href="/css/app.css" rel="stylesheet">


    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script src="/js/spin.js"></script>
    {{--<script src="/js/ladda.js"></script>--}}
    {{--<script src="/js/custom_script.js"></script>--}}
    <script src="https://use.fontawesome.com/fd199dc15c.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.js"></script>
    <script src="/js/star-rating.js" type="text/javascript"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <script
            src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous"></script>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top"
         style="-webkit-box-shadow: 0px 10px 30px -1px rgba(0,0,0,0.20);
-moz-box-shadow: 0px 10px 30px -1px rgba(0,0,0,0.20);
box-shadow: 0px 10px 30px -1px rgba(0,0,0,0.20);">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="https://www.studieboekencentrale.nl/image/Logo_Windesheimgroot.gif" class="img-responsive"
                         style="height: 25px">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if(!Auth::guest())
                @if ( Auth::User()->bevoegdheid == 3)
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/overview') }}">Overview</a></li>
                        <li><a href="{{ url('/mijnopleiding') }}">Mijn Opleiding</a></li>
                        <li><a href="{{ url('/mail') }}">Mail</a></li>
                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    </ul>
                @elseif( Auth::user()->bevoegdheid == 2)
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/mijnopleiding') }}">Mijn Opleiding</a></li>
                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    </ul>

                @elseif( Auth::user()->bevoegdheid == 1)
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/mijnopleiding') }}">Mijn Opleiding</a></li>
                    </ul>
            @endif
            @endif

            <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        {{--<li><a href="{{ url('/register') }}">Register</a></li>--}}
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" style="position:relative; padding-left:50px">
                                <img src="/uploads/avatars/{{ Auth::user()->foto }}"
                                     style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                                {{ Auth::user()->voornaam }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/profiel') }}"><span class="fa fa-user-circle">&nbsp</span>Profiel</a>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><span class="fa fa-stop-circle">&nbsp</span>Logout</a>
                                </li>
                                </li>


                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

@include('sweet::alert')

</body>
</html>
