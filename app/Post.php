<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $primaryKey = 'post_id';

    protected $fillable = ['title', 'playlist', 'img_link', 'img', 'author_id', 'link'];

    public function comments()
    {
        return $this->hasMany('App\Music_comment', 'post_id');
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public static function getPostOnMainPage()
    {
        $posts = Post::join('users', 'author_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->limit(12)
            ->get();

        return $posts;
    }

    public static function checkImg(Request $request)
    {
        if($request->file('img')) {
            $path = Storage::putFile('public',$request->file('img'));
            $url = Storage::url($path);
            return $url;
        }
    }
}
