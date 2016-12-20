<?php

namespace App\Http\Controllers;

use App\Mail\MailAll;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class MailController extends Controller
{
    public function index()
    {

        $users = User::all();

        return view('mail', compact('users'));
    }

    public function send(request $request)
    {
        $users = $request->users;
        $title = $request->title;
        $email = $request->email;


        mail::to($users)->send(new MailAll($title, $email));
        return redirect()->back();
    }

}
