<?php

namespace App\Http\Controllers;

use App\users_overview_model;
use Illuminate\Http\Request;

class users_overview extends Controller
{
    public function index()
    {

        $users = users_overview_model::all();

        return view('overview', compact('users') );

    }

    public function show($id)
    {

        $users = users_overview_model::find($id);


        return view('detailpage', compact('users'));
    }
}
