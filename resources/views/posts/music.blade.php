@extends('layouts.app')

@section('content')


	<div class="row" style="margin-top: 80px">
		@foreach($posts as $post)
			<div class="col-3">
				<div class="card mt-2 mb-4">
					<a href="{{route('post.show', ['id' => $post->post_id])}}" class="brighten"><img src="{{$post->img ?? $post->img_link ?? asset('img/default.jpeg')}}" class="img-fluid brighten"></a>
				</div>
			</div>
		@endforeach
	</div>

	<div class="container">
        <ul class="pagination justify-content-center">
            <h5 style="font-size: 1rem; color: black";>{{$posts->links()}}</h5>
        </ul>
	</div>



@endsection
