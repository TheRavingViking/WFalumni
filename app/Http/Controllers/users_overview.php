<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class users_overview extends Controller
{
    public function fetchall()
    {

        $users = DB::table('users')->where('isdeleted', '0')->get();

        return view('overview', compact('users') );

    }
}
