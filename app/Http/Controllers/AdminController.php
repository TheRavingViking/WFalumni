<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Auth;
use Illuminate\Http\Request;
use App\dropdown_opleidingen;
use App\dropdown_richting;
use App\dropdown_specialisaties;
use Illuminate\Support\Facades\Redirect;
use khill\lavacharts\lavacharts;


class AdminController extends Controller
{
    public function adminOpleidingen()
    {
        $richtingen = dropdown_richting::all();
        $opleidingen = dropdown_opleidingen::all();
        $specialisaties = dropdown_specialisaties::all();

        return view('adminOpleidingen', array('richtingen' => $richtingen, 'opleidingen' => $opleidingen, 'specialisaties' => $specialisaties));
    }

    public function createRichting(Request $request)
    {
        $richting = array('naam' => $request['richtingen']);
        dropdown_richting::create($richting);
        return Redirect::to('adminOpleidingen')->with('message', 'Richting toegevoegd');
    }

    public function createOpleiding(Request $request)
    {
        $opleiding = array('naam' => $request['opleidingen'], 'richtingen_id' => $request['richtingen']);
        dropdown_opleidingen::create($opleiding);
        return Redirect::to('adminOpleidingen')->with('message', 'Opleidingen toegevoegd');
    }

    public function createSpecialisatie(Request $request)
    {
        $specialisatie = array('naam' => $request['specialisaties'], 'opleidingen_id' => $request['opleidingen']);
        dropdown_specialisaties::create($specialisatie);
        return Redirect::to('adminOpleidingen')->with('message', 'Specialisaties toegevoegd');
    }

    public function index()
    {
        $users = User::get();
        return view('admin', compact('users'));

    }

    public function dashboard()
    {
        $richtingen = dropdown_richting::all();
        $opleidingen = dropdown_opleidingen::all();
        $specialisaties = dropdown_specialisaties::all();

        $countUser = User::all()->where('bevoegdheid', 1)->count();
        $countPersoneel = User::all()->where('bevoegdheid', '>', 1)->count();

        $total = User::all()->count();
        $man = User::all('geslacht')->where('geslacht', 'Man')->count();
        $vrouw = User::all('geslacht')->where('geslacht', 'Vrouw')->count();
        $per_man = round($man / $total * 100, 2);
        $per_vrouw = round($vrouw / $total * 100, 2);


        return view('dashboard', array(
            'richtingen' => $richtingen,
            'opleidingen' => $opleidingen,
            'specialisaties' => $specialisaties,
            'countUser' => $countUser,
            'countPersoneel' => $countPersoneel,
            'man' => $per_man,
            'vrouw' => $per_vrouw ));

    }

    public function dashboardFilter(request $request)
    {
        $richtingen = dropdown_richting::all();
        $opleidingen = dropdown_opleidingen::all();
        $specialisaties = dropdown_specialisaties::all();

        $countUser = User::with('opleidingen')->where('bevoegdheid', 1)->count();
        $countPersoneel = User::all()->where('bevoegdheid', '>', 1)->count();

        $total = User::all()->count();
        $man = User::all('geslacht')->where('geslacht', 'Man')->count();
        $vrouw = User::all('geslacht')->where('geslacht', 'Vrouw')->count();
        $per_man = round($man / $total * 100, 2);
        $per_vrouw = round($vrouw / $total * 100, 2);


        return view('dashboard', array(
            'richtingen' => $richtingen,
            'opleidingen' => $opleidingen,
            'specialisaties' => $specialisaties,
            'countUser' => $countUser,
            'countPersoneel' => $countPersoneel,
            'man' => $per_man,
            'vrouw' => $per_vrouw ));

    }


    public function postAdminAssignRoles(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        $user->roles()->detach();
        if ($request['role_user']) {
            $user->roles()->attach(Role::where('name', 'User')->first());
        }
        if ($request['role_author']) {
            $user->roles()->attach(Role::where('name', 'Author')->first());
        }
        if ($request['role_admin']) {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        return redirect()->back();

    }
}