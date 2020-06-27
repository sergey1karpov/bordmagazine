<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('role')->except('index', 'show');
    }

    public function index() {
        $posts = Post::join('users','author_id','=','users.id')
            ->orderBy('posts.created_at','desc')
            ->paginate(16);

        return view('posts.music', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        Post::create([
            'title' => $request->title,
            'playlist' => $request->playlist,
            'img_link' => $request->img_link,
            'link' => $request->link,
            'author_id' => \Auth::user()->id,
            'img' => Post::checkImg($request),
        ]);

        return redirect()->route('post.index')->with('success', 'Пост создан');
    }

    public function show($id)
    {
        if(!$post = Post::find($id)) {
            return redirect()->route('post.index')->with('success', 'Ты дурак?');
        }

        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->playlist = $request->playlist;
        $post->img_link = $request->img_link;
        $post->link = $request->link;
        $post->img = Post::checkImg($request);

        $post->update();

        return redirect()->route('post.index')->with('success', 'Пост отредачен');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Пост удален');
    }
}
