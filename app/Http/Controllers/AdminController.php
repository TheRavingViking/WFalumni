<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\Role;
use Auth;
use Illuminate\Http\Request;
use App\dropdown_opleidingen;
use App\dropdown_richting;
use App\dropdown_specialisaties;
use Illuminate\Support\Facades\Redirect;
use App\Richtingen;
use App\Opleidingen;
use App\Specialisaties;

class AdminController extends Controller
{
    public function adminOpleidingen() {
        $richtingen = dropdown_richting::all();
        $opleidingen = dropdown_opleidingen::all();
        $specialisaties = dropdown_specialisaties::all();

        return view('adminOpleidingen', array('richtingen' => $richtingen, 'opleidingen' => $opleidingen, 'specialisaties' => $specialisaties)) ;
    }

    public function createRichting(Request $request) {
        $richting = array('naam' => $request['richtingen']);
        Richtingen::create($richting);
        return Redirect::to('adminOpleidingen')->with('message', 'Richting toegevoegd');
    }

    public function createOpleiding(Request $request) {
        $opleiding = array('naam' => $request['opleidingen'], 'richtingen_id' => $request['richtingen']);
        Opleidingen::create($opleiding);
        return Redirect::to('adminOpleidingen')->with('message', 'Opleidingen toegevoegd');
    }

    public function createSpecialisatie(Request $request)
    {
        $specialisatie = array('naam' => $request['specialisaties'], 'opleidingen_id' => $request['opleidingen']);
        Specialisaties::create($specialisatie);
        return Redirect::to('adminOpleidingen')->with('message', 'Specialisaties toegevoegd');
    }
    public function index()
    {

        $users = DB::table('users')->get();

        return view('admin', compact('users') );

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