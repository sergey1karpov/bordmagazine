<?php

namespace App\Http\Controllers;

use App\Article;
use App\Post;
use App\Video;

class MainPageController extends Controller
{

    public function index()
    {
        $posts = Post::getPostOnMainPage();
        $video_posts = Video::getVideoPostsOnMainPage();
        $article_posts = Article::getArticlePostsOnMainPage();

        return view('posts.index', compact('posts','video_posts', 'article_posts'));
    }

    public function about()
    {
        return view('profile.about');
    }

    public function rules()
    {
        return view('profile.rules');
    }

    public function reference()
    {
        return view('profile.reference');
    }

}
