<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{$user->name}} releases</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{$user->name}} releases"/>
    <meta name="keywords" content="Punk, Punk-Rock, best new albums, best songs, top new songs, hot new songs, songs of 2020, discover new music, find new music, new songs, new music, new cd releases, new music releases, new releases now, 2020 albums, 2020 cds, top songs, hot songs"/>

    <!-- Open Graph tags-->
    <meta property="og:title" content="{{$user->name}} releases" />
    <meta property="og:url" content="http://www.bordmagazine.ru" />
    <meta property="og:site_name" content="BORD!MAG" />
    <meta property="og:description" content="{{$user->name}} releases" />
    <meta property="og:image" content="{{$post->img_link ?? asset('img/logo4.png')}}"/>
    <meta property="og:type" content="website" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/9bd26323f9.js" crossorigin="anonymous"></script>

    <!-- Favicon-->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">

    <!-- Bootstrap and CSS-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
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
                <input id="foo" value="{{route('allAlbums', ['id' => $user->id])}}" style="width: 100%">
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

<!--Navbar -->
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
                                        <div class="img_avatar" style="background-image: url({{Auth::user()->avatar}});"></div>
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




<div class="container container mb-5 allalbums margTop30" >
    <div class="col">
        <div class="">
            <div class="row">

                @if($user->banner)
                    <div class="col-lg-12 d-none d-xl-block">
                        <div class="card-img card-img__max mb-4 banner img-fluid" style="background-image: url({{$user->banner}});"></div>
                    </div>
                @endif

                <!-- Right Column -->
                <div class="col-lg-12 allalbums">




                    @if(Auth::check())
                    @if(Auth::user()->id == $user->id)
{{--                    <button type="button" class="btn-outline-dark btn-sm mb-4 d-none d-xl-block" data-toggle="modal" data-target="#exampleModalCenter">--}}
{{--                        Загрузить альбом--}}
{{--                    </button>--}}
                    @endif
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Download playlist</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="">
                                <form action="{{route('addProfileAlbums', ['id' => Auth::user()->id])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input maxlength="100" type="text" name="audioTitle" id="audioTitle" placeholder="Band \ Artist - Album Title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input accept="image/*" type="file" name="cover" id="cover">
                                        <small id="emailHelp" class="form-text text-muted">download cover</small>
                                    </div>
                                    <div class="form-group">
                                        <textarea maxlength="1000" name="info" id="info" class="form-control" rows="2">...</textarea>
                                        <small id="emailHelp" class="form-text text-muted ml-2 mt-2">In this field you can specify any additional information</small>
                                    </div>
                                    <div class="form-group">
                                        <textarea maxlength="1000" name="playlist" id="playlist" class="form-control" rows="2">Paste your player code here</textarea>
                                        <small id="emailHelp" class="form-text text-muted ml-2 mt-2">Before downloading audio, read the instructions on how to do it right</small>
                                    </div>
                                    Links for listening or buying an album
                                    <div class="form-group">
                                        <input maxlength="150" type="text" name="amazon" id="amazon" placeholder="Amazon" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input maxlength="150" type="text" name="applemusic" id="applemusic" placeholder="Apple Music" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input maxlength="150" type="text" name="boom" id="boom" placeholder="Boom" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input maxlength="150" type="text" name="deezer" id="deezer" placeholder="Deezer" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input maxlength="150" type="text" name="googleplay" id="googleplay" placeholder="Google Play" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input maxlength="150" type="text" name="itunes" id="itunes" placeholder="iTunes" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input maxlength="150" type="text" name="soundcloud" id="soundcloud" placeholder="Soundcloud" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input maxlength="150" type="text" name="spotify" id="spotify" placeholder="Spotify" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input maxlength="150" type="text" name="vkmusic" id="vkmusic" placeholder="VK" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input maxlength="150" type="text" name="yandexmusic" id="yandexmusic" placeholder="Yandex Music" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input maxlength="150" type="text" name="youtubemusic" id="youtubemusic" placeholder="Youtube Music" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input maxlength="150" type="text" name="zvuk" id="zvuk" placeholder="Звук" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-secondary btn-sm ml-2 mb-2">Download</button>
                                </form>
                            </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endif

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

                    <div class="infinite-scroll" id="textpost">
                	<div class="row">
                    	@foreach($albums as $album)
                    		<div class="col-lg-4 allalbums">
                    			<div class="card brighten">
                    				<a href="{{route('album', ['id' => $user->id, 'album' => $album->id])}}" style="text-decoration: none">
                                        <img src="{{$album->cover}}" width="100%" class="img-fluid brighten">
                                        <h5 style="font-size: 1rem; color: black" class="mt-2 mb-2 text-center">{{$album->title}}</h5>
                                    </a>
                                    @if(Auth::check())
                                        @if(Auth::user()->id == $user->id)
{{--                                            <form class="mt-2 mb-2 mr-2 text-right" method="post" action="{{route('deleteAlbums', ['id' => $album->id])}}">--}}
{{--                                                @csrf @method('DELETE')--}}
{{--                                                <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>--}}
{{--                                            </form>--}}
                                        @endif
                                    @endif
                    			</div>
                    		</div>
                    	@endforeach
                	</div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--@dump($albums)--}}
{{--@dump($user)--}}
<!-- Mobile Footer social -->
<div class="container">
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
