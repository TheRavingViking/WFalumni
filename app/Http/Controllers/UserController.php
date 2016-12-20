<?php

namespace App\Http\Controllers;


use App\dropdown_opleidingen;
use App\dropdown_richting;
use App\dropdown_specialisaties;
use App\richting;
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

class UserController extends Controller
{
    //
    public function profiel()
    {
        return view('profiel', array('user' => Auth::user()));
    }

    public function index()
    {


        $users = User::has('opleiding')->paginate(25);

        $richtingen = dropdown_richting::all();
        $opleidingen = dropdown_opleidingen::all();
        $specialisaties = dropdown_specialisaties::all();


        return view('overview', array('users' => $users, 'richtingen' => $richtingen, 'opleidingen' => $opleidingen, 'specialisaties' => $specialisaties));
    }

    public function show(User $user)
    {
        return view('profiel', compact('user'));
    }


    public function mijnOpleiding()
    {
        if (Auth::user()->bevoegdheid == 1) {
            $auth = Auth::user()->opleiding()->get()->last()->naam;
            $eind = Auth::user()->opleiding()->get()->last()->eind;
            $eind = substr($eind, 0, 4);

//            return $auth;

            $opl = Opleiding::with('user')->where('naam', $auth)->whereYear('eind', $eind)->where('behaald', 1)->paginate(25);

            return view('MijnOpleiding', array('opl' => $opl, 'auth' => $auth, 'eind' => $eind));
        } else {

            $auth = Auth::user()->opleiding()->get()->last()->naam;
            $eind = Auth::user()->opleiding()->get()->last()->eind;
            $eind = substr($eind, 0, 4);
            $opl = Opleiding::with('user')->where('naam', $auth)->where('behaald', 1)->paginate(25);

            return view('MijnOpleiding', array('opl' => $opl, 'auth' => $auth, 'eind' => $eind));
        }
    }


    public function MijnOpleidingSearch(Request $request)
    {
        $opleiding = request('opleiding');
        $jaar = request('jaar');
        $keyword = request('searchinput');
        $keyword = explode(" ", $keyword);

        if ($keyword != '') {
            foreach ($keyword as $key) {
                $users = DB::table('users')
                    ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                    ->select('users.*', 'opleiding.*')
                    ->where('naam', '=', $opleiding)
                    ->where('eind', 'LIKE', "$jaar%")
                    ->where('behaald', 1)
                    ->Where(function ($query) use ($key) {
                        $query->where('voornaam', 'LIKE', "%$key%")
                            ->orWhere('tussenvoegsel', 'LIKE', "%$key%")
                            ->orWhere('achternaam', 'LIKE', "%$key%");
                    })
                    ->paginate(25);

                $auth = Auth::user()->opleiding()->get()->last()->naam;
                $eind = Auth::user()->opleiding()->get()->last()->eind;

                return view('MijnOpleidingSearch', array('opl' => $users, 'auth' => $auth, 'eind' => $eind));
            }
        }
    }

    public function search(request $request)
    {
        $keyword = request('searchinput');
        $keyword = explode(" ", $keyword);

        $users = User::SearchByKeyword($keyword)->paginate(25);


        if (count($users) == '0') {
            return redirect::to('overview')->with('error', 'Geen zoekresultaten gevonden');

        } Else {
            $users->count();
            $users->total();
            $richtingen = dropdown_richting::all();
            $opleidingen = dropdown_opleidingen::all();
            $specialisaties = dropdown_specialisaties::all();

            $request->session()->flash('status', 'Aantal zoekresultaten gevonden:' . ' ' . $users->total());

            return view('overview', array('users' => $users, 'richtingen' => $richtingen, 'opleidingen' => $opleidingen, 'specialisaties' => $specialisaties));
        }
    }


    public function filter(Request $request)
    {

        $richtingen = request('richtingen');
        $opleidingen = request('opleidingen');
        $specialisaties = request('specialisaties');

        $users = DB::table('users')
            ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
            ->select('users.*', 'opleiding.*')
            ->where([
                ['naam', $opleidingen],
                ['richting', $richtingen],
            ])
            ->paginate(25);

        if (count($users) == '0') {
            return redirect::to('overview')->with('error', 'Geen zoekresultaten gevonden');
        } else {
            $request->session()->flash('statusN', 'Aantal zoekresultaten gevonden:' . ' ' . $users->total());
        }

        $richtingen = dropdown_richting::all();
        $opleidingen = dropdown_opleidingen::all();
        $specialisaties = dropdown_specialisaties::all();

        return view('filter', array('users' => $users, 'richtingen' => $richtingen, 'opleidingen' => $opleidingen, 'specialisaties' => $specialisaties))->with('status', '');

    }

    public
    function createOpleiding(Request $request)
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
        $id = $request['user_id'];
        opleiding::create($data);
        return redirect::to('profiel/' . $id)->with('message', 'Opleiding toegevoegd');
    }

    public
    function deleteOpleiding(Request $request)
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


    public
    function createBedrijf(Request $request)
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
        $id = $request['user_id'];
        bedrijf::create($data);
        return redirect::to('profiel/' . $id)->with('message', 'bedrijf toegevoegd');
    }

    public
    function deleteBedrijf(Request $request)
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


    public
    function createWoonplaats(Request $request)
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
        $id = $request['user_id'];
        woonplaats::create($data);
        return redirect::to('profiel/' . $id)->with('message', 'woonplaats toegevoegd');
        //return view('profiel/' . $id);
    }

    public
    function deleteWoonplaats(Request $request)
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


    public
    function update(Request $req)
    {
        $id = $req->id;
        $user = user::find($id);
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
            'geenmailverzenden' => $req['geenmailverzenden'],
            'bevoegdheid' => $req['bevoegdheid'],
            'afdeling' => $req['afdeling']
        );
        $user->fill($new_user_data);
        $user->save();
        //return view('profiel', array('user' => Auth::user()));
        return back()->with('status', 'Update was succesvol!!');
    }

    public
    function SoftDelete(request $id)
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


    public
    function MassSoftDelete(Request $users)
    {

        if (empty($users->checkbox)) {
            return redirect::to('overview')->with('error', 'Geen gebruikers verwijderd, selecteer gebruikers');
        } else {
            $checkbox = $users->checkbox;
            foreach ($checkbox as $id)
                $id = User::where('id', $id)->delete();


            return redirect()->action('UserController@index');
        }
    }

}

