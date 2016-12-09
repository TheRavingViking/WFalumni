<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Illuminate\Support\Facades\App;
use Image;
use App\User;
use App\Opleiding;
use App\Bedrijf;
use App\Woonplaats;

class UserController extends Controller
{
    //
    public function profiel()
    {
        return view('profiel', array('user' => Auth::user()));
    }

    public function index()
    {

//        $users = User::with(['opleiding' => function ($q) {
//            $q->latest('eind');
//        }])->paginate(25);

        $users = User::with('opleiding')->paginate(25);


        return view('overview', compact('users'));
    }

    public function show(User $user)
    {
        return view('profiel', compact('user'));
    }

    public function search(request $request)
    {
        $keyword = request('searchinput');
        $users = User::SearchByKeyword($keyword)->paginate(25);
        return view('overview', compact('users'));

    }


    public function createOpleiding(Request $request)
    {
        $data = array(
            'naam' => $request['naam'],
            'instituut' => $request['instituut'],
            'richting' => $request['richting'],
            'begin' => $request['begin'],
            'eind' => $request['eind'],
            'locatie' => $request['locatie'],
            'niveau' => $request['niveau'],
            'behaald' => $request['behaald'],
            'land' => $request['land'],
            'provincie' => $request['provincie'],
            'user_id' => $request['user_id']
        );
        opleiding::create($data);
        return redirect::to('profiel')->with('message', 'Opleiding toegevoegd');
    }

    public function deleteOpleiding(Request $request)
    {
        $user = $request->user_id;
        if (Opleiding::where('user_id', $user)->count() > 1) {
            $id = $request->id;
            $id = Opleiding::find($id);
            $id->delete();
            return redirect::back()->with('status', 'Opleiding verwijderd');
        } else {
            return redirect::back()->with('error', 'Je mag niet minder dan 1 opleiding hebben.');
        }
    }


    public function createBedrijf(Request $request)
    {
        $data = array(
            'naam' => $request['naam'],
            'functie' => $request['functie'],
            'richting' => $request['richting'],
            'begin' => $request['begin'],
            'eind' => $request['eind'],
            'locatie' => $request['locatie'],
            'telefoonnummer' => $request['telefoonnummer'],
            'bezoekadres' => $request['bezoekadres'],
            'land' => $request['land'],
            'provincie' => $request['provincie'],
            'user_id' => $request['user_id']
        );
        bedrijf::create($data);
        return redirect::to('profiel')->with('message', 'bedrijf toegevoegd');
    }

    public function deleteBedrijf(Request $request)
    {
        $user = $request->user_id;
        if (Bedrijf::where('user_id', $user)->count() > 1) {
            $id = $request->id;
            $id = Bedrijf::find($id);
            $id->delete();
            return redirect::back()->with('status', 'bedrijf verwijderd');
        } else {
            return redirect::back()->with('error', 'Je mag niet minder dan 1 bedrijf hebben.');
        }
    }


    public function createWoonplaats(Request $request)
    {
        $data = array(
            'naam' => $request['naam'],
            'begin' => $request['begin'],
            'eind' => $request['eind'],
            'longitude' => $request['longitude'],
            'latitude' => $request['latitude'],
            'land' => $request['land'],
            'provincie' => $request['provincie'],
            'user_id' => $request['user_id']
        );
        woonplaats::create($data);
        return redirect::to('profiel')->with('message', 'woonplaats toegevoegd');
    }

    public function deleteWoonplaats(Request $request)
    {
        $user = $request->user_id;
        if (Woonplaats::where('user_id', $user)->count() > 1) {
            $id = $request->id;
            $id = Woonplaats::find($id);
            $id->delete();
            return redirect::back()->with('status', 'Woonplaats verwijderd');
        } else {
            return redirect::back()->with('error', 'Je mag niet minder dan 1 woonplaats hebben.');
        }
    }


    public function update(Request $req)
    {
        $user = Auth::user();
        if ($req->hasFile('avatar')) {
            $avatar = $req->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));

            $user->foto = $filename;
            $user->save();
        }

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
            'website' => $req['website'],
            'geenmailverzenden' => $req['geenmailverzenden']
        );
        $user->fill($new_user_data);
        $user->save();
        //return view('profiel', array('user' => Auth::user()));
        return back()->with('status', 'Update was succesvol!!');
    }

    public function SoftDelete(request $id)
    {

        $user = Auth::user($id);
        $id = $id->id;
        $user = User::find($id);

        $user->delete();

        return view('welcome', array('user' => Auth::logout()));

//        $user = Auth::user();
//        $value = '1';
//        $user->deleted_at = $value;
//        $user->save();
//        return view('welcome', array('user' => Auth::logout()));
    }


    public function MassSoftDelete(Request $users)
    {

        if (empty($users->checkbox)) {
            return redirect::to('overview')->with('message', 'Geen gebruikers verwijderd, selecteer gebruikers');
        } else {
            $checkbox = $users->checkbox;
            foreach ($checkbox as $id)
                $id = User::where('id', $id)->delete();


            return redirect()->action('UserController@index');
        }
    }

}

