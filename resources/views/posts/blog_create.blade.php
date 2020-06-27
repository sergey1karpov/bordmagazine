@extends('layouts.layout')

@section('content')

<form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
	@csrf
	<h2>Добавить запись в блог</h2>
	<div class="form-group">
		<h4>Заголовок для футера</h2>
		<input type="text" name="title" class="form-control">
	</div>
	<div class="form-group">
		<h4>Основной текст</h2>
		<textarea name="description" cols="45" rows="10" class="form-control" placeholder="max 500"></textarea>
	</div>
	<div class="form-group">
		<h4>Загрузить изображение</h2>
		<input type="file" name="img" class="form-control" >
		<input type="text" name="img_link" class="form-control mt-1" placeholder="Вставить ссылку на изображение">
	</div>
	<input type="submit" name="btn" value="Записать в блог">
</form>

@endsection	