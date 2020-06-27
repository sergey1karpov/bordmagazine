<!DOCTYPE html>
<html lang="ru">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>BORD!MAG @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Hear all the best new Punk-Rock album releases and see new Video clips & Live perfomances!"/>
    <meta name="keywords" content="Punk, Punk-Rock, best new albums, best songs, top new songs, hot new songs, songs of 2020, discover new music, find new music, new songs, new music, new cd releases, new music releases, new releases now, 2020 albums, 2020 cds, top songs, hot songs"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Open Graph tags-->
    <meta property="og:title" content="BORD!MAG - New Punk-Rock Releases, Songs & Video. Beta 1.0" />
    <meta property="og:url" content="http://www.bordmagazine.ru" />
    <meta property="og:site_name" content="BORD!MAG" />
    <meta property="og:description" content="Hear all the best new Punk-Rock album releases and see new Video clips & Live perfomances!" />
    <meta property="og:image" content="{{$post->img_link ?? asset('img/logo4.png')}}"/>
    <meta property="og:type" content="website" />

    <!-- Favicon-->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">

    <!-- Bootstrap and CSS-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/test.js') }}"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jaldi&display=swap" rel="stylesheet">


</head>
<body>

<div class="container" style="padding: 0">
    <!--Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light  navmobile fixed-top" style="background-color: white">
        <a class="navbar-brand" href="/"><img src="{{asset('img/logo4.png')}}" class="img-fluid mb-1" width="120;"></a>
        {{--    <a class="navbar-brand" href="/" style="font-family: 'Archivo Black', sans-serif; font-size: 27px; color: #de4e44">bord.link</a>--}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555" aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-555">

            <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item">
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link header-font" href="{{route('post.index')}}" >Music</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link header-font" href="{{route('video.index')}}" >Video</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link header-font" href="{{route('article.index')}}" >Articles</a>
                    </li>           
                    <li class="nav-item">
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link header-font" href="{{route('blog.index')}}" >Blog</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link" href="{{url('/contacts')}}" >Contacts</a>
                    </li>
            
            @guest
                    {{-- <li class="nav-item">
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link header-font" href="{{route('post.index')}}" >Music</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link header-font" href="{{route('video.index')}}" >Video</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link header-font" href="{{route('article.index')}}" >Articles</a>
                    </li>           
                    <li class="nav-item">
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link header-font" href="{{route('blog.index')}}" >Blog</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link" href="{{url('/contacts')}}" >Contacts</a>
                    </li> --}}
            <li class="nav-item ">
                <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link" href="{{ route('register') }}">{{ __('Registration') }}</a>
            </li>
            @endif
                @else
                <li class="nav-item dropdown">
                    <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " id="navbarDropdown"  class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        
                        @if(\Auth::user()->role_id != 1)
                        <a class="dropdown-item nav-item"  href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        @else
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="dropdown-item nav-item"  href="{{ route('home') }}">
                            {{ __('Home') }}
                        </a>
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                        </a>
                        @endif
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        </div>
    </nav>
    <!--/.Navbar -->
</div>

<div class="container ">
    @yield('content')
</div>


<div class="container">
    <!-- Footer -->
    <footer class="container py-5">
        <div class="row">
            <div class="col-12 col-md text-left">
                <small class="d-block mb-3 text-muted">&copy; 2020 bord.link</small>
                <!-- uSocial -->
                <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>
                <div class="uSocial-Share" data-pid="08162c357c37bd69da6f9509315d408b" data-type="share" data-options="round-rect,style3,default,absolute,horizontal,size32,eachCounter0,counter0,upArrow-right,nomobile" data-social="vk,twi,fb,telegram"></div>
                <!-- /uSocial -->
            </div>
            <div class="col-6 col-md">
                <h5>Information</h5>
                <ul class="list-unstyled text-small">
                    {{-- <li><a class="text-muted" href="{{route('about')}}">What do we offer</a></li> --}}
                    {{--            <li><a class="text-muted" href="{{route('rules')}}">Rules</a></li>--}}
                    <li><a class="text-muted" href="{{url('/contacts')}}">Contacts</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Our projects</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="http://bord.link/">bord.link</a></li>
{{--                    <li><a class="text-muted" href="#">App</a></li>--}}
{{--                    <li><a class="text-muted" href="#">Podcast</a></li>--}}

                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Join us</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Vkontakte</a></li>
                    <li><a class="text-muted" href="#">Instagram</a></li>
                    <li><a class="text-muted" href="#">Facebook</a></li>
                    <li><a class="text-muted" href="#">Twitter</a></li>

                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Account</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Login</a></li>
                    <li><a class="text-muted" href="#">Registration</a></li>

                </ul>
            </div>
        </div>
    </footer>
    <!-- Footer -->
</div>

</body>
</html>
