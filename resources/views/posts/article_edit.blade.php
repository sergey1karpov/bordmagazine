@extends('layouts.layout')

@section('content')

<form action="{{ route('article.update', ['id'=>$article->article_id]) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PATCH')
	<h2>Редактировать статью</h2>
	<div class="form-group">
		<h4>Заголовок статьи</h2>
		<input type="text" name="title" class="form-control" value="{{$article->title}}">
	</div>
	<div class="form-group">
		<h4>Текст</h2>
		<textarea name="article" cols="45" rows="10" class="form-control">{{$article->article}}</textarea>
	</div>
	<div class="form-group">
		<h4>Загрузить изображение</h2>
		<input type="file" name="img" class="form-control" value="{{$article->img}}">
		<input type="text" name="img_link" class="form-control mt-1" placeholder="Вставить ссылку на изображение" value="{{$article->img_link}}">
	</div>
	<div class="form-group">
		<h4>Видео</h2>
		<input type="text" name="video" class="form-control">
	</div>
	<input type="submit" name="btn" value="Изменить">
</form>

@endsection
