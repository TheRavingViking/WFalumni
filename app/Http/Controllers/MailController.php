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

        if (!empty($request)) {


            $users = User::all('email');
            $title = $request->title;
            $subject = $request->subject;
            $email = $request->email;


            foreach ($users as $mail)
                mail::to($mail)->queue(new MailAll($subject, $email, $title));

            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Voer de velden in.');
        }
    }

}
