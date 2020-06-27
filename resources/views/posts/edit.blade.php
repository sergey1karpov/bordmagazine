@extends('layouts.layout')

@section('content')

<form action="{{ route('post.update', ['id'=>$post->post_id]) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PATCH')
	<div class="form-group">
		<h4>Группа - Название альбома</h2>
		<input type="text" name="title" class="form-control" value="{{$post->title}}">
	</div>
	<div class="form-group">
		<h4>Плейлист ВК</h2>
		<textarea name="playlist" cols="45" rows="10" class="form-control">{{$post->playlist}}</textarea>
	</div>
	<div class="form-group">
		<h4>Загрузить изображение</h2>
		<input type="file" name="img" class="form-control" >
		<input type="text" name="img_link" class="form-control mt-1" placeholder="Вставить ссылку на изображение" value="{{$post->img_link}}">
	</div>
	<div class="form-group">
		<h4>Ссылка на скачинвание</h2>
		<input type="text" name="link" class="form-control">
	</div>
	<input type="submit" name="btn" value="Изменить">
</form>

@endsection	