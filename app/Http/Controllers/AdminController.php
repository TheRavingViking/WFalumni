<?php

namespace App\Http\Controllers;

use App\woonplaats;
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
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

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
        $personeel = User::all()->where('bevoegdheid', '>', 1);

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
            'personeel' => $personeel,
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
        } else {

            return redirect()->back();

        }


    }


    public function postAdminAssignRoles(Request $request)
    {
        $id = $req->id;
        $user = user::find($id);
        $data = $req->only('bevoegdheid');

        $user->fill($data);
        $user->save();
//dd($user);
        return back()->with('message', 'Update gelukt!');


    }

    public function GeoChart()
    {

        $richtingen = dropdown_richting::all();
        $opleidingen = dropdown_opleidingen::all();
        $specialisaties = dropdown_specialisaties::all();


        // Draw a map
        Mapper::map(52.5, 5);


        return view('geochart', array('richtingen' => $richtingen, 'opleidingen' => $opleidingen, 'specialisaties' => $specialisaties));

    }

    public function GeoChartfilter(request $request)
    {

        $radio = $request->radio;

        if ($radio == 'woonplaats') {

            $richtingen = dropdown_richting::all();
            $opleidingen = dropdown_opleidingen::all();
            $specialisaties = dropdown_specialisaties::all();

            $opleiding = $request->opleidingen;
            $richting = $request->richtingen;
            // Draw a map
            Mapper::map(52.5, 5);

            $users = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->join('woonplaats', 'users.id', '=', 'woonplaats.user_id')
                ->select('users.*', 'opleiding.*', 'woonplaats.*')
                ->where([
                    ['opleiding.naam', $opleiding],
                    ['richting', $richting],
                ])
                ->get();

            foreach ($users as $c) {
                Mapper::marker($c->latitude, $c->longitude);
            }

            return view('geochart', array('richtingen' => $richtingen, 'opleidingen' => $opleidingen, 'specialisaties' => $specialisaties));


        } else {


            $richtingen = dropdown_richting::all();
            $opleidingen = dropdown_opleidingen::all();
            $specialisaties = dropdown_specialisaties::all();

            $opleiding = $request->opleidingen;
            $richting = $request->richtingen;

            Mapper::map(52.5, 5);

            $users = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->join('bedrijf', 'users.id', '=', 'bedrijf.user_id')
                ->select('users.*', 'opleiding.*', 'bedrijf.*')
                ->where([
                    ['opleiding.naam', $opleiding],
                    ['opleiding.richting', $richting],
                ])
                ->get();

            foreach ($users as $c) {
                Mapper::marker($c->latitude, $c->longitude);
            }

            return view('geochart', array('richtingen' => $richtingen, 'opleidingen' => $opleidingen, 'specialisaties' => $specialisaties));

        }

    }
}