<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music_comment extends Model
{
    protected $primaryKey = 'comment_id';

    public function post()
    {
    	return belongsTo(Post::class);
    }
}
