<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class users extends Controller
{
    public function fetchall()
    {

        $users = DB::table('users')->get();

        return view('overview', compact('users') );

    }
}
