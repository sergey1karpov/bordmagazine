<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Music_comment;
use App\Video_comment;
use App\Article_comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
    	$comment = new Music_comment();
    	$comment->comment = $request->comment;
    	$comment->author_id = Auth::user()->id;
    	$comment->author_name = Auth::user()->name;
    	$comment->post_id = (int)$request->input('post_id');

    	$comment->save();

        return redirect()->back()->with('success', 'Комментарий добавлен');
    }

    public function video_store(Request $request) {
        $comment = new Video_comment();
        $comment->comment = $request->comment;
        $comment->author_id = Auth::user()->id;
        $comment->author_name = Auth::user()->name;
        $comment->video_id = (int)$request->input('video_id');

        $comment->save();

        return redirect()->back()->with('success', 'Комментарий добавлен');
    }

    public function article_store(Request $request) {
        $comment = new Article_comment();
        $comment->comment = $request->comment;
        $comment->author_id = Auth::user()->id;
        $comment->author_name = Auth::user()->name;
        $comment->article_id = (int)$request->input('article_id');

        $comment->save();

        return redirect()->back()->with('success', 'Комментарий добавлен');
    }

    public function deleteMusicComment($comment_id) {
        $delMusicComment = Music_comment::find($comment_id);
        if(Auth::user()->id == $delMusicComment->author_id) {
            $delMusicComment->delete();
            return response()->json([
                'message' => 'deleted...'
            ]);
        }
    }


    public function deleteVideoComment($vcomment_id) {
        $delVideoComment = Video_comment::find($vcomment_id);
        if(Auth::user()->id == $delVideoComment->author_id) {
            $delVideoComment->delete();
            return response()->json([
                'message' => 'delete'
            ]);
        }
    }

    public function deleteArticleComment($comment_id) {
        $delArticleComment = Article_comment::find($comment_id);
        if(Auth::user()->id ==$delArticleComment->author_id) {
            $delArticleComment->delete();
            return response()->json([
                'message' => 'deleted...'
            ]);
        }
    }

}
