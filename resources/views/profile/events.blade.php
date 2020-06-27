<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{$user->name}} Tour</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{$user->name}} Tour"/>
    <meta name="keywords" content="Punk, Punk-Rock, best new albums, best songs, top new songs, hot new songs, songs of 2020, discover new music, find new music, new songs, new music, new cd releases, new music releases, new releases now, 2020 albums, 2020 cds, top songs, hot songs"/>

    <!-- Open Graph tags-->
    <meta property="og:title" content="{{$user->name}} Tour" />
    <meta property="og:url" content="http://www.bordmagazine.ru" />
    <meta property="og:site_name" content="BORD!MAG" />
    <meta property="og:description" content="{{$user->name}} Tour" />
    <meta property="og:image" content="{{$post->img_link ?? asset('img/logo4.png')}}"/>
    <meta property="og:type" content="website" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/9bd26323f9.js" crossorigin="anonymous"></script>

    <!-- Favicon-->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">

    <!-- Bootstrap and CSS-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jaldi&display=swap" rel="stylesheet">
</head>
<body>

<div class="media-heading fixed-top d-lg-none" style="background-color: rgba(255,255,255,0.9)">
    <img src="{{asset('img/footer/menu.png')}}" class="img-fluid float-right  margins" width="30" data-toggle="modal" data-target="#mobileNav">
{{--    <small class="float-right  margins" style="margin-top: 5px"></small>--}}
    <a href="{{route('profile', ['id' => $user->id])}}" style="color: black; text-decoration: none">
        <h5 class="margins mt-1" style="margin-bottom: 0">{{$user->name}}
            @if($user->verify)
                <img src="{{asset('img/verify.png')}}" class="img-fluid ml-1 mb-1" width="15px" title="Он настоящий!">
            @endif
        </h5>
    </a>
</div>

<div class="modal fade" id="mobileNav" tabindex="-1" role="dialog" aria-labelledby="mobileNav" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5>Share link</h5>
                <input id="foo" value="{{route('events', ['id' => $user->id])}}" style="width: 100%">
                <h6 id="showCopyPostLink" style="display: none; margin: 0; color: #2fa360">Link copied!</h6>
                <br>
                <!-- Trigger -->
                <button id="copyPostLink" class="btn btn-sm mt-2" data-clipboard-target="#foo">
                    Copy link<i class="ml-1 fas fa-copy"></i>
                </button>
                <h5 class="mt-2">Share</h5>
                <!-- uSocial -->
                <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>
                <div class="uSocial-Share" data-pid="4de7c49aa36779d3776b505ae3bf22cd" data-type="share" data-options="round-rect,style3,default,absolute,horizontal,size32,eachCounter1,counter0,nomobile" data-social="vk,twi,fb,telegram"></div>
                <!-- /uSocial -->

            </div>
        </div>
    </div>
</div>

<!--Navbar | No in mobile version-->
<div class="container-fluid d-none d-xl-block">
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <a class="navbar-brand" href="/"><img src="{{asset('img/logo.png')}}" class="img-fluid mb-1" width="120px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555" aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
            <ul class="navbar-nav ml-auto nav-flex-icons">
                @if(Auth::check())
                    @if(Auth::user()->avatar)
                        <li class="nav-item avatar">
                            <a class="nav-link p-0" href="#">
                                {{-- <img src="{{Auth::user()->avatar}}" height="35px" width="35px"> --}}
                                <div class="img_avatar " style="background-image: url({{Auth::user()->avatar}});"></div>
                            </a>
                        </li>
                    @endif
                @endif
                @guest
                    <li class="nav-item">
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link header-font" href="{{route('blog.index')}}" >Blog</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link" href="{{url('/contacts')}}" >Contacts</a>
                    </li>
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
                        <a id="navbarDropdown"  class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item nav-item"  href="{{route('profile', ['id' => Auth::user()->id])}}">
                                {{ __('Profile') }}
                            </a>
                            @if(\Auth::user()->role_id != 1)
                                <a class="dropdown-item nav-item"  href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            @else
                                <a class="dropdown-item nav-item"  href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
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
</div>
<!-- EndNavbar -->



