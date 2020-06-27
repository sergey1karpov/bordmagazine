<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;


class SendEmailController extends Controller
{
    public function index()
    {
    	return view('posts.contacts');
    }

    public function send(Request $request)
    {
    	$this->validate($request, [
    		"name" => "required|min:2|max:20",
    		"email" => "required|email",
    		"message" => "required|min:10|max:1000",
    	]);

    	$data = [
    		"name" => $request->name,
    		"email" => $request->email,
    		"message" => $request->message,
    	];

    	Mail::to('support@bordmagazine.ru')->send(new SendMail($data));

    	return back()->with('success', 'Отлично, письмо отправленно! Прочту я его или же нет? Незнаю, вообщем...');
    }
}
