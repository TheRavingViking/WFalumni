<?php

namespace App\Http\Controllers;


use App\dropdown_opleidingen;
use App\dropdown_richting;
use App\dropdown_specialisaties;
use App\Mail\Welkommail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Illuminate\Support\Facades\App;
use Image;
use App\Comment;

use Illuminate\Support\Facades\DB;
use Response;

class CommentController extends Controller
{

    public function index(request $request)
    {
        $id = request('id');
        $comments = Comment::where('user_id', $id)->get();
        return view('comment', array('comments' => $comments, 'id' => $id));
    }


    public function insertComment(request $request)
    {

        $comment = $request->comment;
        $id = $request->user_id;
        $rating = $request->rate;

        $voornaam = Auth::user()->voornaam;
        $tussenvoegsel = Auth::user()->tussenvoegsel;
        $achternaam = Auth::user()->achternaam;


        $comments = new Comment();
        $comments->comment = $comment;
        $comments->user_id = $id;
        $comments->docent_id = Auth::id();
        $comments->voornaam = $voornaam;
        $comments->tussenvoegsel = $tussenvoegsel;
        $comments->achternaam = $achternaam;
        $comments->docent_id = Auth::id();
        $comments->rating = $rating;
        $comments->save();

        return redirect()->back()->with('status', 'Comment toegevoegd.');
    }


    function deleteComment(Request $request)
    {
        $comment_id = $request->comment_id;
        $comment_id = Comment::find($comment_id);
        $comment_id->delete();

        $id = $request->user_id;
        $comments = Comment::where('user_id', $id)->get();


        return redirect()->back()->with('status', 'Comment verwijderd.');

    }


}





