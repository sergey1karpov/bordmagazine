<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{$event->title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{$event->title}}"/>
    <meta name="keywords" content="Punk, Punk-Rock, best new albums, best songs, top new songs, hot new songs, songs of 2020, discover new music, find new music, new songs, new music, new cd releases, new music releases, new releases now, 2020 albums, 2020 cds, top songs, hot songs"/>

    <!-- Open Graph tags-->
    <meta property="og:title" content="{{$event->title}}" />
    <meta property="og:url" content="http://www.bordmagazine.ru" />
    <meta property="og:site_name" content="BORD!MAG" />
    <meta property="og:description" content="{{$event->title}}" />
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
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
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
                <h5>Копировать ссылку на страницу</h5>
                <input id="foo" value="{{route('event', ['id' => $user->id, 'event' => $event->id])}}" style="width: 100%">
                <h6 id="showCopyPostLink" style="display: none; margin: 0; color: #2fa360">Ссылка скопирована</h6>
                <br>
                <!-- Trigger -->
                <button id="copyPostLink" class="btn btn-sm mt-2" data-clipboard-target="#foo">
                    Copy link<i class="ml-1 fas fa-copy"></i>
                </button>
                <h5 class="mt-2">Рассказать друзьям</h5>
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


            @if(Auth::check())
                @if(Auth::user()->id == $user->id)



                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="text-center">Edit event</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <h6 class="mt-4 ml-3 mr-3" style="font-size: 0.8rem">For correct display, please fill in the fields for their intended purpose.</h6>
                                <form class="ml-3 mr-3" method="post" action="{{route('deleteEvent', ['id' => $user->id, 'event' => $event->id])}}">
                                    @csrf @method('DELETE')
                                    <h6 class="" style="font-size: 0.8rem">Button to delete an event</h6>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <div class="modal-body">
                                    <div class="text-left">
                                        <form action="{{route('editEvent', ['id' => Auth::user()->id, 'event' => $event->id])}}" method="post" enctype="multipart/form-data">
                                            @csrf @method('PATCH')
                                            <div class="form-group">
                                                <input type="file" name="cover" value="{{$event->cover}}" accept="image/*">
                                                <small id="emailHelp" class="form-text">Poster of your event, if it is of course ...</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="100" type="text" name="title" id="title" value="{{$event->title}}" placeholder="ALLA PUGACHEVA IN MOSCOW" class="form-control" >
                                                <small>Event title</small>
                                            </div>
                                            <div class="form-group">
                                                <input type="date" name="eventdata" id="eventdata" value="{{$event->eventdata}}" placeholder="February 31" class="form-control" >
                                                <small>Event data</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="10" type="text" name="time" id="time" value="{{$event->time}}" placeholder="21:00" class="form-control" >
                                                <small>Event Start Time</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="50" type="text" name="city" id="city" value="{{$event->city}}" placeholder="Moscow" class="form-control" >
                                                <small>City</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="250" type="text" name="address" id="address" value="{{$event->address}}" placeholder="Star club" class="form-control" >
                                                <small>Location</small>
                                            </div>
                                            <div class="form-group">
                                                <textarea maxlength="1000" name="info" id="info" class="form-control" rows="2">{{$event->info}}</textarea>
                                                <small>Any additional information</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="100" type="text" name="vk" id="vk" value="{{$event->vk}}" placeholder="Link to the meeting VKontakte" class="form-control" >
                                                <small>Link to the meeting VKontakte</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="100" type="text" name="fb" id="fb" value="{{$event->fb}}" placeholder="Facebook meeting link" class="form-control" >
                                                <small>Facebook meeting link</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="100" type="text" name="concert" id="concert" value="{{$event->concert}}" placeholder="Concert.ru" class="form-control" >
                                                <small>Link to purchase tickets through the Concert.ru service. Not necessary.</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="100" type="text" name="yandex" id="yandex" value="{{$event->yandex}}" placeholder="Yandex Afisha" class="form-control" >
                                                <small>Link to purchase tickets through Yandex Poster. Not necessary.</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="100" type="text" name="kassir" id="kassir" value="{{$event->kassir}}" placeholder="Kassir.ru" class="form-control" >
                                                <small>Link to purchase tickets through the Kassir.ru service. Not necessary.</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="100" type="text" name="ponominalu" id="ponominalu" value="{{$event->ponominalu}}" placeholder="Ponominalu.ru" class="form-control" >
                                                <small>Link to purchase tickets through the service Ponominalu.ru. Not necessary.</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="100" type="text" name="ticketland" id="ticketland" value="{{$event->ticketland}}" placeholder="Ticketland.ru" class="form-control" >
                                                <small>Link to purchase tickets through the Ticketland.ru service. Not necessary.</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="100" type="text" name="radario" id="radario" value="{{$event->radario}}" placeholder="Radario.ru" class="form-control" >
                                                <small>Link to purchase tickets through the Radario.ru service. Not necessary.</small>
                                            </div>
                                            <div class="form-group">
                                                <input maxlength="100" type="text" name="tickets" id="tickets" value="{{$event->tickets}}" placeholder="Ticket purchase link" class="form-control" >
                                                <input maxlength="100" type="text" name="youbrand" id="youbrand" value="{{$event->youbrand}}" placeholder="Name of your service" class="form-control" >
                                                <small>Fill in these two fields only if the above distribution services
                                                    tickets do not suit you. In the first window, insert a link to direct ticket sales,
                                                    and in the second name of your service</small>
                                            </div>
                                            <button type="submit" class="btn btn-secondary btn-sm ml-2 mb-2">Update</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            @endif

