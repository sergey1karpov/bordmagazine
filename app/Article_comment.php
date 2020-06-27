<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article_comment extends Model
{
    protected $primaryKey = 'comment_id';

    public function post()
    {
    	return belongsTo(Article::class);
    }
}
