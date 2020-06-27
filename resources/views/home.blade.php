@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Panel</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <p><a href="{{ route('post.create') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Добавить музыку</a></p>
                        <p><a href="{{ route('video.create') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Добавить видео</a></p>
                        <p><a href="{{ route('article.create') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Добавить заметку</a></p>
                        <p><a href="{{ route('blog.create') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Добавить запись в блог</a></p>
                        <hr>
                        <h3 class="text-center">Users</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col-auto">Id</th>
                                <th scope="col-auto">Name</th>
                                <th scope="col-auto">Status</th>
                                <th scope="col-auto">Verify</th>
                                <th scope="col-auto">Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->status}}</td>
                                <td>{{$user->verify ? 'yes' : 'no'}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <form action="{{route('editAdminForUsers', ['id' => $user->id])}}" method="post" id="editForm{{$user->id}}">
                                        @csrf @method('PATCH')
                                        <div class="form-group">
                                            <input type="text" name="verify" value="{{$user->verify}}">
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary" id="btn{{$user->id}}">Редактировать</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



