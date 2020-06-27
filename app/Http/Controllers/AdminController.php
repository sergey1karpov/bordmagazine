<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('role');
	}

    public function admin()
    {
        $users = User::paginate(50);
        return view('home', compact('users'));
    }

    public function editAdminForUsers(Request $request, $id) {
	    $user = User::findOrFail($id);
        $user->verify = $request->verify;
        $user->update();

        return redirect()->back();
    }

}
