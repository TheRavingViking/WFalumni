<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use Image;
use App\User;
use App\Opleiding;



class UserController extends Controller
{
    //
    public function profiel()
    {
        return view('profiel', array('user' => Auth::user()));
    }

    public function index()
    {
        $users = User::with(['opleiding' => function ($q) {$q->latest('eind');}])->get();



        return view('overview', compact('users'));
    }

    public function show(User $users)
    {
        return view('detailpage', compact('users'));
    }

    public function update_avatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)-> resize(300, 300)->save( public_path('/uploads/avatars/' . $filename) );

        $user = Auth::user();
        $user->foto= $filename;
        $user->save();
        }
        return view('profiel', array('user' => Auth::user()));
    }

    public function editprofiel()
    {
        return view('editprofiel', array('user' => Auth::user()));
    }

    public function update(Request $req)
    {
        $user = Auth::user();
        $new_user_data = array(
            'voornaam' => $req['voornaam'],
            'tussenvoegsel' => $req['tussenvoegsel'],
            'achternaam' => $req['achternaam'],
            'geslacht' => $req['geslacht'],
            'email' => $req['email'],
            'nationaliteit' => $req['nationaliteit'],
            'geboorteland' => $req['geboorteland'],
            'geboorteprovincie' => $req['geboorteprovincie'],
            'geboorteplaats' => $req['geboorteplaats'],
            'geboortedatum' => $req['geboortedatum'],
            'titel' => $req['titel'],
            'burgerlijke_staat' => $req['burgerlijke_staat'],
            'heeft_kinderen' => $req['heeft_kinderen'],
            'jaarinkomen' => $req['jaarinkomen'],
            'post_adres' => $req['post_adres'],
            'studentnummer' => $req['studentnummer'],
            'telefoonnummer' => $req['telefoonnummer'],
            'facebook' => $req['facebook'],
            'linkedin' => $req['linkedin'],
            'twitter' => $req['twitter'],
            'website' => $req['website']
        );
        $user->fill($new_user_data);
        $user->save();
        return view('profiel', array('user' => Auth::user() ) );
    }
}
