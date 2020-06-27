<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;

class BlogController extends Controller
{

    public function __construct() {
        $this->middleware('role')->except('index', 'show');
    }

    public function index()
    {
        $blogs = Blog::getBlogPosts();
        return view('posts.blog', compact('blogs'));
    }

    public function create()
    {
        return view('posts.blog_create');
    }

    public function store(Request $request)
    {

        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'img_link' => $request->img_link,
            'author_id' => Auth::user()->id,
            'img' => Blog::checkImg($request),
        ]);

        return redirect()->route('blog.index')->with('success', 'Пост создан ');
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        if(!$blog) {
            return redirect()->route('post.index')->with('success', 'Ты дурак блять?');
        }
        return view('posts.blog_show', compact('blog'));
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('posts.blog_edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->img_link = $request->img_link;
        $blog->img = Blog::checkImg($request);

        $blog->update();

        return redirect()->route('blog.index')->with('success', 'Пост отредачен');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blog.index')->with('success', 'Пост удален');
    }
}
