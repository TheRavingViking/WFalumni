<?php
/**
 * Created by PhpStorm.
 * User: Freddy
 * Date: 25-11-2016
 * Time: 13:10
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class admin extends Controller
{
    public function fetchall()
    {

        $users = DB::table('users')->get();

        return view('admin', compact('users') );

    }
}