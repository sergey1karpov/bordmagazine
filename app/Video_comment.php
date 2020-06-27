<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video_comment extends Model
{
    protected $primaryKey = 'comment_id';

    public function post()
    {
    	return belongsTo(Video::class);
    }
}
