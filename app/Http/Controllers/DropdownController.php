<?php

namespace App\Http\Controllers;

use App\dropdown_opleidingen;
use App\dropdown_richting;
use App\dropdown_specialisaties;
use App\richting;
use App\Mail\Welkommail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Illuminate\Support\Facades\App;
use Image;
use App\User;
use App\Opleiding;
use App\Bedrijf;
use App\Woonplaats;
use Illuminate\Support\Facades\DB;
use Response;

class DropdownController extends Controller
{
    public function opleidingen()
    {

        $richting_naam = request('richting_naam');

        $richting= dropdown_richting::where('naam', $richting_naam)->first();

        $richting_id = $richting->id;

        $opleidingen = dropdown_opleidingen::where('richtingen_id', '=', $richting_id)->get();


        return response::json($opleidingen);
    }

    public function specialisaties()
    {

        $opleiding_naam = request('opleidingen_naam');

        $opleiding = dropdown_opleidingen::where('naam', $opleiding_naam)->first();

        $opleiding_id = $opleiding->id;

        $specialisaties = dropdown_specialisaties::where('opleidingen_id', '=', $opleiding_id)->get();


        return response::json($specialisaties);
    }
}
