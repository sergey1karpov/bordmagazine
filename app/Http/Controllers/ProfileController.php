<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\ProfileRequest;
use App\Profile;
use App\User;
use App\ProfileVideo;
use App\ProfileAlbums;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index($id) {
        $user = User::find($id);
        if($user) {
            $posts = $user->profile()->orderBy('created_at', 'desc')->paginate(2);
            $mainVideo = $user->profileVideo()->orderBy('created_at', 'desc')->limit(1)->get();
            $mainAlbum = $user->profileAlbums()->orderBy('created_at', 'desc')->limit(1)->get();
            $events = $user->events()->orderBy('eventdata')->limit(3)->get();
            return view('profile.profile', compact('user', 'posts', 'mainVideo', 'mainAlbum', 'events'));
        } return redirect()->route('musics');
    }

    public function store(Request $request) {

        $validator = $this->validate($request,[
            'title' => 'max:100',
            'message' => 'max:5000',
            'img' => 'mimes:jpeg,png,gif,jpg|max:5000',
            'videoPost' => 'max:100'
        ]);

        if($validator) {
            $post = new Profile();
            $post->title = $request->title;
            $post->message = $request->message;
            $post->user_id = Auth::user()->id;
            $post->videoPost = str_replace('watch?v=', 'embed/', $request->videoPost);

            if($request->file('img')) {
                $path = Storage::putFile('public/'.Auth::user()->id.'/post', $request->file('img'));
                $url = Storage::url($path);
                $post->img = $url;
            }

            $post->save();
        }

        return redirect()->back();
    }

    public function deleteUser($id) {
        $user = User::find($id);
        File::deleteDirectory(public_path('storage/'.Auth::user()->id));
        $user->delete();
        return redirect()->route('musics');
    }

    public function post($id, $postId) {
        $user = User::find($id);
        if(!$user) {
            return abort(404);
        }
        $post = Profile::find($postId);
        if(!$post) {
            return abort(404);
        }
        return view('profile.post', compact('user', 'post'));
    }

    public function editPost(Request $request, $id, $postId) {

        $validator  = $this->validate($request,[
            'title' => 'max:100',
            'message' => 'max:5000',
            'img' => 'mimes:jpeg,png,gif,jpg|max:5000',
            'videoPost' => 'max:100'
        ]);

        if($validator) {
            $user = User::find($id);
            if(!$user && $user != Auth::user()->id) {
                return abort(404);
            }
            $post = Profile::find($postId);
            if(!$post) {
                return abort(404);
            }

            $post->user_id = Auth::user()->id;
            $post->title = $request->title;
            $post->message = $request->message;

            if($request->file('img')) {
                $path = Storage::putFile('public/'.Auth::user()->id.'/post', $request->file('img'));
                $url = Storage::url($path);
                $post->img = $url;
            }

            $post->update();

            return redirect()->back();
        }
    }

    public function showEditProfileInformationPage($id) {
        $user = User::find($id);
        return view('profile.profileEdit', compact('user'));
    }

    public function editProfileInformation(Request $request, $id) {

        $user = User::find($id);
        $user->name = $request->name;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->status = $request->status;
        $user->vk = $request->vk;
        $user->insta = $request->insta;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->about = $request->about;
        $user->tel = $request->tel;
        $user->playlist = $request->playlist;
        $user->site = $request->site;

        if($request->file('avatar')) {
            $path = Storage::putFile('public/'.Auth::user()->id.'/avatar', $request->file('avatar'));
            $url = Storage::url($path);
            $user->avatar = $url;
        }

        if($request->file('banner')) {
            $path = Storage::putFile('public/'.Auth::user()->id.'/banner', $request->file('banner'));
            $url = Storage::url($path);
            $user->banner = $url;
        }

        $user->update();

        return redirect()->route('profile', ['id' => Auth::user()->id]);
    }

    public function delete($id) {
        $post = Profile::find($id);
        $post->delete();
        return response()->json([
            'message' => 'deleted...'
        ]);
    }

    public function allVideo($id) {
        $user = User::find($id);
        if(!$user) {
            return abort(404);
        }
        $videos = $user->profileVideo()->orderBy('created_at', 'desc')->paginate(6);
        if(!Auth::check() && !$videos->count() || !$videos->count() && Auth::user()->id != $user->id) {
            return abort(404);
        }
        return view('profile.allvideo', compact('user', 'videos'));
    }

    public function addProfileVideo(Request $request) {

        $validator = $this->validate($request,[
            'video' => 'max:150',
            'title' => 'max:100',
            'info' => 'max:1000',
            'audio' => 'max:1000',

            'amazon' => 'max:150',
            'applemusic' => 'max:150',
            'boom' => 'max:150',
            'deezer' => 'max:150',
            'googleplay' => 'max:150',
            'itunes' => 'max:150',
            'soundcloud' => 'max:150',
            'spotify' => 'max:150',
            'vkmusic' => 'max:150',
            'yandexmusic' => 'max:150',
            'youtubemusic' => 'max:150',
            'zvuk' => 'max:150'
        ]);

        $profileVideo = new ProfileVideo();
        $profileVideo->user_id = Auth::user()->id;
//        $profileVideo->video = $request->videoProfile;
        $profileVideo->title = $request->title;
        $profileVideo->info = $request->info;
        $profileVideo->audio = $request->audio;

        $profileVideo->video = str_replace('watch?v=', 'embed/', $request->videoProfile);

        $profileVideo->itunes = $request->itunes;
        $profileVideo->applemusic = $request->applemusic;
        $profileVideo->vkmusic = $request->vkmusic;
        $profileVideo->boom = $request->boom;
        $profileVideo->yandexmusic = $request->yandexmusic;
        $profileVideo->googleplay = $request->googleplay;
        $profileVideo->deezer = $request->deezer;
        $profileVideo->zvuk = $request->zvuk;
        $profileVideo->amazon = $request->amazon;
        $profileVideo->spotify = $request->spotify;
        $profileVideo->soundcloud = $request->soundcloud;

        if($profileVideo) {
            $profileVideo->save();
        }

        return redirect()->back();
    }

    public function deleteVideo($id) {
        $videoDelete = ProfileVideo::find($id);
        $videoDelete->delete();
        return redirect()->route('allVideo', ['id' => $videoDelete->user_id]);
    }

    public function allAlbums($id) {
        $user = User::find($id);
        if(!$user) {
            return abort(404);
        }
        $albums = $user->profileAlbums()->orderBy('created_at', 'desc')->paginate(6);
        if(!Auth::check() && !$albums->count() || !$albums->count() && Auth::user()->id != $user->id) {
            return abort(404);
        }

        return view('profile.allalbums', compact('user', 'albums'));
    }

    public function addProfileAlbums(Request $request) {

        $validator = $this->validate($request,[
            'audioTitle' => 'max:100',
            'cover' => 'mimes:jpeg,png,gif,jpg|max:5000',
            'info' => 'max:1000',
            'playlist' => 'max:1000',
            'amazon' => 'max:150',
            'applemusic' => 'max:150',
            'boom' => 'max:150',
            'deezer' => 'max:150',
            'googleplay' => 'max:150',
            'itunes' => 'max:150',
            'soundcloud' => 'max:150',
            'spotify' => 'max:150',
            'vkmusic' => 'max:150',
            'yandexmusic' => 'max:150',
            'youtubemusic' => 'max:150',
            'zvuk' => 'max:150'
        ]);

        if($validator) {
            ProfileAlbums::create([
                'title' => $request->audioTitle,
                'playlist' => $request->playlist,
                'user_id' => Auth::user()->id,
                'info' => $request->info,
                'cover' => ProfileAlbums::checkImg($request),

                'amazon' => $request->amazon,
                'applemusic' => $request->applemusic,
                'boom' => $request->boom,
                'deezer' => $request->deezer,
                'googleplay' => $request->googleplay,
                'itunes' => $request->itunes,
                'soundcloud' => $request->soundcloud,
                'spotify' => $request->spotify,
                'vkmusic' => $request->vkmusic,
                'yandexmusic' => $request->yandexmusic,
                'youtubemusic' => $request->youtubemusic,
                'zvuk' => $request->zvuk
            ]);

            return redirect()->back();
        }
    }

    public function updateAlbum($id, $album, Request $request) {

        $validator = $this->validate($request,[
            'audioTitle' => 'max:10',
            'cover' => 'mimes:jpeg,png,gif,jpg|max:5000',
            'info' => 'max:1000',
            'playlist' => 'max:1000',
            'amazon' => 'max:150',
            'applemusic' => 'max:150',
            'boom' => 'max:150',
            'deezer' => 'max:150',
            'googleplay' => 'max:150',
            'itunes' => 'max:150',
            'soundcloud' => 'max:150',
            'spotify' => 'max:150',
            'vkmusic' => 'max:150',
            'yandexmusic' => 'max:150',
            'youtubemusic' => 'max:150',
            'zvuk' => 'max:150'
        ]);

        $user = User::find($id);
        if($user->email == Auth::user()->email) {
            $album = ProfileAlbums::find($album);

            $album->title = $request->audioTitle;
            $album->playlist = $request->playlist;
            $album->user_id = Auth::user()->id;
            $album->info = $request->info;


            if($request->file('cover')) {
                $path = Storage::putFile('public/'.Auth::user()->id.'/playlist', $request->file('cover'));
                $url = Storage::url($path);
                $album->cover = $url;
            }


            $album->amazon = $request->amazon;
            $album->applemusic = $request->applemusic;
            $album->boom = $request->boom;
            $album->deezer = $request->deezer;
            $album->googleplay = $request->googleplay;
            $album->itunes = $request->itunes;
            $album->soundcloud = $request->soundcloud;
            $album->spotify = $request->spotify;
            $album->vkmusic = $request->vkmusic;
            $album->yandexmusic = $request->yandexmusic;
            $album->youtubemusic = $request->youtubemusic;
            $album->zvuk = $request->zvuk;

            $album->update();

            return redirect()->back();
        }
    }

    public function deleteAlbums($id) {
        $audioDelete = ProfileAlbums::find($id);
        $audioDelete->delete();
        return redirect()->route('allAlbums', ['id' => $audioDelete->user_id]);
    }

    public function album($id, $album) {
        $user = User::find($id);
        if(!$user) {
            return abort(404);
        }
        $album = ProfileAlbums::find($album);
        if($album == false || $user->id != $album->user_id) {
            return abort(404);
        }
        return view('profile.album', compact('user', 'album'));
    }

    public function events($id) {
        $user = User::find($id);
        if(!$user) {
            return abort(404);
        }
        $events = $user->events()->orderBy('eventdata')->get();
        if(!Auth::check() && !$events->count() || !$events->count() && Auth::user()->id != $user->id) {
            return abort(404);
        }
        return view('profile.events', compact('user', 'events'));
    }

    public function event($id, $event) {
        $user = User::find($id);
        if(!$user) {
            return abort(404);
        }
        $event = Event::find($event);
        if($event == false || $user->id != $event->user_id) {
            return abort(404);
        }
        return view('profile.event', compact('user', 'event'));
    }

    public function addEvent(Request $request) {

        $validator = $this->validate($request, [
            'title' => 'required|max:100',
            'info' => 'required|max:1000',
            'cover' => 'mimes:jpeg,png,gif,jpg|max:5000',
            'city' => 'required|max:50',
            'address' => 'max:250',
            'tickets' => 'max:100',
            'vk' => 'max:100',
            'fb' => 'max:100',
            'time' => 'max:10',
            'eventdata' => 'required',

            'youbrand' => 'max:100',
            'concert' => 'max:100',
            'yandex' => 'max:100',
            'kassir' => 'max:100',
            'ponominalu' => 'max:100',
            'ticketland' => 'max:100',
            'radario' => 'max:100'
        ]);

        if($validator) {
            Event::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'eventdata' => $request->eventdata,
                'city' => $request->city,
                'address' => $request->address,
                'info' => $request->info,
                'tickets' => $request->tickets,
                'vk' => $request->vk,
                'fb' => $request->fb,
                'cover' => Event::checkImg($request),
                'time' => $request->time,

                'youbrand' => $request->youbrand,
                'concert' => $request->concert,
                'yandex' => $request->yandex,
                'kassir' => $request->kassir,
                'ponominalu' => $request->ponominalu,
                'ticketland' => $request->ticketland,
                'radario' => $request->radario
            ]);

            return redirect()->back();
        }
    }

    public function editEvent(Request $request, $id, $event) {

        $validator = $this->validate($request, [
            'title' => 'required|max:100',
            'info' => 'required|max:1000',
            'cover' => 'mimes:jpeg,png,gif,jpg|max:5000',
            'city' => 'required|max:50',
            'address' => 'max:250',
            'tickets' => 'max:100',
            'vk' => 'max:100',
            'fb' => 'max:100',
            'time' => 'max:10',
            'eventdata' => 'required',

            'youbrand' => 'max:100',
            'concert' => 'max:100',
            'yandex' => 'max:100',
            'kassir' => 'max:100',
            'ponominalu' => 'max:100',
            'ticketland' => 'max:100',
            'radario' => 'max:100'
        ]);

        if($validator) {
            $user = User::find($id);
            if($user) {
                $event = Event::find($event);
                $event->user_id = Auth::user()->id;
                $event->title = $request->title;
                $event->eventdata = $request->eventdata;
                $event->city = $request->city;
                $event->address = $request->address;
                $event->info = $request->info;
                $event->tickets = $request->tickets;
                $event->vk = $request->vk;
                $event->fb = $request->fb;

                if($request->file('cover')) {
                    $path = Storage::putFile('public/'.Auth::user()->id.'/event',$request->file('cover'));
                    $url = Storage::url($path);
                    $event->cover = $url;
                }

                $event->time = $request->time;
                $event->youbrand = $request->youbrand;
                $event->concert = $request->concert;
                $event->yandex = $request->yandex;
                $event->kassir = $request->kassir;
                $event->ponominalu = $request->ponominalu;
                $event->ticketland = $request->ticketland;
                $event->radario = $request->radario;

                $event->update();
            }

            return redirect()->back();
        }
    }

    public function deleteEvent($id, $event) {
        $user = User::find($id);
        if($user) {
            $deleteEvent = Event::find($event);
            $deleteEvent->delete();
        }

        return redirect()->route('events', ['id' => $user->id]);
    }

    public function video($id, $video) {
        $user = User::find($id);
        if(!$user) {
            return abort(404);
        }
        $video = ProfileVideo::find($video);
        if($video == false || $user->id != $video->user_id) {
            return abort(404);
        }
        return view('profile.video', compact('user', 'video'));
    }

    public function updateVideo(Request $request, $id, $video) {

        $validator = $this->validate($request,[
            'video' => 'max:150',
            'title' => 'max:100',
            'info' => 'max:1000',
            'audio' => 'max:1000',

            'amazon' => 'max:150',
            'applemusic' => 'max:150',
            'boom' => 'max:150',
            'deezer' => 'max:150',
            'googleplay' => 'max:150',
            'itunes' => 'max:150',
            'soundcloud' => 'max:150',
            'spotify' => 'max:150',
            'vkmusic' => 'max:150',
            'yandexmusic' => 'max:150',
            'youtubemusic' => 'max:150',
            'zvuk' => 'max:150'
        ]);

        $user = User::find($id);
        if($user) {
            $video = ProfileVideo::find($video);
            $video->user_id = Auth::user()->id;
            $video->video = $request->videoProfile;
            $video->title = $request->title;
            $video->info = $request->info;
            $video->audio = $request->audio;

            $video->itunes = $request->itunes;
            $video->applemusic = $request->applemusic;
            $video->vkmusic = $request->vkmusic;
            $video->boom = $request->boom;
            $video->yandexmusic = $request->yandexmusic;
            $video->googleplay = $request->googleplay;
            $video->deezer = $request->deezer;
            $video->zvuk = $request->zvuk;
            $video->amazon = $request->amazon;
            $video->spotify = $request->spotify;
            $video->soundcloud = $request->soundcloud;

            if($video) {
                $video->update();
            }

            return redirect()->back();
        }
    }

    public function deleteBanner(Request $request, $id) {
        $user = User::find($id);
        $user->banner = $request->banner;
        $user->update();

        return redirect()->back();
    }
}