<!-- End Mobile Navbar-->

<!-- Content -->
<div class="container d-none d-xl-block" style="margin-bottom: 100px">
    <div class="col">
        <div class="row">

            <!-- Banner -->
            <div class="col-lg-12">
                @if($user->banner)
                    <div class="card-img card-img__max mb-4 banner img-fluid" style="background-image: url({{$user->banner}});"></div>
                @endif
                    <!-- Button trigger modal -->
                @if(Auth::check())
                    @if(Auth::user()->id == $user->id)

{{--                        <div class="row ">--}}
{{--                            <div class="col-lg-2 align-self-center">--}}
{{--                                <button type="button" class="btn btn-sm btn btn-secondary mb-3" data-toggle="modal" data-target="#exampleModalCenter">--}}
{{--                                    Редактировать страницу--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-2">--}}
{{--                                <form class="" method="post" action="{{route('deleteEvent', ['id' => $user->id, 'event' => $event->id])}}">--}}
{{--                                    @csrf @method('DELETE')--}}
{{--                                    <button type="submit" class="btn btn-sm btn btn-secondary mb-3">Удалить мероприятие</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}


                    @endif
                @endif
            </div>

            <!-- EndBanner -->

            <div class="col-lg-12 text-center mt-2">
                @if($errors->any())
                    <div class="col-lg-12 alert alert-danger text-center mb-1" style="margin: 0;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        @foreach($errors->all() as $error)
                            <h6 class="text-center">{{$error}}</h6>
                        @endforeach
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-6 text-left">
                        <img src="{{$event->cover}}" width="500">
                        <h2 style="margin: 0; font-family: 'Russo One', sans-serif;" class="mt-1 ml-1 mr-1"><b>{{$event->title}}</b></h2>
                        <h3 class="ml-1" style="margin-bottom: 0; font-family: 'Montserrat', sans-serif;">{{$event->city}} @if($event->address) | @endif {{$event->address}}</h3>
                        <h5 class="ml-1" style="font-family: 'Montserrat', sans-serif;">{{\Carbon\Carbon::parse($event->eventdata)->format('d/m/Y')}} @if($event->time)в {{$event->time}}@endif</h5>
                        <h6 style="white-space: pre-wrap;" class="ml-1 mr-1 mt-1">{{$event->info}}</h6>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="text-center mb-2">Tickets</h4>
                        <ul class="list-group list-group-flush mt-2">
                            @if($event->kassir)
                                <li class="list-group-item list-group-item-action">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex align-items-center">
                                                <a href="{{$event->kassir}}"><img src="{{asset('img/event/cassir.png')}}" width="40"></a>
                                                <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Kassir.ru</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1">
                                            <a href="{{$event->kassir}}" class="btn  btn-outline-dark ">Buy</a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($event->yandex)
                                <li class="list-group-item list-group-item-action">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex align-items-center">
                                                <a href="{{$event->yandex}}"><img src="{{asset('img/event/yandex.png')}}" width="40"></a>
                                                <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Яндекс Афиша</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1">
                                            <a href="{{$event->yandex}}" class="btn  btn-outline-dark ">Buy</a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($event->concert)
                                <li class="list-group-item list-group-item-action">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex align-items-center">
                                                <a href="{{$event->concert}}"><img src="{{asset('img/event/koncert.png')}}" width="40"></a>
                                                <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Concert.ru</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1">
                                            <a href="{{$event->concert}}" class="btn  btn-outline-dark ">Buy</a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($event->ponominalu)
                                <li class="list-group-item list-group-item-action">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex align-items-center">
                                                <a href="{{$event->ponominalu}}"><img src="{{asset('img/event/ponominaly.png')}}" width="40"></a>
                                                <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Ponominalu.ru</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1">
                                            <a href="{{$event->ponominalu}}" class="btn  btn-outline-dark ">Buy</a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($event->ticketland)
                                <li class="list-group-item list-group-item-action">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex align-items-center">
                                                <a href="{{$event->ticketland}}"><img src="{{asset('img/event/ticketland.png')}}" width="40"></a>
                                                <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Ticketland.ru</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1">
                                            <a href="{{$event->ticketland}}" class="btn  btn-outline-dark ">Buy</a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($event->radario)
                                <li class="list-group-item list-group-item-action">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex align-items-center">
                                                <a href="{{$event->radario}}"><img src="{{asset('img/event/radario.png')}}" width="40"></a>
                                                <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Radario.ru</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1">
                                            <a href="{{$event->radario}}" class="btn  btn-outline-dark ">Buy</a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($event->tickets)
                                <li class="list-group-item list-group-item-action">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex align-items-center">
                                                <a href="{{$event->tickets}}"><img src="{{asset('img/event/other.png')}}" width="40"></a>
                                                @if($event->youbrand)
                                                    <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">{{$event->youbrand}}</h4>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1">
                                            <a href="{{$event->tickets}}" class="btn  btn-outline-dark ">Buy</a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>

                        @if($event->vk || $event->fb)
                            <h4 class="text-center mb-2 mt-2">Social links</h4>
                            <ul class="list-group list-group-flush mt-2">
                                @if($event->vk)
                                    <li class="list-group-item list-group-item-action">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{$event->vk}}"><img src="{{asset('img/event/vk.png')}}" width="40"></a>
                                                    <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">VK</h4>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1">
                                                <a href="{{$event->vk}}" class="btn  btn-outline-dark ">Join</a>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                    @if($event->fb)
                                        <li class="list-group-item list-group-item-action">
                                            <div class="row">
                                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{$event->fb}}"><img src="{{asset('img/event/fb.png')}}" width="40"></a>
                                                        <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">VK</h4>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1">
                                                    <a href="{{$event->fb}}" class="btn  btn-outline-dark ">Join</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                            <ul>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Content -->






<!-- Mobile Content -->

<div class="container mb-5 d-lg-none" style="padding: 0; margin-top: 30px">
    <div class="col" >
        @if($errors->any())
            <div class="col-lg-12 alert alert-danger mb-2 text-center" style="margin: 0;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach($errors->all() as $error)
                    <h6>{{$error}}</h6>
                @endforeach
            </div>
        @endif
        <div class="row">

            <div class="col-lg-12 text-center" style="padding: 0">
                <img src="{{$event->cover}}" class="img-fluid">
                <h2 style="margin: 0; font-family: 'Russo One', sans-serif;" class="mt-1 ml-1 mr-1"><b>{{$event->title}}</b></h2>
                <h3 class="ml-1" style="margin-bottom: 0; font-family: 'Montserrat', sans-serif;">{{$event->city}} | {{$event->address}}</h3>
                <h5 class="ml-1" style="font-family: 'Montserrat', sans-serif;">{{\Carbon\Carbon::parse($event->eventdata)->format('d/m/Y')}} @if($event->time)в {{$event->time}}@endif</h5>

{{--                <div class="col-12" style="padding: 0; margin: 0">--}}
{{--                    @if($event->vk)--}}
{{--                        <a href="{{$event->vk}}"><img src="{{asset('img/event/vk.png')}}" class="img-fluid" width="40"></a>--}}
{{--                    @endif--}}
{{--                    @if($event->fb)--}}
{{--                        <a href="{{$event->fb}}"><img src="{{asset('img/event/fb.png')}}" class="img-fluid" width="40"></a>--}}
{{--                    @endif--}}
{{--                </div>--}}

            </div>

            <div class="col-lg-12 ml-1 mr-1 mt-2" style="padding: 0">
                <h6 style="white-space: pre-wrap;" class="ml-1 mr-1">{{$event->info}}</h6>
            </div>

            <div class="col-lg-12 ml-1 mr-1 text-center mb-3 mt-3" style="padding: 0">

                    <a class="btn btn-sm btn-success" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <h5 class="ml-1 mr-1 mt-1 mb-1">Venue<i class="fas fa-plus ml-3"></i></h5>
                    </a>
                <div class="collapse mt-3" id="collapseExample">
                    <div class="col-lg-12 ml-1 mr-1 mb-3" style="padding: 0">
                        <ul class="list-group list-group-flush">
                            @if($event->vk)
                                <li class="list-group-item list-group-item-action">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-left: 0px; padding-right: 0px">
                                            <div class="d-flex align-items-center">
                                                <a href="{{$event->vk}}"><img src="{{asset('img/event/vk.png')}}" width="40"></a>
                                                <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">VK</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1" style="padding-left: 0px; padding-right: 0px">
                                            <a href="{{$event->vk}}" class="btn  btn-outline-dark ">Join</a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($event->vk)
                                <li class="list-group-item list-group-item-action">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-left: 0px; padding-right: 0px">
                                            <div class="d-flex align-items-center">
                                                <a href="{{$event->fb}}"><img src="{{asset('img/event/fb.png')}}" width="40"></a>
                                                <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Facebook</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1" style="padding-left: 0px; padding-right: 0px">
                                            <a href="{{$event->fb}}" class="btn  btn-outline-dark ">Join</a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 ml-1 mr-1 text-center" style="padding: 0">
                <h5 class="ml-1 mr-1 mt-1">To buy a ticket</h5>
            </div>
            <div class="col-lg-12 ml-1 mr-1 mb-3" style="padding: 0">
                <ul class="list-group list-group-flush">
                    @if($event->kassir)
                    <li class="list-group-item list-group-item-action">
                        <div class="row">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-left: 0px; padding-right: 0px">
                                <div class="d-flex align-items-center">
                                    <a href="{{$event->kassir}}"><img src="{{asset('img/event/cassir.png')}}" width="40"></a>
                                    <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Kassir.ru</h4>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1" style="padding-left: 0px; padding-right: 0px">
                                <a href="{{$event->kassir}}" class="btn  btn-outline-dark ">Buy</a>
                            </div>
                        </div>
                    </li>
                    @endif
                    @if($event->yandex)
                    <li class="list-group-item list-group-item-action">
                        <div class="row">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-left: 0px; padding-right: 0px">
                                <div class="d-flex align-items-center">
                                    <a href="{{$event->yandex}}"><img src="{{asset('img/event/yandex.png')}}" width="40"></a>
                                    <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Яндекс Афиша</h4>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1" style="padding-left: 0px; padding-right: 0px">
                                <a href="{{$event->yandex}}" class="btn  btn-outline-dark ">Buy</a>
                            </div>
                        </div>
                    </li>
                    @endif
                    @if($event->concert)
                    <li class="list-group-item list-group-item-action">
                        <div class="row">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-left: 0px; padding-right: 0px">
                                <div class="d-flex align-items-center">
                                    <a href="{{$event->concert}}"><img src="{{asset('img/event/koncert.png')}}" width="40"></a>
                                    <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Concert.ru</h4>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1" style="padding-left: 0px; padding-right: 0px">
                                <a href="{{$event->concert}}" class="btn  btn-outline-dark ">Buy</a>
                            </div>
                        </div>
                    </li>
                    @endif
                        @if($event->ponominalu)
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-left: 0px; padding-right: 0px">
                                        <div class="d-flex align-items-center">
                                            <a href="{{$event->ponominalu}}"><img src="{{asset('img/event/ponominaly.png')}}" width="40"></a>
                                            <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Ponominalu.ru</h4>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1" style="padding-left: 0px; padding-right: 0px">
                                        <a href="{{$event->ponominalu}}" class="btn  btn-outline-dark ">Buy</a>
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if($event->ticketland)
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-left: 0px; padding-right: 0px">
                                        <div class="d-flex align-items-center">
                                            <a href="{{$event->ticketland}}"><img src="{{asset('img/event/ticketland.png')}}" width="40"></a>
                                            <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Ticketland.ru</h4>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1" style="padding-left: 0px; padding-right: 0px">
                                        <a href="{{$event->ticketland}}" class="btn  btn-outline-dark ">Buy</a>
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if($event->radario)
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-left: 0px; padding-right: 0px">
                                        <div class="d-flex align-items-center">
                                            <a href="{{$event->radario}}"><img src="{{asset('img/event/radario.png')}}" width="40"></a>
                                            <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">Radario.ru</h4>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1" style="padding-left: 0px; padding-right: 0px">
                                        <a href="{{$event->radario}}" class="btn  btn-outline-dark ">Buy</a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @if($event->tickets)
                    <li class="list-group-item list-group-item-action">
                        <div class="row">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-left: 0px; padding-right: 0px">
                                <div class="d-flex align-items-center">
                                    <a href="{{$event->tickets}}"><img src="{{asset('img/event/other.png')}}" width="40"></a>
                                    @if($event->youbrand)
                                    <h4 style="font-size: 1rem; color: #1b1e21; margin-top: 10px" class="ml-3">{{$event->youbrand}}</h4>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text text-right mt-1" style="padding-left: 0px; padding-right: 0px">
                                <a href="{{$event->tickets}}" class="btn  btn-outline-dark ">Buy</a>
                            </div>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>

        </div>
    </div>
</div>

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
                                        <img src="{{asset('img/footer/edit.png')}}" class="img-fluid" width="30" data-toggle="modal" data-target="#exampleModalCenter">
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
