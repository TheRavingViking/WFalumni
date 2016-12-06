<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index()
    {

        $users = User::all();


        return view('mail', compact('users'));
    }
}
