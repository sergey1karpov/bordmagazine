<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use App\Blog;
use App\Music_comment;

class CommentsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer('*', function($music) {
        //     $music->with(['post_comment' => Music_comment::join('posts', 'music_comments.post_id','=','posts.post_id')
        //         ->orderBy('music_comments.created_at', 'desc')
        //         ->limit(4)
        //         ->get()]);
        // });

    }
}
