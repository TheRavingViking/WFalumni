<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use Image;
use App\User;
use App\Opleiding;



class UserController extends Controller
{
    //
    public function profiel()
    {
        return view('profiel', array('user' => Auth::user()));
    }

    public function index()
    {
//        $users = User::with('opleiding')->get();
        $users = User::with(['opleiding' => function ($q) {
            $q->latest('eind');
        }])->get();



        return view('overview', compact('users'));
    }

    public function show(User $users)
    {
        return view('detailpage', compact('users'));
    }

    public function update_avatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)-> resize(300, 300)->save( public_path('/uploads/avatars/' . $filename) );

        $user = Auth::user();
        $user->foto= $filename;
        $user->save();
        }
        return view('profiel', array('user' => Auth::user()));
    }

    public function editprofiel()
    {
        return view('editprofiel', array('user' => Auth::user()));
    }

    public function update(Request $req)
    {
        $user = Auth::user();
        $studentnummer = $req->input('studentnummer');
        $user->studentnummer = $studentnummer;
        $user->save();
    }
}
