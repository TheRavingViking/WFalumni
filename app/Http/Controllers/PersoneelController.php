<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\personeel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;
use Image;
use Auth;

class PersoneelController extends Controller
{
    public function index()
    {
        $personeel = personeel::paginate(3);
        return view('personeelOverview', compact('personeel'));
    }

    public function show(personeel $persoon)
    {
        return view('personeelProfiel', compact('persoon'));
    }

}
