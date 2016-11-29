<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\User;
class UserController extends Controller
{
    //
    public function profiel(){
        return view('profiel', array('user' => Auth::user()) );
    }

    public function index()
    {

        $users = User::paginate(2);


        return view('overview', compact('users') );

    }

    public function show($id)
    {

        $users = User::find($id);


        return view('detailpage', compact('users'));
    }
}
