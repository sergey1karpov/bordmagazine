<?php

namespace App\Http\Controllers;

use App\Article;
use App\Post;
use App\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $posts = Post::join('users','author_id', '=','users.id')
            ->where('title', 'like','%'.$request->search.'%')
            ->orWhere('playlist','like','%'.$request->search.'%')
            ->orWhere('name','like','%'.$request->search.'%')
            ->orderBy('posts.created_at','desc')
            ->get();
        $video_posts = Video::join('users','author_id', '=','users.id')
            ->where('title', 'like','%'.$request->search.'%')
            ->get();
        $article_posts = Article::join('users','author_id', '=','users.id')
            ->where('title', 'like','%'.$request->search.'%')
            ->get();

        return view('posts.index', compact('posts', 'video_posts', 'article_posts'));
    }
}
