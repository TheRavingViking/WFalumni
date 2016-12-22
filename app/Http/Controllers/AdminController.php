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

        $countUser = User::all()->where('bevoegdheid', 1)->count();
        $countPersoneel = User::all()->where('bevoegdheid', '>', 1)->count();

        $total = User::all()->count();
        $man = User::all('geslacht')->where('geslacht', 'Man')->count();
        $vrouw = User::all('geslacht')->where('geslacht', 'Vrouw')->count();
        $per_man = round($man / $total * 100, 2);
        $per_vrouw = round($vrouw / $total * 100, 2);
        $averageJaarInkomen = User::avg('jaarinkomen');

        return view('dashboard', array(
            'richtingen' => $richtingen,
            'opleidingen' => $opleidingen,
            'specialisaties' => $specialisaties,
            'jaarinkomen' => $averageJaarInkomen,
            'countUser' => $countUser,
            'countPersoneel' => $countPersoneel,
            'man' => $per_man,
            'vrouw' => $per_vrouw));

    }

    public function dashboardFilter(request $request)
    {
        if (!empty($request)) {

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


            return view('dashboard', array(
                'richtingen' => $richtingen,
                'opleidingen' => $opleidingen,
                'specialisaties' => $specialisaties,
                'jaarinkomen' => $averageJaarInkomen,
                'countUser' => $countUser,
                'countPersoneel' => $countPersoneel,
                'man' => $per_man,
                'vrouw' => $per_vrouw));
        } else {

            return redirect()->back('dashboard');

        }


    }


    public function AdminAssign(Request $req)
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


        // Draw a map
        Mapper::map(52.5, 5);

        // Add information window for each address
        $woonplaats = woonplaats::all();

            foreach($woonplaats as $c){
                Mapper::marker($c->latitude, $c->longitude);
            }

        return view('geochart');

    }
}

