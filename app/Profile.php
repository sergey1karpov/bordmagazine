<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use User;

class Profile extends Model
{
    protected $fillable =['message', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
