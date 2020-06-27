<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    protected $primaryKey = 'article_id';
    protected $fillable = ['title', 'img_link', 'video', 'article', 'author_id', 'img'];

    public function article_comments()
    {
        return $this->hasMany('App\Article_comment', 'article_id');
    }

    public static function getArticlePost()
    {
        $posts = Article::join('users', 'author_id','=', 'users.id')
            ->orderBy('articles.created_at', 'desc')
            ->simplePaginate(18);
        return $posts;
    }

    public static function getArticlePostsOnMainPage()
    {
        $article_posts = Article::join('users', 'author_id','=', 'users.id')
            ->orderBy('articles.created_at', 'desc')
            ->simplePaginate(9);
        return $article_posts;
    }

    public static function checkImg(Request $request) {
        if($request->file('img')) {
            $path = Storage::putFile('public',$request->file('img'));
            $url = Storage::url($path);
            return $url;
        }
    }
}
