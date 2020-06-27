<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
{{--    <title>BORD!MAG @yield('title')</title>--}}
    <title>{{$user->name}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{$user->about}}"/>
    <meta name="keywords" content="Punk, Punk-Rock, best new albums, best songs, top new songs, hot new songs, songs of 2020, discover new music, find new music, new songs, new music, new cd releases, new music releases, new releases now, 2020 albums, 2020 cds, top songs, hot songs"/>

    <!-- Open Graph tags-->
    <meta property="og:title" content="{{$user->name}}" />
    <meta property="og:url" content="http://www.bordmagazine.ru" />
    <meta property="og:site_name" content="BORD!MAG" />
    <meta property="og:description" content="{{$user->about}}" />
    <meta property="og:image" content="{{$user->avatar}}"/>
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

<div class="modal fade" id="mobileNav" tabindex="-1" role="dialog" aria-labelledby="mobileNav" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5>Share link</h5>
                <input id="foo{{$user->id}}" value="{{route('profile', ['id' => $user->id])}}" style="width: 100%">
                <h6 style="display: none; margin: 0; color: #2fa360" id="showCopyAccountLink">Copy</h6>
                <br>
                <!-- Trigger -->
                <button id="copyAccountLink" class="btn btn-sm mt-2" data-clipboard-target="#foo{{$user->id}}">
                    Copy link<i class="ml-1 fas fa-copy"></i>
                </button>
                <h5 class="mt-2">Share this page with friends</h5>
                <!-- uSocial -->
                <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>
                <div class="uSocial-Share" data-pid="4de7c49aa36779d3776b505ae3bf22cd" data-type="share" data-options="round-rect,style3,default,absolute,horizontal,size32,eachCounter1,counter0,nomobile" data-social="vk,twi,fb,telegram"></div>
                <!-- /uSocial -->
                <h5 class="mt-3">Go to Main page</h5>
                <a href="{{route('musics')}}"><img src="{{asset('img/logo4.png')}}" class="img-fluid mb-1" width="120px;"></a>
            </div>
        </div>
    </div>
</div>

<!--Navbar | Not a mobile version-->
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
<!--/.Navbar -->

<!-- Modal -->
@if(Auth::check())
    @if(Auth::user()->id == $user->id)
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <p><h4 class="display-4 information"><b>Settings</b></h4></p>
                        <p><a href="{{route('editProfile', ['id' => Auth::user()->id])}}">Edit profile</a></p>
                        <p><a href="{{route('allVideo', ['id' => $user->id])}}">Add video</a></p>
                        <p><a href="{{route('allAlbums', ['id' => $user->id])}}">Add playlist</a></p>
                        <p><a href="{{route('events', ['id' => $user->id])}}">Add event</a></p>
                        <form action="{{route('deleteUser', ['id' => Auth::user()->id])}}" method="post">
                            @csrf @method('DELETE')
                            <input type="submit" value="Delete page" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
<!-- End Modal-->