<!-- Content -->
<div class="container mb-5 allalbums margTop30">
    <div class="col">
        <div class="row ">

            <!-- Banner -->
                @if($user->banner)
                <div class="col-lg-12 d-none d-xl-block" >
                    <div class="card-img card-img__max mb-4 banner img-fluid" style="background-image: url({{$user->banner}});"></div>
                </div>
                @endif
                <div class="col-12 d-lg-none allalbums" >
                    <img src="{{$user->banner}}" class="img-fluid ">
                </div>
            <!-- EndBanner -->

            <div class="col-lg-12  mt-2">
                @if(Auth::check())
                    @if(Auth::user()->id == $user->id)
{{--                        <button type="button" class="btn-outline-dark btn-sm d-none d-xl-block" data-toggle="modal" data-target="#exampleModalCenter" style="margin: 0">--}}
{{--                            Добавить мероприятие--}}
{{--                        </button>--}}

                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h4 class="text-center">Add event</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <h6 class=" mt-4 ml-3 mr-3" style="font-size: 0.8rem">Light cucumber color, highlighted fields for mandatory filling.</h6>
                                    <h6 class=" ml-3 mr-3" style="font-size: 0.8rem">For correct display, please fill in the fields for their intended purpose.</h6>
                                    <div class="modal-body">
                                        <div class=" text-left">
                                            <form action="{{route('addEvent', ['id' => Auth::user()->id])}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="file" name="cover" id="cover" accept="image/*">
                                                    <small id="emailHelp">Poster of your event, if it is of course ...</small>
                                                </div>
                                                <div class="form-group">
                                                    <input style="background-color: #CEF6CE" type="text" name="title" id="title" placeholder="ALLA PUGACHEVA IN MOSCOW" class="form-control" maxlength="100">
                                                    <small>Event title</small>
                                                </div>
                                                <div class="form-group">
                                                    <input style="background-color: #CEF6CE" type="date" name="eventdata" id="eventdata" placeholder="February 31 or 31/02/25" class="form-control" >
                                                    <small>Event date</small>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="time" id="time" placeholder="21:00" class="form-control" maxlength="10">
                                                    <small>Event Start Time</small>
                                                </div>
                                                <div class="form-group">
                                                    <input style="background-color: #CEF6CE" type="text" name="city" id="city" placeholder="Moscow" class="form-control" maxlength="50">
                                                    <small>City</small>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="address" id="address" placeholder="Star club" class="form-control" maxlength="250">
                                                    <small>Location</small>
                                                </div>
                                                <div class="form-group">
                                                    <textarea style="background-color: #CEF6CE" name="info" id="info" class="form-control" rows="2" maxlength="1000"></textarea>
                                                    <small>Any additional information</small>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="vk" id="vk" placeholder="Link to the meeting VKontakte" class="form-control" maxlength="100">
                                                    <small>Link to the meeting VKontakte</small>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="fb" id="fb" placeholder="Facebook meeting link" class="form-control" maxlength="100">
                                                    <small>Facebook meeting link</small>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="concert" id="concert" placeholder="Concert.ru" class="form-control" maxlength="100">
                                                    <small>Link to purchase tickets through the Concert.ru service. Not necessary.</small>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="yandex" id="yandex" placeholder="Yandex Afisha" class="form-control" maxlength="100">
                                                    <small>Link to purchase tickets through Yandex Poster. Not necessary.</small>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="kassir" id="kassir" placeholder="Kassir.ru" class="form-control" maxlength="100">
                                                    <small>Link to purchase tickets through the Kassir.ru service. Not necessary.</small>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="ponominalu" id="ponominalu" placeholder="Ponominalu.ru" class="form-control" maxlength="100">
                                                    <small>Link to purchase tickets through the service Ponominalu.ru. Not necessary.</small>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="ticketland" id="ticketland" placeholder="Ticketland.ru" class="form-control" maxlength="100">
                                                    <small>Link to purchase tickets through the Ticketland.ru service. Not necessary.</small>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="radario" id="radario" placeholder="Radario.ru" class="form-control" maxlength="100">
                                                    <small>Link to purchase tickets through the Radario.ru service. Not necessary.</small>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="tickets" id="tickets" placeholder="Ticket purchase link" class="form-control" maxlength="100">
                                                    <input type="text" name="youbrand" id="youbrand" placeholder="Name of your service" class="form-control" maxlength="100">
                                                    <small>Fill in these two fields only if the above distribution services
                                                        tickets do not suit you. In the first window, insert a link to direct ticket sales,
                                                        and in the second name of your service</small>
                                                </div>
                                                <button type="submit" class="btn btn-secondary btn-sm ml-2 mb-2">Add event</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            <!-- Event List -->
            <div class="col-lg-12 allalbums">
                <ul class="list-group list-group-flush">
                    @if($errors->any())
                        <div class="col-lg-12 mb-2 alert alert-danger text-center" style="margin: 0;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @foreach($errors->all() as $error)
                                <h6>{{$error}}</h6>
                            @endforeach
                        </div>
                    @endif
                    @foreach($events as $event)
                        <li class="list-group-item list-group-item-action">
                            <div class="row">
                                <div class="col-6 col-sm-10 col-md-10 col-lg-6 col-xl-6 text-left" style="padding: 0">
                                    <a href="{{route('event', ['id'=>$user->id, 'event'=>$event->id])}}" style="color: black; text-decoration: none">
                                        <p style="font-size: 1.2rem; padding: 0; margin: 0"><b>{{$event->city}}</b></p>
                                        <p style="font-size: 1rem; margin-bottom: 0">{{\Carbon\Carbon::parse($event->eventdata)->format('d/m/Y')}}</p>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-2 col-md-2 col-lg-6 col-xl-6 text-right align-self-center" style="padding: 0">
                                    <a href="{{route('event', ['id'=>$user->id, 'event'=>$event->id])}}"><button type="button" class="btn " style="background-color: #00a9e9; color: white">Tickets <i class="fa fa-check"></i></button></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- End Links -->

        </div>
    </div>
</div>
<!-- End Content -->



<!-- Mobile Footer social -->
<div class="container ">
    <div class="row ">
        <div class="col-lg-12 ">
            <nav class=" fixed-bottom " style="background-color: #e4e4e4">
                <div class="row">
                    <div class="col-12 " >
                        <div class="row">
                            <div class="col text-center" style="padding: 0">
                                <a href="{{route('musics')}}"><img src="{{asset('img/footer/main.png')}}" class="img-fluid " width="30"></a>
                            </div>
                            <div class="col text-center" style="padding: 0">
                                <a href="{{$user->vk}}"><img src="{{asset('img/footer/vk.png')}}" class="img-fluid " width="30"></a>
                            </div>
                            <div class="col text-center" style="padding: 0">
                                <a href="{{$user->facebook}}"><img src="{{asset('img/footer/fb.png')}}" class="img-fluid  " width="30"></a>
                            </div>
                            <div class="col text-center" style="padding: 0">
                                <a href="{{$user->twitter}}"><img src="{{asset('img/footer/tw.png')}}" class="img-fluid " width="30"></a>
                            </div>
                            <div class="col text-center" style="padding: 0">
                                <a href="{{$user->insta}}"><img src="{{asset('img/footer/in.png')}}" class="img-fluid  " width="30"></a>
                            </div>
                            <div class="col text-center" style="padding: 0">
                            @if(Auth::check())
                                @if(Auth::user()->id == $user->id)
                                    <!-- Button trigger modal -->
                                        <img src="{{asset('img/footer/add.png')}}" class="img-fluid" width="30" data-toggle="modal" data-target="#exampleModalCenter">
                                    @endif
                                @endif
                                @if(Auth::check())
                                    @if(Auth::user()->id != $user->id)
                                        <a href="{{route('profile', ['id' => Auth::user()->id])}}"><img class="img-footer " style="background-image: url({{Auth::user()->avatar}});"></a>
                                    @endif
                                @endif
                                @if(Auth::guest())
                                    <a href="{{route('login')}}"><img src="{{asset('img/footer/login.png')}}" class="img-fluid " width="30"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End Footer social -->

</body>
</html>

<script type="text/javascript">
    var clipboard = new ClipboardJS('.btn');

    clipboard.on('success', function(e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });
</script>

<script>
    // Account link
    $("#copyPostLink").click(function() {
        $("#showCopyPostLink").show();
    });
</script>
