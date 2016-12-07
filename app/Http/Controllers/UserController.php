<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Illuminate\Support\Facades\App;
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
            'geenmailverzenden' => $req['geenmailverzenden'],
            'naam' => $req['naam']
        );
        $user->fill($new_user_data);
        $user->save();
        return view('profiel', array('user' => Auth::user()));
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
        }
        else {
            $checkbox = $users->checkbox;
            foreach ($checkbox as $id)
                $id = User::where('id', $id)->delete();


          return redirect()->action('UserController@index');
        }
    }

}

