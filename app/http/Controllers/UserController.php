<?php

namespace App\Http\Controllers;

use App\opleiding;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Image;


class UserController extends Controller
{
    //
    public function profiel()
    {
        return view('profiel', array('user' => Auth::user()));
    }

    public function index()
    {
        $users = user::paginate(2);
        return view('overview', compact('users'));
    }

    public function show($id)
    {
        $users = User::find($id);
        return view ('detailpage', compact('users'));
    }

    public function update_avatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));

            $user = Auth::user();
            $user->foto = $filename;
            $user->save();
        }
        return view('profiel', array('user' => Auth::user()));
    }
}