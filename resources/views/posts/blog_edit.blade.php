@extends('layouts.layout')

@section('content')

<form action="{{ route('blog.update', ['id'=>$blog->blog_id]) }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('PATCH')
	<div class="form-group">
		<h4>Заголовок для футера</h2>
		<input type="text" name="title" class="form-control" value="{{$blog->title}}">
	</div>
	<div class="form-group">
		<h4>Текст</h2>
		<textarea name="description" cols="45" rows="10" class="form-control">{{$blog->description}}</textarea>
	</div>
	<div class="form-group">
		<h4>Загрузить изображение</h2>
		<input type="file" name="img" class="form-control" >
		<input type="text" name="img_link" class="form-control mt-1" placeholder="Вставить ссылку на изображение" value="{{$blog->img_link}}">
	</div>
	<input type="submit" name="btn" value="Изменить">
</form>

@endsection
