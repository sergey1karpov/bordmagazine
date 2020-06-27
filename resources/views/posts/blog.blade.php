@extends('layouts.app')

@section('content')

	<div class="row" >
		<div class="col align-self-center">
			<h3 class="text-center align-self-center">Blog</h3>
			<hr>
		</div>
	</div>

	<div class="row ">

		{{-- <div class="col align-self-center">
			<h3 class="text-center align-self-center">Blog</h3>
			<hr>
		</div> --}}


		@if(isset($_GET['search']))
			@if(count($posts)>0)
				<h2>Результаты поиска по запросу <?=$_GET['search'] ?></h2>
				<p class="lead">Найдено{{count($posts)}} постов</p>
			@else
				<h2>По запросу <?=htmlspecialchars($_GET['search'])?> ничего не найдено</h2>
				<a href="{{route('post.index')}}">Показать все посты</a>
			@endif
		@endif

		@foreach($blogs as $blog)
            <div class="col-lg-3 col-xl-3"></div>
		<div class="col-sm-12 col-md-12 col-xl-6 col-lg-6 mt-4" style="padding: 0">
			<div class="card card-blog" >
				<div class="card-body">
					<p><a href="{{route('blog.show', ['id' => $blog->blog_id])}}" style="text-decoration: none; color: black"><b>BORD!MAG </b>· {{$blog->created_at->diffForHumans()}}<br></a></p>
					<p><a href="{{route('blog.show', ['id' => $blog->blog_id])}}" style="text-decoration: none; color: black">{!!$blog->description!!}<br></a></p>
				</div>
					<a href="{{route('blog.show', ['id' => $blog->blog_id])}}"><img src="{{$blog->img_link ?? $blog->img ?? asset('img/default.jpeg')}}" class="img-fluid card-img-top"></a><br>

			</div>
		</div>
            <div class="col-lg-3 col-xl-3"></div>
		@endforeach

	</div>

    <div class="container">
        <ul class="pagination justify-content-center">
            <h5 style="font-size: 1rem; color: black";>{{$blogs->links()}}</h5>
        </ul>
    </div>

@endsection
