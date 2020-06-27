@extends('layouts.app')

@section('content')

    <div type="hidden">@section('title'){{$article->title}}@endsection</div>

<div class="row" style="margin-top: 80px">
	<div class="col-lg-12 mt-2">
		<p class="text-center" style="font-size: 2rem;">{{$article->title}}</p>
		<p class="text-center">
		<img src="{{$article->img ?? $article->img_link ?? asset('img/default.jpeg')}}" class="img-fluid" width="100%">
		</p>
		<p>{!!$article->article!!}</p>
		<p>
			@if($article->video)
				{{$article->video}}
			@endif
		</p>
		<div class="text-right">
			<a href="{{url('/article')}}"><button class="btn btn-outline-info btn-sm" style="margin-top: 31px">Назад</button></a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 mt-4">

		@auth
			<div class="row">
				<div class="col-lg-6">
					<p4 class="mb-3">Добавить комментарий</p4>
				</div>
				<div class="col-lg-6">
					@auth
						@if(Auth::user()->id == $article->author_id)
							<div class="row">
								<div class="col-lg-6 text-right">
									<a href="{{ route('article.edit', ['id' => $article->article_id]) }}" class="btn btn-info btn-sm">Редактировать пост</a>
								</div>
								<div class="col-lg-6 text-left">
									<form action="{{route('article.destroy', ['id' => $article->article_id])}}" method="post">
										@csrf
										@method('DELETE')
										<input type="submit" name="del" class="btn btn-info btn-sm" value="Удалить нахер">
									</form>
								</div>
							</div>
						@endif
					@endauth
				</div>
			</div>
			<form method="post" action="/article/{id}/" id="form">
				@csrf
				<input type="hidden" value="{{ $article->article_id }}" name="article_id">
				<textarea id="message" name="comment" cols="150" rows="4" style="width: 100%;" class="mt-4"></textarea>
				<input type="submit" name="btn" value="Комментировать" class="btn btn-info btn-sm" >
			</form>
		@endauth

		@if(Auth::check())
			<h4 class="mt-3 mb-3">Комментарии:</h4>
			@else
			<h5 class="mt-1 mb-3">Что бы оставить комментарий, вам необходимо зарегистрироваться...</h5>
		@endif

		<div id="textpost">
			@foreach($article->article_comments as $com)
				<div class="textpost" id="textpostdata" data-id="{{$com->comment_id}}">
					<p><b>{{$com->author_name}}</b> · <i>{{$com->created_at->diffForHumans()}}</i></p>
					<p>{{$com->comment}}</p>

		            @if(Auth::check())
		                @if(Auth::user()->id == $com->author_id)
		                <form action="{{route('delArticleComment', ['comment_id' => $com->comment_id])}}" method="post" id="formDelete">
		                    @csrf @method('DELETE')
		                    <button type="submit" class="btn btn-sm btn-outline-danger py-0 mt-4 deletecom" data-id="{{ $com->comment_id }}">Удалить</button>
		                </form>
		                @endif
		            @endif

					<hr>
				</div>
			@endforeach
		</div>

	</div>
</div>

<!-- Scripts for Music post-->
<script type="text/javascript">
	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $( "#form" ).submit(function( e ) {
            e.preventDefault();

            var formData = new FormData(this); //set formData to selected instance

            $.ajax({
                type: "POST",
                @if(Auth::check())
                url: "{{route('addArticleComment', ['id' => Auth::user()->id])}}",
                @endif
                data: formData, //pass to our Ajax data to send
                success: function (data) {
                    $("#textpost").html($(data).find("#textpost").html());
                },
                contentType: false,
                processData: false,
            });
            $('#message').val('').change();

        });
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $("body").on("click",".deletecom",function(e){
            e.preventDefault();

            var id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "/article/delete/"+id,
                type: 'DELETE',
                data: {_token: token, id: id},
                success: function (){
                    // $("#textpostdata").remove();
                    $("div.textpost[data-id="+id+"]").remove();
                },
            });

        });
    });
</script>

@endsection

































































