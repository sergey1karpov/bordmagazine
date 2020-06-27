<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;

class ArticleController extends Controller
{

    public function __construct() {
        $this->middleware('role')->except('index', 'show');
    }

    public function index()
    {
        $articles = Article::getArticlePost();
        return view('posts.article', compact('articles'));
    }

    public function create()
    {
        return view('posts.article_create');
    }

    public function store(Request $request)
    {

        Article::create([
            'title' => $request->title,
            'img_link' => $request->img_link,
            'video' => $request->video,
            'article' => $request->article,
            'author_id' => Auth::user()->id,
            'img' => Article::checkImg($request)
        ]);

        return redirect()->route('article.index')->with('success', 'Пост создан нахуй');
    }

    public function show($id)
    {
        $article = Article::find($id);
        if(!$article) {
            return redirect()->route('article.index')->with('success', 'Ты дурак блять?');
        }
        return view('posts.article_show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::find($id);
        return view('posts.article_edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $article->title = $request->title;
        $article->article = $request->article;
        $article->img_link = $request->img_link;
        $article->video = $request->video;
        $article->img = Article::checkImg($request);

        $article->update();

        return redirect()->route('article.index')->with('success', 'Пост отредачен');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('article.index')->with('success', 'Пост удален');
    }
}

