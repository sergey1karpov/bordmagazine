<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{

    public function __construct() {
        $this->middleware('role')->except('index', 'show');
    }

    public function index()
    {
        $videos = Video::getVideoPost();
        return view('posts.video', compact('videos'));
    }

    public function create()
    {
        return view('posts.video_create');
    }

    public function store(Request $request)
    {
        Video::create([
            'title' => $request->title,
            'video' => $request->video,
            'img_link' => $request->img_link,
            'author_id' => Auth::user()->id,
            'img' => Video::checkImg($request),
        ]);

        return redirect()->route('video.index')->with('success', 'Пост создан нахуй');
    }

    public function show($id)
    {
        $video = Video::find($id);
        if(!$video) {
            return redirect()->route('post.index')->with('success', 'Ты дурак блять?');
        }
        return view('posts.video_show', compact('video'));
    }

    public function edit($id)
    {
        $video = Video::find($id);
        return view('posts.video_edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $video->title = $request->title;
        $video->video = $request->video;
        $video->img = $request->img;
        $video->img = Video::checkImg($request);

        $video->update();

        return redirect()->route('video.index')->with('success', 'Пост отредачен');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('post.index')->with('success', 'Видео пост удален');
    }
}
