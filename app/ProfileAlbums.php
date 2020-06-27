<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileAlbums extends Model
{
    protected $table = 'profilealbums';

    protected $fillable = [
        'title', 'playlist', 'cover', 'user_id', 'info',
        'amazon', 'applemusic', 'boom', 'deezer', 'googleplay', 'itunes', 'soundcloud', 'spotify', 'vkmusic', 'yandexmusic', 'youtubemusic', 'zvuk',
        ];

    public static function checkImg(Request $request)
    {
        if($request->file('cover')) {
            $path = Storage::putFile('public/'.Auth::user()->id.'/playlist', $request->file('cover'));
            $url = Storage::url($path);
            return $url;
        }
    }
}
