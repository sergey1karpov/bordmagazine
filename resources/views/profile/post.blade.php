<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{$post->title ?? $user->name}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Hear all the best new Punk-Rock album releases and see new Video clips & Live perfomances!"/>
    <meta name="keywords" content="Punk, Punk-Rock, best new albums, best songs, top new songs, hot new songs, songs of 2020, discover new music, find new music, new songs, new music, new cd releases, new music releases, new releases now, 2020 albums, 2020 cds, top songs, hot songs"/>

    <!-- Open Graph tags-->
    <meta property="og:title" content="BORD!MAG - New Punk-Rock Releases, Songs & Video" />
    <meta property="og:url" content="http://www.bordmagazine.ru" />
    <meta property="og:site_name" content="BORD!MAG" />
    <meta property="og:description" content="Hear all the best new Punk-Rock album releases and see new Video clips & Live perfomances!" />
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


</head>
<body>

<div class="modal fade" id="mobileNav" tabindex="-1" role="dialog" aria-labelledby="mobileNav" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5>Копировать ссылку на страницу</h5>
                <input id="foo{{$user->id}}" value="{{route('userPost', ['id' => $user->id, 'postId' => $post->id])}}" style="width: 100%">
                <br>
                <!-- Trigger -->
                <button class="btn btn-sm mt-2" data-clipboard-target="#foo{{$user->id}}">
                    Copy link<i class="ml-1 fas fa-copy"></i>
                </button>
                <h5 class="mt-2">Рассказать друзьям</h5>
                <!-- uSocial -->
                <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>
                <div class="uSocial-Share" data-pid="4de7c49aa36779d3776b505ae3bf22cd" data-type="share" data-options="round-rect,style3,default,absolute,horizontal,size32,eachCounter1,counter0,nomobile" data-social="vk,twi,fb,telegram"></div>
                <!-- /uSocial -->
                <h5 class="mt-3">Перейти на главную</h5>
                <a href="{{route('musics')}}"><img src="{{asset('img/logo4.png')}}" class="img-fluid mb-1" width="120px;"></a>
            </div>
        </div>
    </div>
</div>

<!--Navbar -->
<div class="container d-none d-xl-block">
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <a class="navbar-brand" href="/"><img src="{{asset('img/logo4.png')}}" class="img-fluid mb-1" width="120px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555" aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{route('post.index')}}">Музыка</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('video.index')}}">Видео</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('article.index')}}">Заметки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('blog.index')}}">Блог</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/contacts')}}">Контакты</a>
                </li>
            </ul>
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
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Логин') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('profile', ['id' => Auth::user()->id])}}">
                                {{ __('Profile') }}
                            </a>
                            @if(\Auth::user()->role_id != 1)
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            @else
                                <a class="dropdown-item" href="{{ route('home') }}">
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

<!-- Mobile nav -->
{{--<div class="container d-lg-none fixed-top text-right">--}}
{{--    <img src="{{asset('img/footer/menu.png')}}" class="img-fluid " width="30" data-toggle="modal" data-target="#mobileNav">--}}
{{--</div>--}}

{{--<div class="modal fade" id="mobileNav" tabindex="-1" role="dialog" aria-labelledby="mobileNav" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-body text-center">--}}
{{--                <h5>Поделиться страницей с друзьями</h5>--}}
{{--                <!-- uSocial -->--}}
{{--                <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>--}}
{{--                <div class="uSocial-Share" data-pid="4de7c49aa36779d3776b505ae3bf22cd" data-type="share" data-options="round-rect,style3,default,absolute,horizontal,size32,eachCounter1,counter0,nomobile" data-social="vk,twi,fb,telegram"></div>--}}
{{--                <!-- /uSocial -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- End Mobile Nav -->

<div class="container d-none d-xl-block">
    <div class="row">
        <div class="col-12">
            @if($post->img)
                <div class="text-center" style="padding-left: 16px; padding-right: 16px">
                    <img src="{{$post->img}}" class="img-fluid" width="100%">
                </div>
            @endif
            @if($post->title)
                    <h5 style="white-space: pre-wrap; padding-left: 16px; padding-right: 16px"><b>{{$post->title}}</b></h5>
            @endif
            @if($post->message)
                <div class="text-muted text-small margins" style="white-space: pre-wrap; padding-left: 16px; padding-right: 16px">{!!$post->message!!}</div>
            @endif
            <br>
                @if($post->videoPost)
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe style="padding-left: 16px; padding-right: 16px" class="embed-responsive-item" src="{{$post->videoPost}}" allowfullscreen></iframe>
                    </div>
                @endif
        </div>
    </div>
</div>

<div class="media-heading fixed-top d-lg-none" style="background-color: rgba(255,255,255,0.9)">
    <small class="float-right  margins" style="margin-top: 5px">{{$post->created_at->diffForHumans()}}</small>
    <a href="{{route('profile', ['id' => $user->id])}}" style="color: black; text-decoration: none">
        <h5 class="margins mt-1" style="margin-bottom: 0">{{$user->name}}
        @if($user->verify)
            <img src="{{asset('img/verify.png')}}" class="img-fluid ml-1 mb-1" width="15px" title="Он настоящий!">
        @endif
        </h5>
    </a>
</div>

<div class="media d-lg-none" style="margin-top: 30px">
    <div class="img-post d-none d-xl-block"></div>
    <div class="media-body">
        @if($post->img)
            <div>
                <img src="{{$post->img}}" class="img-fluid">
            </div>
        @endif
        <br>
            @if($post->title)
                <div class="ml-1 mr-1 mb-3">
                    <h5><b>{{$post->title}}</b></h5>
                </div>
            @endif
        @if($post->message)
            <div class="text-muted text-small margins" style="white-space: pre-wrap;">{!!$post->message!!}</div>
        @endif
            @if($post->videoPost)
                <div class="embed-responsive embed-responsive-16by9 mt-4">
                    <iframe class="embed-responsive-item" src="{{$post->videoPost}}" allowfullscreen></iframe>
                </div>
            @endif
    </div>
</div>


<!-- Content -->
<div class="container allalbums mb-5 text-center mt-3" style="margin-bottom: 70px">
    <div class="col ">

    </div>
</div>

<!-- Modal Edit Post-->
<div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="editPost" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактировать запись</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('editPost', ['id' => $user->id, 'postId' => $post->id])}}" method="post" enctype="multipart/form-data" id="form">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <textarea name="title" class="form-control" rows="1">{{$post->title}}</textarea>
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="10">{!!$post->message!!}</textarea>
                    </div>
                    <div class="form-group">
                        <textarea maxlength="100" class="form-control mt-1" id="videoPost" name="videoPost" cols="100" rows="1">{{$post->videoPost}}</textarea>
                    </div>
                    <h6>Текущее изображение</h6>
                    <img src="{{$post->img}}" class="img-fluid mb-2" width="150">
                    <div class="form-group">

                        <input type="file" id="img" name="img" value="Прикрепить изображение" >
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Редактировать</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

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
                                        <img src="{{asset('img/footer/edit.png')}}" class="img-fluid" width="30" data-toggle="modal" data-target="#editPost">
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

