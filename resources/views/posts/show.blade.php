@extends('layouts.app')

@section('content')

<div type="hidden">@section('title'){{$post->title}}@endsection</div>

<div class="row" style="margin-top: 80px">
	<div class="col-lg-6 mt-2">
		<img src="{{$post->img ?? $post->img_link ?? asset('img/default.jpeg')}}" class="img-fluid">
	</div>
	<div class="col-lg-6 mt-2">
		{!!$post->playlist!!}
		<div class="text-center" style="margin-top: 20px">
            <!-- uSocial -->
            <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>
            <div class="uSocial-Share" data-pid="339cedd65c9762615e04e5dc6a897d6c" data-type="share" data-options="round-rect,style1,default,absolute,horizontal,size48,eachCounter1,counter0,nomobile" data-social="vk,twi,fb,telegram"></div>
            <!-- /uSocial -->
		</div>
		<div class="text-right">
			<a href="{{url('/post')}}"><button class="btn btn-outline-info btn-sm" style="margin-top: 31px">Назад</button></a>
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
						@if(Auth::user()->id == $post->author_id)
							<div class="row">
								<div class="col-lg-6 text-right">
									<a href="{{ route('post.edit', ['id' => $post->post_id]) }}" class="btn btn-info btn-sm">Редактировать пост</a>
								</div>
								<div class="col-lg-6 text-left">
									<form action="{{route('post.destroy', ['id' => $post->post_id])}}" method="post">
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
			<form method="post" action="/post/{id}/" id="form">
				@csrf
				<input type="hidden" value="{{ $post->post_id }}" name="post_id">
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
			@foreach($post->comments as $com)
				<div class="textpost" id="textpostdata" data-id="{{$com->comment_id}}">
					<p><b>{{$com->author_name}}</b> · <i>{{$com->created_at->diffForHumans()}}</i></p>
					<p>{{$com->comment}}</p>

		            @if(Auth::check())
		                @if(Auth::user()->id == $com->author_id)
		                <form action="{{route('delMusicComment', ['comment_id' => $com->comment_id])}}" method="post" id="formDelete">
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
                url: "{{route('addMusicComment', ['id' => Auth::user()->id])}}",
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
                url: "/post/delete/"+id,
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


