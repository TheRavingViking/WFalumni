<?php

namespace App\Http\Controllers;

use App\opleiding;
use App\User;
use App\Role;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\dropdown_opleidingen;
use App\dropdown_richting;
use App\dropdown_specialisaties;
use Illuminate\Support\Facades\Redirect;


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

        $averageJaarInkomen = User::avg('jaarinkomen');
        $countJaarInkomenLaag = User::all('jaarinkomen')->where('jaarinkomen', '<=', 12500)->count();
        $countJaarInkomenLaagMidden = DB::table('users')->whereBetween('jaarinkomen', [12500, 30000])->count();
        $countJaarInkomenMidden = DB::table('users')->whereBetween('jaarinkomen', [30000, 50000])->count();
        $countJaarInkomenMiddenHoog = DB::table('users')->whereBetween('jaarinkomen', [50000, 100000])->count();
        $countJaarInkomenHoog = User::all('jaarinkomen')->where('jaarinkomen', '>', 100000)->count();

        $ouders = User::all()->where('heeft_kinderen', '=', 1)->count();
        $nietOuders = User::all()->where('heeft_kinderen', '=', 0)->count();

        return view('dashboard', array(
            'richtingen' => $richtingen,
            'opleidingen' => $opleidingen,
            'specialisaties' => $specialisaties,
            'jaarinkomen' => $averageJaarInkomen,
            'countUser' => $countUser,
            'countPersoneel' => $countPersoneel,
            'man' => $per_man,
            'vrouw' => $per_vrouw,
            'laaginkomen' => $countJaarInkomenLaag,
            'laagmiddeninkomen' => $countJaarInkomenLaagMidden,
            'middeninkomen' => $countJaarInkomenMidden,
            'middenhooginkomen' => $countJaarInkomenMiddenHoog,
            'hooginkomen' => $countJaarInkomenHoog,
            'ouders' => $ouders,
            'nietOuders' => $nietOuders,
            ));
    }

    public function dashboardFilter(request $request)
    {
        //return $request;
        if (!empty($request->richtingen)) {

            $richting = request('richtingen');
            $opleiding = request('opleidingen');
            $specialisatie = request('specialisaties');

            $richtingen = dropdown_richting::all();
            $opleidingen = dropdown_opleidingen::all();
            $specialisaties = dropdown_specialisaties::all();

            $countPersoneel = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting],
                    ['bevoegdheid', '>', 1],
                ])
                ->count();

            $countUser = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting],
                    ['bevoegdheid', 1],
                ])
                ->count();

            $total = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting],
                ])
                ->count();

            $man = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting],
                    ['Geslacht', 'Man'],
                ])
                ->count();

            $vrouw = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting],
                    ['Geslacht', 'Vrouw'],
                ])
                ->count();

            if (!$total == 0) {
                $per_man = round($man / $total * 100, 2);
                $per_vrouw = round($vrouw / $total * 100, 2);
            } else {
                $per_man = 0;
                $per_vrouw = 0;
            }

            $averageJaarInkomen = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting],
                ])
                ->avg('jaarinkomen');

            $countJaarInkomenLaag = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])
                ->where('jaarinkomen', '<=', 12500)->count();

            $countJaarInkomenLaagMidden = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])
                ->whereBetween('jaarinkomen', [12500, 30000])->count();

            $countJaarInkomenMidden = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])
                ->whereBetween('jaarinkomen', [30000, 50000])->count();

            $countJaarInkomenMiddenHoog = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])
                ->whereBetween('jaarinkomen', [50000, 100000])->count();

            $countJaarInkomenHoog = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])
                ->where('jaarinkomen', '>', 100000)->count();

            $ouders = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where('heeft_kinderen', '=', 1)->count();

            $nietOuders = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where('heeft_kinderen', '=', 0)->count();


            return view('dashboard', array(
                'richtingen' => $richtingen,
                'opleidingen' => $opleidingen,
                'specialisaties' => $specialisaties,
                'jaarinkomen' => $averageJaarInkomen,
                'countUser' => $countUser,
                'countPersoneel' => $countPersoneel,
                'man' => $per_man,
                'vrouw' => $per_vrouw,
                'laaginkomen' => $countJaarInkomenLaag,
                'laagmiddeninkomen' => $countJaarInkomenLaagMidden,
                'middeninkomen' => $countJaarInkomenMidden,
                'middenhooginkomen' => $countJaarInkomenMiddenHoog,
                'hooginkomen' => $countJaarInkomenHoog,
                'ouders' => $ouders,
                'nietOuders' => $nietOuders,
                ));
        }else{

            return redirect()->back();

        }


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