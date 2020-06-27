<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $fillable = ['user_id', 'eventdata', 'city', 'cover', 'info', 'tickets', 'address','title', 'vk', 'fb',
        'youbrand', 'concert', 'yandex', 'kassir', 'time', 'ponominaly', 'ticketland', 'radario'
    ];

    public static function checkImg(Request $request) {
        if($request->file('cover')) {
            $path = Storage::putFile('public/'.Auth::user()->id.'/event',$request->file('cover'));
            $url = Storage::url($path);
            return $url;
        }
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
