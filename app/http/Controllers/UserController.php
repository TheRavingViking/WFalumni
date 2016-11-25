<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
{
    //
    public function profiel(){
        return view('profiel', array('user' => Auth::user()) );
    }
}
