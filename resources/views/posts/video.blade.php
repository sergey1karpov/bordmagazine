@extends('layouts.app')

@section('content')

	<div class="row" style="margin-top: 80px">
		@foreach($videos as $video)
			<div class="col-lg-4 col-sm-12">
				<div class="card mt-2">
					<a href="{{route('video.show', ['id' => $video->video_id])}}" class="brighten"><img src="{{$video->img ?? $video->img_link ?? asset('img/default.jpeg')}}" class="img-fluid brighten"></a>
					<div class="card-header text-center" style="font-size: 1rem">{{ $video->title }}</div>
				</div>
			</div>
		@endforeach
	</div>

    <div class="container">
        <ul class="pagination justify-content-center">
            <h5 style="font-size: 1rem; color: black";>{{$videos->links()}}</h5>
        </ul>
    </div>

@endsection
