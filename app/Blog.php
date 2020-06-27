<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    protected $primaryKey = 'blog_id';
    protected $fillable = ['title', 'description', 'img', 'img_link', 'author_id'];

    public static function getBlogPosts()
    {
        $blogs = Blog::orderBy('blogs.created_at', 'desc')
            ->simplePaginate(10);
        return $blogs;
    }

    public static function checkImg(Request $request) {
        if($request->file('img')) {
            $path = Storage::putFile('public',$request->file('img'));
            $url = Storage::url($path);
            return $url;
        }
    }
}
