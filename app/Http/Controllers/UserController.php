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
use App\richting;
use App\User;
use App\Opleiding;
use App\Bedrijf;
use App\Woonplaats;
use App\Comment;
use Illuminate\Support\Facades\DB;
use Response;

class UserController extends Controller
{
    public function redirectCheck()
    {
        if (auth::guest()) {
            return view('auth/login');
        } else {
            if (Auth::user()->bevoegdheid == 3) {
                return redirect()->action('UserController@index');

            } else {

                return redirect()->action('UserController@mijnOpleiding');
            }

        }
    }


    public function profiel()
    {
        $richtingen = dropdown_richting::all();
        return view('profiel', array('user' => Auth::user(), 'richtingen' => $richtingen));
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
        //return view('profiel', compact('user'));
        $richtingen = dropdown_richting::all();
        return view('profiel', array('user' => $user, 'richtingen' => $richtingen));
    }


    public function mijnOpleiding()
    {
        if (Auth::user()->bevoegdheid == 1) {
            $auth = Auth::user()->opleiding()->get()->last()->naam;
            $eind = Auth::user()->opleiding()->get()->last()->eind;
            $eind = substr($eind, 0, 4);

            $richtingen = dropdown_richting::all();
            $opleidingen = dropdown_opleidingen::all();
            $specialisaties = dropdown_specialisaties::all();

            $opl = Opleiding::with('user')->where('naam', $auth)->whereYear('eind', $eind)->where('behaald', 1)->paginate(25);

            return view('MijnOpleiding', array('opl' => $opl, 'auth' => $auth, 'eind' => $eind, 'richtingen' => $richtingen, 'opleidingen' => $opleidingen, 'specialisaties' => $specialisaties));
        } else {

            $auth = Auth::user()->afdeling;
            $eind = Auth::user()->opleiding()->get()->last()->eind;
            $eind = substr($eind, 0, 4);


            $opl = Opleiding::with('user')->where('richting', $auth)->where('behaald', 1)->paginate(25);

            return view('MijnOpleiding', array('opl' => $opl, 'auth' => $auth, 'eind' => $eind));
        }
    }