<!--Content -->
<div class="container content">
    <div class="col-lg-12">
        <div class="row" >
            <!--Banner -->
            @if($user->banner)
                <div class="col-lg-12 d-none d-xl-block">
                    <div class="card-img card-img__max mb-4 banner img-fluid marginbottom" style="background-image: url({{$user->banner ?? asset('img/default_banner.jpg')}});"></div>
                </div>
                <div class="col-lg-12 d-lg-none" style="padding: 0">
                    <img src="{{$user->banner}}" class="img-fluid">
                </div>
            @endif
            <!--End Banner -->

            <!-- Left Column -->
            <div class="col-lg-4 menu left-column" id="menu" >
                <section class="sticky-top">
                    <!--Card -->
                    <div class="card" style="margin-bottom: 5px">
                        <div class="card-body">
                            <div class="media">
                                <div>
                                    <div class="img" style="background-image: url({{$user->avatar ?? asset('img/default-ava.jpg')}});"></div>
                                </div>

                                <div class="media-body d-none d-xl-block">
                                    <p><h4 class="display-4 brand"><b>{{$user->name}}</b></h4></p>
                                    <p class="text-muted mb-0">{{$user->status}}
                                        @if($user->verify)
                                            <img src="{{asset('img/verify.png')}}" class="img-fluid ml-2" width="20px" title="Verified Page">
                                        @endif
                                    </p>
                                </div>

                                <div class="media-body d-lg-none">
                                    <p><h4 class="display-4 brand"><b>{{$user->name}}</b>
                                        @if($user->verify)
                                            <img src="{{asset('img/verify.png')}}" class="img-fluid ml-2 " width="20px" title="Verified Page" style="margin-bottom: 5px">
                                        @endif
                                    </h4>
                                    <h6 class="text-muted mb-0">{{$user->status}}</h6>
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!--End Card -->
                    @if($user->city || $user->country || $user->about || $user->site || $user->vk || $user->insta || $user->facebook || $user->twitter)
                    <div class="card d-none d-xl-block" style="margin-bottom: 5px">
                        <div class="card-body" style="padding-top: 5px; padding-bottom: 5px">
                            <div >
                                <p class="information text-center">Information</p>
                                @if($user->city || $user->country)
                                    <p><h4 class="display-4 information2 text-center">
                                        @if($user->city)
                                            {{$user->city}}
                                        @endif
                                        @if($user->city && $user->country)
                                            ,
                                        @endif
                                        @if($user->country)
                                                {{$user->country}}
                                        @endif
                                    </h4></p>
                                @endif
                                @if($user->about)
                                    <p><h4 class="display-4 information2 text-center"> {{$user->about}}</h4></p>
                                @endif
                                @if($user->site)
                                    <p><h4 class="display-4 information2 text-center"><a href="{{$user->site}}">{{$user->site}}</a></h4></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($user->city || $user->country || $user->about || $user->site)
                        <div class="card d-lg-none" style="margin-bottom: 5px">
                            <div class="card-body" style="padding-top: 5px; padding-bottom: 5px">
                                <div >
{{--                                    <p class="information text-center">Информация</p>--}}
                                    @if($user->city && $user->country)
                                        <p><h4 class="display-4 information2 text-center"> {{$user->city}}, {{$user->country}}</h4></p>
                                    @endif
                                    @if($user->about)
                                        <p><h4 class="display-4 information2 text-center"> {{$user->about}}</h4></p>
                                    @endif
                                    @if($user->site)
                                        <p><h4 class="display-4 information2 text-center"><a href="{{$user->site}}">{{$user->site}}</a></h4></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($events->count())
                        <div class="card mb-2">
                            <h4 style="font-size: 1.5rem;" class="text-center mt-2">Events list</h4>
                            <ul class="list-group list-group-flush">
                                @foreach($events as $event)

                                    <li class="list-group-item list-group-item-action" >
                                        <div class="row">
                                            <div class="col-6 col-sm-10 col-md-10 col-lg-6 col-xl-6 text-left">
                                                <a href="{{route('event', ['id'=>$user->id, 'event'=>$event->id])}}" style="color: black">
                                                    <p style="font-size: 1rem; padding: 0; margin: 0"><b>{{$event->city}}</b></p>
{{--                                                    <p style="font-size: 0.9rem; margin-bottom: 0">{{$event->eventdata}}</p>--}}
                                                    <p style="font-size: 0.9rem; margin-bottom: 0">{{\Carbon\Carbon::parse($event->eventdata)->format('d/m/Y')}}</p>
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-2 col-md-2 col-lg-6 col-xl-6 text-right align-self-center">
                                                <a href="{{route('event', ['id'=>$user->id, 'event'=>$event->id])}}"><button type="button" class="btn" style="background-color: #00a9e9; color: white">Tickets <i class="fa fa-check"></i></button></a>
                                            </div>
                                        </div>
                                    </li>

                                @endforeach
                            </ul>

                            <div class="text-right mt-2">
                                <a href="{{route('events', ['id' => $user->id])}}"><h6 class="mr-4" style="color: #1b1e21">Show all<img src="{{asset('img/right.png')}}" width="11"></h6></a>
                            </div>

                        </div>
                    @endif

                <!-- Playlist -->
                    @if($mainAlbum->count())
                        <div class="card d-none d-xl-block">
                            <a href="{{route('allAlbums', ['id' => $user->id])}}"><h1 class="mt-2 mb-2" style="font-size: 0.9rem; margin-left: 5px; color: black;">All playlists<img src="{{asset('img/right.png')}}" width="11"> </h1></a>
                            @foreach($mainAlbum as $album)
                                <a href="{{route('album', ['id' => $user->id, 'album' => $album->id])}}"><img src="{{$album->cover}}" class="img-fluid"></a>
                            @endforeach
                        </div>
                    @endif

                <!-- Video -->
                    @if($mainVideo->count())
                        <div class="card d-none d-xl-block">
                            <a href="{{route('allVideo', ['id' => $user->id])}}"><h1 class="mt-2 mb-2" style="font-size: 0.9rem; margin-left: 5px; color: black;">All videos <img src="{{asset('img/right.png')}}" width="11"> </h1></a>
                            @foreach($mainVideo as $video)
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{!!$video->video!!}" allowfullscreen></iframe>
                                </div>
                            @endforeach
                        </div>
                    @endif

                <!-- Mobile playlist and video -->
                    @if($mainAlbum->count() || $mainVideo->count())
                    <nav class="d-lg-none">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @if($mainAlbum->count())
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Playlists</a>
                            @endif
                            @if($mainVideo->count())
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Videos</a>
                            @endif
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            @if($mainAlbum->count())
                                <div class="card d-lg-none">
                                    <a href="{{route('allAlbums', ['id' => $user->id])}}"><h1 class="mt-2 mb-2" style="font-size: 0.9rem; margin-left: 15px; color: black;">All playlists<img src="{{asset('img/right.png')}}" width="11"> </h1></a>
                                    @foreach($mainAlbum as $album)
                                        <a href="{{route('album', ['id' => $user->id, 'album' => $album->id])}}"><img src="{{$album->cover}}" class="img-fluid"></a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            @if($mainVideo->count())
                                <div class="card d-lg-none">
                                    <a href="{{route('allVideo', ['id' => $user->id])}}"><h1 class="mt-2 mb-2" style="font-size: 0.9rem; margin-left: 15px; color: black;">All videos <img src="{{asset('img/right.png')}}" width="11"> </h1></a>
                                    @foreach($mainVideo as $video)
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="{!!$video->video!!}" allowfullscreen></iframe>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
                <!-- End Mobile playlist and video -->


                <!-- Personal settings -->
{{--                    @if(Auth::check())--}}
{{--                        @if(Auth::user()->id == $user->id)--}}
{{--                            <div class="card d-none d-xl-block">--}}
{{--                                <div class="card-body">--}}
{{--                                    <div >--}}
{{--                                        <p><h4 class="display-4 information"><b>Настройки</b></h4></p>--}}
{{--                                        <p><a href="{{route('editProfile', ['id' => Auth::user()->id])}}">Редактировать профиль</a></p>--}}
{{--                                        <p><a href="{{route('allVideo', ['id' => $user->id])}}">Добавить видеозапись</a></p>--}}
{{--                                        <p><a href="{{route('allAlbums', ['id' => $user->id])}}">Добавить плейлист</a></p>--}}
{{--                                        <p><a href="{{route('events', ['id' => $user->id])}}">Добавить мероприятие</a></p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    @endif--}}

                <!-- Copypast -->
                    <div class="card-body mb-5 order-last d-none d-xl-block">
                        <div>
                            <p><h4 style="font-size: 0.7rem;" class="text-center">©2020 BORD!MAG.</h4></p>
                        </div>
                    </div>

                </section>
            </div>
            <!-- EndLeft Column -->

            <!-- Right Column -->
            <div class="col-lg-8 right-column" >

                <div class="card">


                    @if(Auth::check())
                        @if(Auth::user()->id == $user->id)
                            <div class="mt-1 mb-1 mr-1 ml-1" style="padding-left: 0; padding-right: 0">
                                <div class="input-group">

                                    <div style="display: none" id="errors">
                                        <p><h6>Hey, where did the spammer go? So far, no more than 20 posts per day are possible. </h6></p>
                                    </div>
                                    <div style="display: none" id="null">
                                        <p><h6>Why send an empty form?</h6></p>
                                    </div>
                                    <div style="display: none" id="fileSize">
                                        <p><h6>What a great. Image size should not exceed 5 mb</h6></p>
                                    </div>



                                    <form action="{{route('profile.store', ['id' => Auth::user()->id])}}" method="post" enctype="multipart/form-data" id="form">
                                        @csrf
                                        <textarea maxlength="100" class="form-control" id="title" name="title" cols="100" rows="1" placeholder="Title, if there is one"></textarea>
                                        <textarea maxlength="5000" class="form-control mt-1" id="message" name="message" cols="100" rows="4" placeholder="What are you thinking about?"></textarea>
                                        <textarea maxlength="100" class="form-control mt-1" id="videoPost" name="videoPost" cols="100" rows="1" placeholder="Embed video youtube.com/watch?v=eVTXPUF4Oz4"></textarea>
                                        <h6 id="bar"> </h6>
                                        <h6 id="count" style="margin: 0">5000</h6>
                                        <div class="row" style="margin: 0">
                                            <div class="col-6 text-left image-upload" style="padding: 0">
                                                <label for="img" style="margin: 0">
                                                    <img src="{{asset('img/footer/img.png')}}" class="img-fluid mt-1" width="30"/>
                                                </label>
                                                <input type="file" id="img" name="img" class="mt-2" accept="image/*">
                                            </div>
                                            <div class="col-6 text-right" style="padding: 0">
                                                <button type="submit" id="btn" class="btn btn-outline-dark btn-sm mt-1">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endif
                    <div id="deletePost">

                    </div>
                    <div class="infinite-scroll" id="textpost">
                        @foreach($posts as $post)

                            <!-- Modal Edit Post-->
                                <div class="modal fade" id="editPost{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="editPost" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" id="postEdit">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit post</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('editPost', ['id' => $user->id, 'postId' => $post->id])}}" method="post" enctype="multipart/form-data" id="form" name="postForm">
                                                    @csrf @method('PATCH')
                                                    <div class="form-group">
                                                        <textarea maxlength="100" name="title" class="form-control" rows="1">{{$post->title}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea id="message" maxlength="5000" name="message" class="form-control" rows="10">{{$post->message}}</textarea>
                                                        <small>Maximum number of characters 5000</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea maxlength="100" class="form-control mt-1" id="videoPost" name="videoPost" cols="100" rows="1">{{$post->videoPost}}</textarea>
                                                    </div>
                                                    <h6>Current image</h6>
                                                    <img src="{{$post->img}}" class="img-fluid mb-2" width="230">
                                                    <div class="form-group">
                                                        <input type="file" id="img" name="img" value="{{$post->img}}" accept="image/*">
                                                        <p><small>Max file size 5mb(jpeg,png,gif,jpg)</small></p>
                                                    </div>

                                                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- End Modal -->

                            <!-- Post Modal-->


                            <div class="modal fade" id="postModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="postModal{{$post->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content" id="postEdit">

                                        <div class="modal-body text-center">
                                            <h5>Share link</h5>
                                            <!-- Target -->
                                            <input id="foo{{$post->id}}" value="{{route('userPost', ['id' => $user->id, 'postId' => $post->id])}}" style="width: 100%">
                                            <h6 id="showCopyPostLink{{$post->id}}" style="display: none; margin: 0; color: #2fa360">Link copied!</h6>
                                            <br>
                                            <!-- Trigger -->
                                            <button id="copyPostLink{{$post->id}}" class="btn btn-sm mt-2" data-clipboard-target="#foo{{$post->id}}">
                                                Copy link<i class="ml-1 fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Post Modal-->

                            <div class="list-group-item py-4 textpost allalbums" id="textpostdata" data-id="{{$post->id}}">
                                <div class="media">
                                    <div class="img-post d-none d-xl-block" style="background-image: url({{$user->avatar ?? asset('img/default-ava.jpg')}});"></div>
                                    <div class="media-body">
                                        <div class="text-right">
                                            <img src="{{asset('img/footer/menu.png')}}" class="img-fluid" width="30" data-toggle="modal" data-target="#postModal{{$post->id}}">
                                        </div>
                                        <div class="media-heading"><small class="float-right text-muted margins"><a href="{{route('userPost', ['id' => $user->id, 'postId' => $post->id])}}" class="text-muted">{{$post->created_at->diffForHumans()}}</a></small>
                                            <h5 class="margins">{{$user->name}}
                                                @if($user->verify)
                                                    <img src="{{asset('img/verify.png')}}" class="img-fluid ml-1 mb-1" width="15px" title="He is real!">
                                                @endif
                                            </h5>
                                        </div>
                                        @if($post->img)
                                            <div>
                                                <a href="{{route('userPost', ['id' => $user->id, 'postId' => $post->id])}}" style="text-decoration: none"><img src="{{$post->img}}" class="img-fluid"></a>
                                            </div>
                                        @endif
                                        <br>
                                        @if($post->title)
                                            <div class=" mr-1 mb-3 ml-1">
                                            <a href="{{route('userPost', ['id' => $user->id, 'postId' => $post->id])}}" style="text-decoration: none"><h5 style="color: black"><b>{{$post->title}}</b></h5></a>
                                        </div>
                                        @endif
                                        @if($post->message)
                                            <a href="{{route('userPost', ['id' => $user->id, 'postId' => $post->id])}}" style="text-decoration: none"><div class="text-muted text-small margins" style="white-space: pre-wrap;">{{mb_strimwidth($post->message, 0, 600, " . . . Read more")}}</div></a>
                                        @endif
                                        @if($post->videoPost)
                                            <div class="embed-responsive embed-responsive-16by9 mt-4 mb-2">
                                                <iframe class="embed-responsive-item" src="{{$post->videoPost}}" allowfullscreen></iframe>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if(Auth::check())
                                    @if(Auth::user()->id == $user->id)
                                        <div class="text-right">
                                            <form action="{{route('deletePost', ['id' => $post->id])}}" method="post" id="formDelete">
                                                @csrf @method('DELETE')
                                                <img src="{{asset('img/footer/edit.png')}}" class="img-fluid" width="30" data-toggle="modal" data-target="#editPost{{$post->id}}">
{{--                                                <input type="button" id="edit" value="Редактировать" class="margins btn btn-sm btn-outline-secondary py-0 mt-4" data-toggle="modal" data-target="#editPost{{$post->id}}">--}}
                                                <button type="submit" id="delete" class="button-delete-post margins py-0" data-id="{{ $post->id }}"><img src="{{asset('img/footer/del.png')}}" class="img-fluid" width="30"></button>
{{--                                                <img src="{{asset('img/footer/del.png')}}" class="img-fluid" width="30">--}}
{{--                                                <a class="btn" type="submit"><img src="{{asset('img/footer/del.png')}}" class="img-fluid" width="30"></a>--}}
                                            </form>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
            <!-- End Right Column-->
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
                                <img src="{{asset('img/footer/main.png')}}" class="img-fluid" width="30" data-toggle="modal" data-target="#mobileNav">
                            </div>
                            @if($user->vk)
                            <div class="col text-center" style="padding: 0">
                                <a href="{{$user->vk}}"><img src="{{asset('img/footer/vk.png')}}" class="img-fluid " width="30"></a>
                            </div>
                            @endif
                            @if($user->facebook)
                            <div class="col text-center" style="padding: 0">
                                <a href="{{$user->facebook}}"><img src="{{asset('img/footer/fb.png')}}" class="img-fluid  " width="30"></a>
                            </div>
                            @endif
                            @if($user->twitter)
                            <div class="col text-center" style="padding: 0">
                                <a href="{{$user->twitter}}"><img src="{{asset('img/footer/tw.png')}}" class="img-fluid " width="30"></a>
                            </div>
                            @endif
                            @if($user->insta)
                            <div class="col text-center" style="padding: 0">
                                <a href="{{$user->insta}}"><img src="{{asset('img/footer/in.png')}}" class="img-fluid  " width="30"></a>
                            </div>
                            @endif
                            <div class="col text-center" style="padding: 0">
                            @if(Auth::check())
                                @if(Auth::user()->id == $user->id)
                                    <!-- Button trigger modal -->
                                        <img src="{{asset('img/footer/set.png')}}" class="img-fluid " width="30" data-toggle="modal" data-target="#exampleModal">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            debug: true,
            loadingHtml: '<img class="center-block" src="{{asset('img/loading.gif')}}" alt="Loading..." />',
            padding: 2,
            nextSelector: '.pagination li.active + li a',
            contentSelector: '.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( "#form" ).submit(function( e ) {
        e.preventDefault();

        var formData = new FormData(this); //set formData to selected instance
        var title = $('#title').val();
        var message = $('#message').val();
        var img = $('#img').val();
        var videoPost = $('#videoPost').val();
        var user_id = $('#user_id').val();

        var fileSize = document.getElementById("img");

        $.ajax({
            type: "POST",
            @if(Auth::check())
            url: "{{route('profile.store', ['id' => Auth::user()->id])}}",
            @endif
            data: formData,
            beforeSend: function(data) {
                if(title == '' && message == '' && img == '' && videoPost == '') {
                    $("#null").show();
                    return false;
                }
                $("#null").hide();
                if(fileSize.files[0].size > 5000000) {
                    $("#fileSize").show();
                    return false;
                }
                $("#fileSize").hide();
            },
            success: function (data) {
                $("#textpost").html($(data).find("#textpost").html());
                $('#title').val('').change();
                $('#message').val('').change();
                $('#img').val('').change();
                $('#videoPost').val('').change();
            },
            error: function(data) {
                $("#errors").show();
            },
            contentType: false,
            processData: false,
        });

        $("#errors").hide();

    });
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $("body").on("click","#delete",function(e){
            e.preventDefault();

            var id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "delete/"+id,
                type: 'DELETE',
                data: {_token: token, id: id},
                success: function (){
                    $("div.textpost[data-id="+id+"]").remove();
                },
            });

        });
    });
</script>

<script type="text/javascript">

    $(document).ready(function() {
        $("#message").keyup(function() {
            var message = $(this).val();
            var main = message.length *100;
            var value= (main / 5000);
            var count= 5000 - message.length;

            if(message.length <= 1500)
            {
                $('#count').html(count);
                $('#bar').animate(
                    {
                        "width": value+'%',
                    }, 1);
            }
            else
            {
                return false;
            }
            return false;
        });
    });

</script>

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
    $("#copyAccountLink").click(function() {
        $("#showCopyAccountLink").show();
    });
</script>

@foreach($posts as $post)
    <script>
        // Post link
        $("#copyPostLink{{$post->id}}").click(function() {
            $("#showCopyPostLink{{$post->id}}").show();
        });
    </script>
@endforeach

{{--<script>--}}
{{--    // Account link--}}
{{--    $("#btn").click(function() {--}}
{{--        var fileSize = document.getElementById("img");--}}
{{--        if(fileSize.files[0].size > 5000000) {--}}
{{--            $("#fileSize").show();--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}

