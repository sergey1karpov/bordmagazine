@extends('layouts.layout')

@section('content')

<form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
	@csrf
	<h2>Загрузить статью</h2>
	<div class="form-group">
		<h4>Заголовок статьи</h2>
		<input type="text" name="title" class="form-control">
	</div>
	<div class="form-group">
		<h4>Текст</h2>
		<textarea name="article" cols="45" rows="10" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<h4>Загрузить изображение</h2>
		<input type="file" name="img" class="form-control" >
		<input type="text" name="img_link" class="form-control mt-1" placeholder="Вставить ссылку на изображение">
	</div>
	<div class="form-group">
		<h4>Видео</h2>
		<input type="text" name="video" class="form-control">
	</div>
	<input type="submit" name="btn" value="Залить альбом">
</form>

@endsection	