<?php

namespace App\Http\Controllers;

use App\woonplaats;
use App\opleiding;
use App\User;
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

    public function search(request $request)
    {
        $keyword = request('searchinput');
        $keyword = explode(" ", $keyword);

        $users = User::SearchByKeyword($keyword)->paginate(25);


        if (count($users) == '0') {
            return redirect::to('admin')->with('error', 'Geen zoekresultaten gevonden');

        } Else {
            $users->count();
            $users->total();

            $request->session()->flash('status', 'Aantal zoekresultaten gevonden:' . ' ' . $users->total());

            return view('admin', array('users' => $users));
        }
    }

    public function dashboard()
    {
        $richtingen = dropdown_richting::all();
        $personeel = User::all()->where('bevoegdheid', '>', 1);

        $countUser = User::all()->where('bevoegdheid', 1)->count();
        $countPersoneel = User::all()->where('bevoegdheid', '>', 1)->count();

        $total = User::all()->count();
        $man = User::all('geslacht')->where('geslacht', 'Man')->count();
        $vrouw = User::all('geslacht')->where('geslacht', 'Vrouw')->count();
        $per_man = round($man / $total * 100, 2);
        $per_vrouw = round($vrouw / $total * 100, 2);

        $averageJaarInkomen = User::avg('jaarinkomen');

        $countJaarInkomenLaagMan = DB::table('users')
            ->where('jaarinkomen', '<=', 12500)
            ->where('geslacht', 'Man')->count();

        $countJaarInkomenLaagVrouw = DB::table('users')
            ->where('jaarinkomen', '<=', 12500)
            ->where('geslacht', 'Vrouw')->count();

        $countJaarInkomenLaagMiddenMan = DB::table('users')
            ->whereBetween('jaarinkomen', [12500, 30000])
            ->where('geslacht', 'Man')->count();

        $countJaarInkomenLaagMiddenVrouw = DB::table('users')
            ->whereBetween('jaarinkomen', [12500, 30000])
            ->where('geslacht', 'Vrouw')->count();

        $countJaarInkomenMiddenMan = DB::table('users')
            ->whereBetween('jaarinkomen', [30000, 50000])
            ->where('geslacht', 'Man')->count();

        $countJaarInkomenMiddenVrouw = DB::table('users')
            ->whereBetween('jaarinkomen', [30000, 50000])
            ->where('geslacht', 'Vrouw')->count();

        $countJaarInkomenMiddenHoogMan = DB::table('users')
            ->whereBetween('jaarinkomen', [50000, 100000])
            ->where('geslacht', 'Man')->count();

        $countJaarInkomenMiddenHoogVrouw = DB::table('users')
            ->whereBetween('jaarinkomen', [50000, 100000])
            ->where('geslacht', 'Vrouw')->count();

        $countJaarInkomenHoogMan = DB::table('users')
            ->where('jaarinkomen', '>', 100000)
            ->where('geslacht', 'Man')->count();

        $countJaarInkomenHoogVrouw = DB::table('users')
            ->where('jaarinkomen', '>', 100000)
            ->where('geslacht', 'Vrouw')->count();

        $ouders = User::all()->where('heeft_kinderen', '=', 1)->count();
        $nietOuders = User::all()->where('heeft_kinderen', '=', 0)->count();

        $werkend = DB::table('users')
            ->join('bedrijf', 'users.id', '=', 'bedrijf.user_id')
            ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
            ->select('users.voornaam', 'opleiding.richting as opleiding_richting', 'bedrijf.richting as bedrijf_richting')
            ->wherecolumn('bedrijf.richting', 'opleiding.richting')
            ->get()->count();

        $nietWerkend = User::all()->count() - $werkend;


        return view('dashboard', array(
            'richtingen' => $richtingen,
            'jaarinkomen' => $averageJaarInkomen,
            'countUser' => $countUser,
            'countPersoneel' => $countPersoneel,
            'man' => $per_man,
            'vrouw' => $per_vrouw,
            'laaginkomenman' => $countJaarInkomenLaagMan,
            'laagmiddeninkomenman' => $countJaarInkomenLaagMiddenMan,
            'middeninkomenman' => $countJaarInkomenMiddenMan,
            'middenhooginkomenman' => $countJaarInkomenMiddenHoogMan,
            'hooginkomenman' => $countJaarInkomenHoogMan,
            'laaginkomenvrouw' => $countJaarInkomenLaagVrouw,
            'laagmiddeninkomenvrouw' => $countJaarInkomenLaagMiddenVrouw,
            'middeninkomenvrouw' => $countJaarInkomenMiddenVrouw,
            'middenhooginkomenvrouw' => $countJaarInkomenMiddenHoogVrouw,
            'hooginkomenvrouw' => $countJaarInkomenHoogVrouw,
            'ouders' => $ouders,
            'nietOuders' => $nietOuders,
            'personeel' => $personeel,
            'werkend' => $werkend,
            'nietWerkend' => $nietWerkend,
        ));
    }

    public function dashboardFilter(request $request)
    {
        if (!empty($request->richtingen)) {
            if (empty($request->opleidingen)){
                return redirect()->back()->with('error', 'Opleiding vereist');
            }
            $richting = request('richtingen');
            $opleiding = request('opleidingen');
            $specialisatie = request('specialisaties');

            $richtingen = dropdown_richting::all();

            $countPersoneel = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting],
                    ['bevoegdheid', '>', 1],
                ])->where('users.deleted_at', '=', null)
                ->count();

            $countUser = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting],
                    ['bevoegdheid', 1],
                ])->where('users.deleted_at', '=', null)
                ->count();

            $total = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting],
                ])->where('users.deleted_at', '=', null)
                ->count();

            $man = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting],
                    ['Geslacht', 'Man'],
                ])->where('users.deleted_at', '=', null)
                ->count();

            $vrouw = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting],
                    ['Geslacht', 'Vrouw'],
                ])->where('users.deleted_at', '=', null)
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
                ])->where('users.deleted_at', '=', null)
                ->avg('jaarinkomen');

            $countJaarInkomenLaagMan = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])->where('users.deleted_at', '=', null)
                ->where('jaarinkomen', '<=', 12500)
                ->where('geslacht', 'Man')->count();

            $countJaarInkomenLaagVrouw = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])->where('users.deleted_at', '=', null)
                ->where('jaarinkomen', '<=', 12500)
                ->where('geslacht', 'Vrouw')->count();

            $countJaarInkomenLaagMiddenMan = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])->where('users.deleted_at', '=', null)
                ->whereBetween('jaarinkomen', [12500, 30000])
                ->where('geslacht', 'Man')->count();

            $countJaarInkomenLaagMiddenVrouw = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])->where('users.deleted_at', '=', null)
                ->whereBetween('jaarinkomen', [12500, 30000])
                ->where('geslacht', 'Vrouw')->count();

            $countJaarInkomenMiddenMan = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])->where('users.deleted_at', '=', null)
                ->whereBetween('jaarinkomen', [30000, 50000])
                ->where('geslacht', 'Man')->count();

            $countJaarInkomenMiddenVrouw = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])->where('users.deleted_at', '=', null)
                ->whereBetween('jaarinkomen', [30000, 50000])
                ->where('geslacht', 'Vrouw')->count();

            $countJaarInkomenMiddenHoogMan = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])->where('users.deleted_at', '=', null)
                ->whereBetween('jaarinkomen', [50000, 100000])
                ->where('geslacht', 'Man')->count();

            $countJaarInkomenMiddenHoogVrouw = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])->where('users.deleted_at', '=', null)
                ->whereBetween('jaarinkomen', [50000, 100000])
                ->where('geslacht', 'Vrouw')->count();

            $countJaarInkomenHoogMan = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])->where('users.deleted_at', '=', null)
                ->where('jaarinkomen', '>', 100000)
                ->where('geslacht', 'Man')->count();

            $countJaarInkomenHoogVrouw = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])->where('users.deleted_at', '=', null)
                ->where('jaarinkomen', '>', 100000)
                ->where('geslacht', 'Vrouw')->count();

            $ouders = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])->where('users.deleted_at', '=', null)
                ->where('heeft_kinderen', '=', 1)->count();

            $nietOuders = DB::table('users')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.*')
                ->where([
                    ['naam', $opleiding],
                    ['richting', $richting]])->where('users.deleted_at', '=', null)
                ->where('heeft_kinderen', '=', 0)->count();

            $werkend = DB::table('users')
                ->join('bedrijf', 'users.id', '=', 'bedrijf.user_id')
                ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                ->select('users.*', 'opleiding.richting as opleiding_richting', 'opleiding.naam as opleiding_naam', 'bedrijf.richting as bedrijf_richting')
                ->where([
                    ['opleiding.naam', $opleiding],
                    ['opleiding.richting', $richting]])->where('users.deleted_at', '=', null)
                ->wherecolumn('bedrijf.richting', 'opleiding.richting')
                ->get()->count();

            $nietWerkend = DB::table('users')
                    ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                    ->select('users.*', 'opleiding.*')
                    ->where([
                        ['naam', $opleiding],
                        ['richting', $richting]])->where('users.deleted_at', '=', null)
                    ->count() - $werkend;


            return view('dashboard', array(
                'richtingen' => $richtingen,
                'jaarinkomen' => $averageJaarInkomen,
                'countUser' => $countUser,
                'countPersoneel' => $countPersoneel,
                'man' => $per_man,
                'vrouw' => $per_vrouw,
                'laaginkomenman' => $countJaarInkomenLaagMan,
                'laagmiddeninkomenman' => $countJaarInkomenLaagMiddenMan,
                'middeninkomenman' => $countJaarInkomenMiddenMan,
                'middenhooginkomenman' => $countJaarInkomenMiddenHoogMan,
                'hooginkomenman' => $countJaarInkomenHoogMan,
                'laaginkomenvrouw' => $countJaarInkomenLaagVrouw,
                'laagmiddeninkomenvrouw' => $countJaarInkomenLaagMiddenVrouw,
                'middeninkomenvrouw' => $countJaarInkomenMiddenVrouw,
                'middenhooginkomenvrouw' => $countJaarInkomenMiddenHoogVrouw,
                'hooginkomenvrouw' => $countJaarInkomenHoogVrouw,
                'ouders' => $ouders,
                'nietOuders' => $nietOuders,
                'werkend' => $werkend,
                'nietWerkend' => $nietWerkend,
            ));
        } else {

            return redirect()->back();

        }


    }

    public function AdminAssign(Request $req)
    {

        $id = $req->id;
        $user = user::find($id);
        $data = $req->only('bevoegdheid');

        $user->fill($data);
        $user->save();
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
        if (empty($request->richtingen)){
            return redirect()->back()->with('error', 'Richting vereist');
        }

        if (empty($request->opleidingen)){
            return redirect()->back()->with('error', 'Opleiding vereist');
        }

        if (empty($request->radio)){
            return redirect()->back()->with('error', 'Selecteer woonplaats of bedrijf');
        }
        $specialisaties = $request->specialisaties;

        If (empty($specialisaties)) {

            $radio = $request->radio;

            if ($radio == 'woonplaats') {

                $richtingen = dropdown_richting::all();

                $opleiding = $request->opleidingen;
                $richting = $request->richtingen;
                $specialisaties = $request->specialisaties;
                // Draw a map
                Mapper::map(52.5, 5);

                $users = DB::table('users')
                    ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                    ->join('woonplaats', 'users.id', '=', 'woonplaats.user_id')
                    ->select('users.*', 'opleiding.*', 'woonplaats.*')
                    ->where([
                        ['opleiding.naam', $opleiding],
                        ['richting', $richting],
                    ])->where('users.deleted_at', '=', null)
                    ->get();

                foreach ($users as $c) {

                    $tel = $c->telefoonnummer;
                    $email = $c->email;
                    $adres = $c->naam;
                    $postcode = $c->postcode;
                    $voornaam = $c->voornaam;
                    $tussenvoegsel = $c->tussenvoegsel;
                    $achternaam = $c->achternaam;

                    $content =   'Alumni:' . ' ' . $voornaam . ' ' . $tussenvoegsel . ' ' . $achternaam . '<br>' . 'Tel:' . ' ' . $tel .  '<br>' . 'Email:' . ' ' . $email . '<br>' . 'Adres:' . ' ' . $adres . '<br>' . 'Postcode:' . ' ' . $postcode . '<br>';

                    Mapper::informationWindow($c->latitude, $c->longitude, $content, ['markers' => ['animation' => 'DROP']]);
                }

                return view('geochart', array('richtingen' => $richtingen));


            } else {


                $richtingen = dropdown_richting::all();


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
                    ])->where('users.deleted_at', '=', null)
                    ->get();

                foreach ($users as $c) {
                    $bedrijf = $c->naam;
                    $tel = $c->telefoonnummer;
                    $adres = $c->straatnaam;
                    $postcode = $c->postcode;
                    $voornaam = $c->voornaam;
                    $tussenvoegsel = $c->tussenvoegsel;
                    $achternaam = $c->achternaam;
                    $content = 'Bedrijf:' . '' . $bedrijf . '<br>' . 'Tel:' . '' . $tel . '<br>' . 'Adres:' . '' . $adres . '<br>' . 'Postcode:' . '' . $postcode . '<br>' . 'Alumni:' . '' . $voornaam . ' ' . $tussenvoegsel . ' ' . $achternaam;

                    Mapper::informationWindow($c->latitude, $c->longitude, $content, ['markers' => ['animation' => 'DROP']]);
                }


                return view('geochart', array('richtingen' => $richtingen));

            }

        } else {


            $radio = $request->radio;

            if ($radio == 'woonplaats') {

                $richtingen = dropdown_richting::all();

                $opleiding = $request->opleidingen;
                $richting = $request->richtingen;
                $specialisaties = $request->specialisaties;
                // Draw a map
                Mapper::map(52.5, 5);

                $users = DB::table('users')
                    ->join('opleiding', 'users.id', '=', 'opleiding.user_id')
                    ->join('woonplaats', 'users.id', '=', 'woonplaats.user_id')
                    ->select('users.*', 'opleiding.*', 'woonplaats.*')
                    ->where([
                        ['opleiding.naam', $opleiding],
                        ['richting', $richting],
                        ['specialisatie', $specialisaties],
                    ])->where('users.deleted_at', '=', null)
                    ->get();

                foreach ($users as $c) {
                    $tel = $c->telefoonnummer;
                    $email = $c->email;
                    $adres = $c->naam;
                    $postcode = $c->postcode;
                    $voornaam = $c->voornaam;
                    $tussenvoegsel = $c->tussenvoegsel;
                    $achternaam = $c->achternaam;

                    $content =   'Alumni:' . ' ' . $voornaam . ' ' . $tussenvoegsel . ' ' . $achternaam . '<br>' . 'Tel:' . ' ' . $tel .  '<br>' . 'Email:' . ' ' . $email . '<br>' . 'Adres:' . ' ' . $adres . '<br>' . 'Postcode:' . ' ' . $postcode . '<br>';

                    Mapper::informationWindow($c->latitude, $c->longitude, $content, ['markers' => ['animation' => 'DROP']]);
                }

                return view('geochart', array('richtingen' => $richtingen));


            } else {


                $richtingen = dropdown_richting::all();


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
                        ['specialisatie', $specialisaties],
                    ])->where('users.deleted_at', '=', null)
                    ->get();

                foreach ($users as $c) {
                    $bedrijf = $c->naam;
                    $tel = $c->telefoonnummer;
                    $adres = $c->straatnaam;
                    $postcode = $c->postcode;
                    $voornaam = $c->voornaam;
                    $tussenvoegsel = $c->tussenvoegsel;
                    $achternaam = $c->achternaam;
                    $content = 'Bedrijf:' . '' . $bedrijf . '<br>' . 'Tel:' . '' . $tel . '<br>' . 'Adres:' . '' . $adres . '<br>' . 'Postcode:' . '' . $postcode . '<br>' . 'Alumni:' . '' . $voornaam . ' ' . $tussenvoegsel . ' ' . $achternaam;

                    Mapper::informationWindow($c->latitude, $c->longitude, $content, ['markers' => ['animation' => 'DROP']]);
                }


                return view('geochart', array('richtingen' => $richtingen));

            }

        }

    }
}