    public function MijnOpleidingSearch(Request $request)
    {
        if (Auth::user()->bevoegdheid == 1) {
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
                    $eind = substr($eind, 0, 4);


                    $richtingen = dropdown_richting::all();
                    $opleidingen = dropdown_opleidingen::all();
                    $specialisaties = dropdown_specialisaties::all();


                    return view('MijnOpleidingSearch', array('opl' => $users, 'auth' => $auth, 'eind' => $eind, 'richtingen' => $richtingen, 'opleidingen' => $opleidingen, 'specialisaties' => $specialisaties));
                }
            } else {
                return redirect()->back('mijnopleiding');
            }

        } else {
            $opleiding = Auth::user()->afdeling;
            $eind = '';
            $keyword = request('searchinput');
            $keyword = explode(" ", $keyword);

            if ($keyword != '') {
                foreach ($keyword as $key) {
                    $users = DB::table('users')
                        ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                        ->select('users.*', 'opleiding.*')
                        ->where('richting', '=', $opleiding)
                        ->where('behaald', 1)
                        ->Where(function ($query) use ($key) {
                            $query->where('voornaam', 'LIKE', "%$key%")
                                ->orWhere('tussenvoegsel', 'LIKE', "%$key%")
                                ->orWhere('achternaam', 'LIKE', "%$key%");
                        })
                        ->paginate(25);

                    $richtingen = dropdown_richting::all();
                    $opleidingen = dropdown_opleidingen::all();
                    $specialisaties = dropdown_specialisaties::all();

                    return view('MijnOpleidingSearch', array('opl' => $users, 'auth' => $opleiding, 'eind' => $eind, 'richtingen' => $richtingen, 'opleidingen' => $opleidingen, 'specialisaties' => $specialisaties));
                }
            } else {
                return redirect()->back('mijnopleiding');
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


        If (empty($specialisaties)) {


            $users = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleidingen],
                    ['richting', $richtingen],
                ])->where('users.deleted_at', '=', null)
                ->paginate(25);


        } else {

            $users = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleidingen],
                    ['richting', $richtingen],

                ])->where('specialisatie', $specialisaties)
                ->where('users.deleted_at', '=', null)
                ->paginate(25);

        }

        if (count($users) == '0') {
            return redirect::to('overview')->with('error', 'Geen zoekresultaten gevonden');
        } else {
            $request->session()->flash('status', 'Aantal zoekresultaten gevonden:' . ' ' . $users->total());
        }

        $richtingen = dropdown_richting::all();

        return view('filter', array('users' => $users, 'richtingen' => $richtingen))->with('status');

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


    public function createBedrijf(Request $request)
    {
        $address = $request->adres;
        $postcode = $request->postcode;

        $address = str_replace(" ", "%", $address);
        $postcode = str_replace(" ", "%", $postcode);

        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address+$postcode";

        $response = file_get_contents($url);

        if (!$response == '') {

            $json = json_decode($response, TRUE);


            $lat = $json['results'][0]['geometry']['location']['lat'];
            $lng = $json['results'][0]['geometry']['location']['lng'];


            $data = array(
                'naam' => $request['naam'],
                'functie' => $request['functie'],
                'richting' => $request['richting'],
                'begin' => $request['begin'],
                'eind' => $request['eind'],
                'stad' => $request['stad'],
                'postcode' => $request['postcode'],
                'straatnaam' => $request['adres'],
                'longitude' => $lng,
                'latitude' => $lat,
                'telefoonnummer' => $request['telefoonnummer'],
                'bezoekadres' => $request['bezoekadres'],
                'land' => $request['land'],
                'provincie' => $request['provincie'],
                'user_id' => $request['user_id']
            );
            $id = $request['user_id'];
            bedrijf::create($data);
            return redirect::to('profiel/' . $id)->with('message', 'bedrijf toegevoegd');
        } else {
            $id = $request['user_id'];
            return redirect::to('profiel/' . $id)->with('error', 'Geen geldig adres');
        }


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


    public
    function createWoonplaats(Request $request)
    {
        $address = $request->straatnaam;
        $postcode = $request->postcode;

        $address = str_replace(" ", "%", $address);
        $postcode = str_replace(" ", "%", $postcode);

        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address+$postcode";

        $response = file_get_contents($url);

        if (!$response == '') {

            $json = json_decode($response, TRUE);

            $lat = $json['results'][0]['geometry']['location']['lat'];
            $lng = $json['results'][0]['geometry']['location']['lng'];


            $data = array(
                'naam' => $request['straatnaam'],
                'postcode' => $request['postcode'],
                'begin' => $request['begin'],
                'eind' => $request['eind'],
                'longitude' => $lng,
                'latitude' => $lat,
                'land' => $request['land'],
                'provincie' => $request['provincie'],
                'user_id' => $request['user_id']
            );
            $id = $request['user_id'];
            woonplaats::create($data);
            return redirect::to('profiel/' . $id)->with('message', 'woonplaats toegevoegd');
        } else {
            $id = $request['user_id'];
            return redirect::to('profiel/' . $id)->with('error', 'Geen geldig adres');
        }

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
//            'bevoegdheid' => $req['bevoegdheid'],
            'afdeling' => $req['afdeling']
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
        $woonplaats = Woonplaats::where('user_id', $id);
        $opleiding = Opleiding::where('user_id', $id);
        $bedrijf = Bedrijf::where('user_id', $id);


        $user->delete();
        $woonplaats->delete();
        $opleiding->delete();
        $bedrijf->delete();


        if (Auth::user()->bevoegdheid == 3) {
            return redirect()->action('UserController@index');
        } else {
            return view('/', array('user' => Auth::logout()));
        }

    }


    public function MassSoftDelete(Request $request)
    {
        $users = $request->checkbox;

        if ($users == '') {
            return redirect()->back()->with('error', 'Geen gebruikers verwijderd, selecteer gebruikers');
        } else {
            $checkbox = $users;
            foreach ($checkbox as $id) {
                $user = User::where('id', $id);
                $bedrijf = Bedrijf::where('user_id', $id);
                $woonplaats = Woonplaats::where('user_id', $id);
                $opleiding = Opleiding::where('user_id', $id);

                $user->delete();
                $woonplaats->delete();
                $opleiding->delete();
                $bedrijf->delete();
            }
            return redirect()->back()->with('error', 'gebruikers verwijderd');

        }
    }

    public
    function addUserIndex()
    {
        $richtingen = dropdown_richting::all();
        $opleidingen = dropdown_opleidingen::all();
        $specialisaties = dropdown_specialisaties::all();

        return view('addUser', array('richtingen' => $richtingen, 'opleidingen' => $opleidingen, 'specialisaties' => $specialisaties, 'user' => Auth::user()));
    }

    public
    function addUser(request $request)
    {

        $user = new User;
        $user->voornaam = $request['voornaam'];
        $user->tussenvoegsel = $request['tussenvoegsel'];
        $user->achternaam = $request['achternaam'];
        $user->email = $request['email'];
        $user->hashemail = bcrypt($request['email']);
        $user->geslacht = $request['geslacht'];
        $user->studentnummer = $request['studentnummer'];
        $user->post_adres = $request['post_adres'];
        $user->telefoonnummer = $request['telefoonnummer'];
        $user->geboortedatum = $request['geboortedatum'];
        $user->geboorteplaats = $request['geboorteplaats'];
        $user->geboorteprovincie = $request['geboorteprovincie'];
        $user->geboorteland = $request['geboorteland'];
        $user->nationaliteit = $request['nationaliteit'];
        if ($request['bevoegdheid'] == "Alumni" || $request['bevoegdheid'] == "Docent") {
            $user->bevoegdheid = 1;
        } else if ($request['bevoegdheid'] == "Opleidingsadmin") {
            $user->bevoegdheid = 2;
        } else {
            $user->bevoegdheid = 3;
        }
        $user->afdeling = $request['afdeling'];
        $user->foto = 'default.png';

        $opleiding = new Opleiding;
        $opleiding->naam = $request['opleidingen'];
        $opleiding->richting = $request['richtingen'];
        $opleiding->specialisatie = $request['specialisaties'];
        $opleiding->instituut = $request['opleidingsinstituut'];
        $opleiding->begin = $request['begin'];
        $opleiding->eind = $request['eind'];
        $opleiding->locatie = $request['locatie'];
        $opleiding->niveau = $request['niveau'];
        $opleiding->behaald = 1;
        $opleiding->land = $request['opleidingsprovincie'];
        $opleiding->provincie = $request['opleidingsland'];

        $emailExists = User::where('email', $request['email'])->exists();

        if ($emailExists == null) {
            $user->save();
            $opleiding->user()->associate($user);
            $opleiding->save();

            Mail::to($user['email'])->send(new Welkommail($user));

            return Redirect::back()->with('status', 'De user is succesvol toegevoegd');
        } else {
            return redirect::back()->with('error', 'Dit e-mailadres is al in gebruik.');
        }

    }

    public
    function setPassIndex()
    {
        return view('auth/passwords/setPass');
    }

    public
    function setPass(request $request)
    {
        $auth = ($request->auth);
        $user = User::where('hashemail', $auth)->first();
        if ($user->password != "") {
            return redirect::back()->with('error', 'Uw wachtwoord is al ingesteld.');
        }
        if ($request->password == $request->confirmpw) {
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect::to('/');
        } else {
            return redirect::back()->with('error', 'De wachtwoorden komen niet overeen');
        }
    }


}

