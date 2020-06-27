<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    protected $primaryKey = 'video_id';

    protected $fillable = ['title', 'video', 'img_link', 'img', 'author_id'];

    public function video_comments()
    {
        return $this->hasMany('App\Video_comment', 'video_id');
    }

    public static function getVideoPost()
    {
    	return $videos = Video::join('users','author_id','=','users.id')
            ->orderBy('videos.created_at','desc')
            ->simplePaginate(18);
    }

    public static function getVideoPostsOnMainPage()
    {
        $video_posts = Video::join('users','author_id','=','users.id')
            ->orderBy('videos.created_at','desc')
            ->simplePaginate(6);
        return $video_posts;
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
