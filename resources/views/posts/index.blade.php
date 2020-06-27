@extends('layouts.layout')

@section('content')

{{-- <div id="demo" class="carousel slide" data-ride="carousel" style="margin-top: 80px">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://images.pexels.com/photos/1260801/pexels-photo-1260801.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Los Angeles" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Los Angeles</h3>
        <p>We had such a great time in LA!</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="https://images.pexels.com/photos/1583339/pexels-photo-1583339.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Chicago" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Chicago</h3>
        <p>Thank you, Chicago!</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="https://images.pexels.com/photos/1031933/pexels-photo-1031933.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
        <h3>New York</h3>
        <p>We love the Big Apple!</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div> --}}

<div class="row" style="margin-top: 80px">
    @foreach($posts as $post)
        <div class="col-lg-3 col-md-12 col-sm-12 col-xl-3">
            <div class="card mt-2 mb-4">
                <a href="{{route('post.show', ['id' => $post->post_id])}}" class="brighten"><img src="{{$post->img ?? $post->img_link ?? asset('img/default.jpeg')}}" class="img-fluid brighten"></a>
            </div>
        </div>
    @endforeach
</div>

@endsection
