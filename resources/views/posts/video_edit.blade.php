@extends('layouts.layout')

@section('content')

<form action="{{ route('video.update', ['id'=>$video->video_id]) }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('PATCH')
	<div class="form-group">
		<h4>Группа</h2>
		<input type="text" name="title" class="form-control" value="{{$video->title}}">
	</div>
	<div class="form-group">
		<h4>Ссылка на видео</h2>
		<textarea name="video" cols="45" rows="10" class="form-control">{{$video->video}}</textarea>
	</div>
	<div class="form-group">
		<h4>Загрузить изображение</h2>
		<input type="file" name="img" class="form-control">
		<input type="text" name="img_link" class="form-control mt-1" placeholder="Вставить ссылку на изображение" value="{{$video->img_link}}">
	</div>
	<input type="submit" name="btn" value="Изменить">
</form>

@endsection
