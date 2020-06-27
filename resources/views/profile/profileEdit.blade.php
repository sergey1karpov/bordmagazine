<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>BORD!MAG @yield('title')</title>
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
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <script src="{{ asset('js/app.js') }}"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jaldi&display=swap" rel="stylesheet">
</head>
<body>

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



<div class="container" style="padding: 0">
    <div class="row margin text-center">
        @if ($errors->any())
            <div class="col-lg-12">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main -->
            <div class="col-lg-7 d-none d-xl-block " style="margin-bottom: 50px">
                <h4 class="text-center mt-3">Profile Settings</h4>
                @if($user->banner)
                    <p>Current banner</p>
                    <img src="{{$user->banner}}" class="img-fluid" width="500">
                    <form action="{{route('deleteBanner', ['id' => $user->id])}}" method="post">
                        @csrf @method('PATCH')
                        <input type="submit" class="btn btn-sm btn-danger" value="del">
                    </form>
                @endif
                <form style="margin-left: 5px; margin-right: 5px" action="{{route('editProfileInformation', ['id' => Auth::user()->id])}}" method="post" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">User name</h6>
                        <input maxlength="20" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">City</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="City" name="city" value="{{$user->city}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Country</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Country" name="country" value="{{$user->country}}">
                    </div>

                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Status</h6>
                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                            <option selected value="{{$user->status}}">Choose status</option>
                            <option name="status" >User</option>
                            <option name="status" >Rap</option>
                            <option name="status" >Punk-Rock</option>
                            <option name="status" >Pop</option>
                            <option name="status" >Musician</option>
                            <option name="status" >Politician</option>
                            <option name="status" >Public figure</option>
                            <option name="status" >Nigga</option>
                            <option name="status" >Athlete</option>
                            <option name="status" >Actor</option>
                            <option name="status" >Writer</option>
                            <option name="status" >Blogger</option>
                            <option name="status" >Lev Tolstoy</option>
                            <option name="status" >News</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Your group \ public VK</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your group \ public VK" name="vk" value="{{$user->vk}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Instagram page link</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Instagram page link" name="insta" value="{{$user->insta}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Group \ Facebook Page</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Group \ Facebook Page" name="facebook" value="{{$user->facebook}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Twitter Page</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Twitter Page" name="twitter" value="{{$user->twitter}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Your personal website</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your personal website" name="site" value="{{$user->site}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">About us</h6>
                        <textarea name="about" class="form-control" rows="6">{{$user->about}}</textarea>
                        <small id="emailHelp" class="form-text text-muted text-center">500 characters maximum</small>
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Download profile photo</h6>
                        <input type="file" name="avatar" value="{{$user->avatar}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Upload banner for your profile</h6>
                        <input type="file" name="banner" value="{{$user->banner}}">
                        <small id="emailHelp" class="form-text text-muted text-center">Recommended banner size is 300x1080 px</small>
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">tel.</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your phone number" name="tel" value="{{$user->tel}}">
                        <small id="emailHelp" class="form-text text-muted text-center">I'll call you somehow ...</small>
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-dark text-center">Send</button>
                </form>
            </div>

            <!-- Mobile -->
            <div class="col-lg-12 d-lg-none " style="margin-bottom: 50px">
                <h4 class="text-center mt-3">Profile Settings</h4>
                @if($user->banner)
                    <p>Current banner</p>
                    <img src="{{$user->banner}}" class="img-fluid" width="500">
                    <form action="{{route('deleteBanner', ['id' => $user->id])}}" method="post">
                        @csrf @method('PATCH')
                        <input type="submit" class="btn btn-sm btn-danger" value="del">
                    </form>
                @endif
                <form style="margin-left: 5px; margin-right: 5px" action="{{route('editProfileInformation', ['id' => Auth::user()->id])}}" method="post" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">User name</h6>
                        <input maxlength="20" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">City</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="City" name="city" value="{{$user->city}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Country</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Country" name="country" value="{{$user->country}}">
                    </div>

                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Status</h6>
                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                            <option selected value="{{$user->status}}">Choose status</option>
                            <option name="status" >User</option>
                            <option name="status" >Rap</option>
                            <option name="status" >Punk-Rock</option>
                            <option name="status" >Pop</option>
                            <option name="status" >Musician</option>
                            <option name="status" >Politician</option>
                            <option name="status" >Public figure</option>
                            <option name="status" >Nigga</option>
                            <option name="status" >Athlete</option>
                            <option name="status" >Actor</option>
                            <option name="status" >Writer</option>
                            <option name="status" >Blogger</option>
                            <option name="status" >Lev Tolstoy</option>
                            <option name="status" >News</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Your group \ public VK</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your group \ public VK" name="vk" value="{{$user->vk}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Instagram page link</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Instagram page link" name="insta" value="{{$user->insta}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Group \ Facebook Page</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Group \ Facebook Page" name="facebook" value="{{$user->facebook}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Twitter Page</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Twitter Page" name="twitter" value="{{$user->twitter}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Your personal website</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your personal website" name="site" value="{{$user->site}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">About us</h6>
                        <textarea name="about" class="form-control" rows="6">{{$user->about}}</textarea>
                        <small id="emailHelp" class="form-text text-muted text-center">500 characters maximum</small>
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Download profile photo</h6>
                        <input type="file" name="avatar" value="{{$user->avatar}}">
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">Upload banner for your profile</h6>
                        <input type="file" name="banner" value="{{$user->banner}}">
                        <small id="emailHelp" class="form-text text-muted text-center">Recommended banner size is 300x1080 px</small>
                    </div>
                    <div class="form-group">
                        <h6 class="mt-5 mb-1 text-center">tel.</h6>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your phone number" name="tel" value="{{$user->tel}}">
                        <small id="emailHelp" class="form-text text-muted text-center">I'll call you somehow ...</small>
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-dark text-center">Send</button>
                </form>
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
                                <a href="{{route('musics')}}"><img src="{{asset('img/footer/main.png')}}" class="img-fluid" width="30"></a>
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
                                        <a href="{{route('profile', ['id' => Auth::user()->id])}}"><img class="img-footer " style="background-image: url({{Auth::user()->avatar}});"></a>
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




