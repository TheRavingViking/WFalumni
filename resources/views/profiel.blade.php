@extends('layouts.app')

@section('content')
    @php
        if ( $user->id == Auth::user()->id || Auth::user()->bevoegdheid == 3)
            {
                $temp = '';
            } else
            {
                $temp = 'disabled';
            }
        if ( $user->id == Auth::user()->id || Auth::user()->bevoegdheid == 3 || Auth::user()->bevoegdheid == 2) {
            $visibility = '';
            //uglyFix is om layout te fixen.
            $uglyFix = 1;
         } else {
            $visibility = 'display: none;';
            $uglyFix = 0;
        }
    @endphp

    <div class="container">
        @foreach ($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

    </div>

    {{--//persoonlijke gegevens form--}}
    <div id="profielcon" class="container">
        <div class="panel panel-default" style="padding: 1em">

            <a href="#Profielcollapse" class="btn btn-info" data-toggle="collapse">Profiel</a>
            <div id="Profielcollapse" class="collapse in">
                {{--<div class=" row"></div>--}}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1">
                        <img src="/uploads/avatars/{{ $user->foto }}" class="img-responsive"
                             style="border-radius:50%;">
                        {{--opleiding form & modal--}}
                        <h2>{{ $user->voornaam }} {{ $user->tussenvoegsel }} {{ $user->achternaam }}</h2>
                    </div>

                    <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="/profiel"
                          id="profielform">

                        {{ csrf_field() }}

                        <input type="hidden" name="id" id="id" value="{{$user->id}}">

                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-sm-offset-7">
                            <label style="{{$visibility}}">Update profiel foto</label>
                            <input type="file" name="avatar" {{$temp}} style="{{$visibility}}"></div>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1">
                            <label for="voornaam">Voornaam</label>
                            <input id="voornaam" type="text" class="form-control" name="voornaam"
                                   value="{{$user->voornaam}}" {{$temp}}>

                            <label for="tussenvoegsel">Tussenvoegsel</label>
                            <input id="tussenvoegsel" type="text" class="form-control" name="tussenvoegsel"
                                   value="{{ $user->tussenvoegsel }}" {{$temp}}>

                            <label for="achternaam">Achternaam</label>
                            <input id="achternaam" type="text" class="form-control" name="achternaam"
                                   value="{{ $user->achternaam }}" {{$temp}}>

                            <label for="email">E-mailadres</label>
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ $user->email }}" {{$temp}}>

                            <label for="studentnummer" style="{{$visibility}}">Studentnummer</label>
                            <input id="studentnummer" type="number" class="form-control" name="studentnummer"
                                   value="{{ $user->studentnummer }}" style="{{$visibility}}" {{$temp}} >

                            <label for="telefoonnummer" style="{{$visibility}}">Telefoonnummer</label>
                            <input id="telefoonnummer" type="text" class="form-control" name="telefoonnummer"
                                   value="{{ $user->telefoonnummer }}" style="{{$visibility}}" {{$temp}}>

                            <label for="facebook">Facebook</label>
                            <input id="facebook" type="text" class="form-control" name="facebook"
                                   value="{{ $user->facebook }}" {{$temp}}>

                            <label for="linkedin">Linkedin</label>
                            <input id="linkedin" type="text" class="form-control" name="linkedin"
                                   value="{{ $user->linkedin }}" {{$temp}}>

                            <label for="twitter">Twitter</label>
                            <input id="twitter" type="text" class="form-control" name="twitter"
                                   value="{{ $user->twitter }}" {{$temp}}>

                            <label for="website">Website</label>
                            <input id="website" type="text" class="form-control" name="website"
                                   value="{{ $user->website }}" {{$temp}}>

                            <label for="post adres" style="{{$visibility}}">Postadres</label>
                            <input id="post adres" type="text" class="form-control" name="post adres"
                                   value="{{ $user->post_adres }}" style="{{$visibility}}" {{$temp}}>

                            <label for="password" style="{{$visibility}}">Wachtwoord</label>
                            <input id="password" type="password" class="form-control" name="password"
                                   style="{{$visibility}}" {{$temp}}>

                            <label for="password-confirm" style="{{$visibility}}">Bevestig wachtwoord</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" style="{{$visibility}}" {{$temp}}>

                            <label for="geslacht">Geslacht
                                <br>Man:&nbsp&nbsp&nbsp
                                @if($user->geslacht == 'man' || $user->geslacht == 'Man' ) <input id="geslacht"
                                                                                                  name="geslacht"
                                                                                                  type="radio"
                                                                                                  value="Man"
                                                                                                  checked {{$temp}}>
                                @else <input id="geslacht" name="geslacht" type="radio" value="Man" {{$temp}}>
                                @endif
                                <br>Vrouw:
                                @if($user->geslacht == 'vrouw' || $user->geslacht == 'Vrouw') <input id="geslacht"
                                                                                                     name="geslacht"
                                                                                                     type="radio"
                                                                                                     value="Vrouw"
                                                                                                     checked {{$temp}}>
                                @else <input id="geslacht" name="geslacht" type="radio" value="Vrouw" {{$temp}}>
                                @endif
                            </label>

                            <br><label for="burgerlijke staat" title="burgelijke staat" style="{{$visibility}}">Burgerlijke
                                staat</label>
                            <select name="burgerlijke staat" title="burgelijke staat" {{$temp}} class="form-control"
                                    style="{{$visibility}}">
                                <option value="ongehuwd">Ongehuwd</option>
                                <option value="gehuwd">Gehuwd</option>
                            </select>

                            <label for="heeft_kinderen" style="{{$visibility}}">Heeft kinderen
                                <br>Ja:&nbsp&nbsp
                                <input id="heeft_kinderen" name="heeft_kinderen" type="radio" value="1"
                                       @if($user->heeft_kinderen == 1) checked @endif>
                                <br>Nee: <input id="heeft_kinderen" name="heeft_kinderen" type="radio" value="0"
                                                @if($user->heeft_kinderen == 0) checked @endif>
                            </label>

                            @if($uglyFix == 1) <br> @endif

                            <label for="nationaliteit" style="{{$visibility}}">Nationaliteit</label>
                            <input id="nationaliteit" type="text" class="form-control" name="nationaliteit"
                                   value="{{ $user->nationaliteit }}" {{$temp}} style="{{$visibility}}">

                            <label for="geboortedatum" style="{{$visibility}}">Geboortedatum</label>
                            <input id="geboortedatum" type="date" class="form-control" name="geboortedatum"
                                   value="{{ $user->geboortedatum }}" {{$temp}} style="{{$visibility}}">

                            <label for="geboorteplaats" style="{{$visibility}}">Geboorteplaats</label>
                            <input id="geboorteplaats" type="text" class="form-control" name="geboorteplaats"
                                   value="{{ $user->geboorteplaats }}" {{$temp}} style="{{$visibility}}">

                            <label for="geboorteprovincie" style="{{$visibility}}">Geboorteprovincie</label>
                            <input id="geboorteprovincie" type="text" class="form-control" name="geboorteprovincie"
                                   value="{{ $user->geboorteprovincie }}" {{$temp}} style="{{$visibility}}">

                            <label for="geboorteland" style="{{$visibility}}">Geboorteland</label>
                            <input id="geboorteland" type="text" class="form-control" name="geboorteland"
                                   value="{{ $user->geboorteland }}" {{$temp}} style="{{$visibility}}">


                            <label for="titel" style="{{$visibility}}">Titel</label>
                            <input id="titel" type="text" class="form-control" name="titel"
                                   value="{{ $user->titel }}" {{$temp}} style="{{$visibility}}">

                            <label for="jaarinkomen" style="{{$visibility}}">Jaarinkomen</label>
                            <input id="jaarinkomen" type="text" class="form-control" name="jaarinkomen"
                                   value="{{ $user->jaarinkomen }}" {{$temp}} style="{{$visibility}}">

                            <label for="geenmailverzenden" style="{{$visibility}}">Wenst email te ontvangen:
                                <br>Ja, graag&nbsp&nbsp&nbsp&nbsp&nbsp

                                @if($user->geenmailverzenden == 1) <input id="geenmailverzenden"
                                                                          name="geenmailverzenden" type="radio"
                                                                          value="1" checked {{$temp}}><br>
                                @else <input id="geenmailverzenden" name="geenmailverzenden" type="radio"
                                             value="1" {{$temp}}><br>
                                @endif

                                Nee, dank je
                                @if($user->geenmailverzenden == 0) <input id="geenmailverzenden"
                                                                          name="geenmailverzenden" type="radio"
                                                                          value="0" checked {{$temp}}>
                                @else <input id="geenmailverzenden" name="geenmailverzenden" type="radio"
                                             value="0" {{$temp}}>
                                @endif
                            </label>

                            @if( Auth::user()->bevoegdheid == 3 )

                                @if($uglyFix == 1) <br> @endif

                                <label for="bevoegdheid" style="{{$visibility}}">Bevoegdheid</label>
                                <input id="bevoegdheid" type="text" class="form-control" name="bevoegdheid"
                                       value="
                                            @if ($user->bevoegdheid == 3)Admin
                                            @elseif ($user->bevoegdheid == 2)Docent
                                            @elseif($user->bevoegdheid == 3)Alumnus
                                            @endif " disabled {{$temp}}>
                                        @endif

                            <label for="afdeling">Afdeling</label>
                            <input id="afdeling" type="text" class="form-control" name="afdeling"
                                   value="{{ $user->afdeling }}" {{$temp}}>

                            <br>
                            <button type="submit" class="btn btn-primary" {{$temp}} style="{{$visibility}}">
                                Wijzig
                            </button><hr>
                        </div>

                    </form>

                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1" style="padding: 1em;">
                        <form action="/profiel/delete" method="POST">
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger" {{$temp}}  style="{{$visibility}}">
                                    Delete User
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{--Woonplaats form & modal--}}
    <div class="container" style="{{$visibility}}">
        <div class="panel panel-default" style="padding: 1em">
            <a href="#woonplaatscollapse" class="btn btn-info" data-toggle="collapse">Woonplaats</a>
            <div id="woonplaatscollapse" class="collapse">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1">

                        <h1>Woonplaats</h1>

                        @foreach($user->woonplaats as $woonplaats)
                            <form class="form-horizontal" method="POST"
                                  action="/profiel/woonplaats/delete">


                                <h4>{{ $woonplaats->naam }}</h4>
                                <input id="naam" type="text" class="form-control" name="naam"
                                       value="{{ $woonplaats->naam }}" disabled> <br>
                                <input id="functie" type="text" class="form-control" name="functie"
                                       value="{{ $woonplaats->provincie }}" disabled> <br>
                                <input id="richting" type="text" class="form-control" name="richting"
                                       value="{{ $woonplaats->land }}" disabled> <br>
                                <input id="begin" type="text" class="form-control" name="begin"
                                       value="{{ $woonplaats->begin }}" disabled> <br>
                                <input id="eind" type="text" class="form-control" name="eind"
                                       value="{{ $woonplaats->eind }}" disabled> <br>

                                <input id="id" type="hidden" name="id" value="{{ $woonplaats->id }}">
                                <input id="id" type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger" {{$temp}}>Delete Woonplaats</button>

                                <hr>
                            </form>


                        @endforeach
                        <div>
                            <!-- Trigger/Open The Modal -->
                            <button type="button" class="btn btn-info btn-md" data-toggle="modal"
                                    data-target="#woonModal" {{$temp}} >
                                Voeg Woonplaats toe
                            </button>

                            <!-- The Modal -->
                            <div id="woonModal" class="modal fade">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4>Vul de woonplaats</h4>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

                                        <div class="modal-body">
                                            <form method="POST" action="{{ url('profiel/woonplaats') }}"
                                                  class="form-horizontal">
                                                {!! csrf_field() !!}

                                                <div class="form-group">
                                                    <label for="naam">Straatnaam</label>
                                                    <input class="form-control" id="straatnaam" type="text"
                                                           name="straatnaam" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="naam">Postcode</label>
                                                    <input class="form-control" id="postcode" type="text"
                                                           name="postcode" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="begin">Begin</label>
                                                    <input class="form-control" id="begin" type="date" name="begin"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="eind">Eind</label>
                                                    <input class="form-control" id="eind" type="date" name="eind">
                                                </div>

                                                <div class="form-group">
                                                    <label for="provincie">Provincie</label>
                                                    <input class="form-control" id="provincie" type="text"
                                                           name="provincie">
                                                </div>

                                                <div class="form-group">
                                                    <label for="land">Land</label>
                                                    <input class="form-control" id="land" type="text" name="land"
                                                           required>
                                                </div>


                                                <input id="user_id" type="hidden" name="user_id" value="{{$user->id}}">

                                                <button type="submit" class="btn btn-info">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--opleiding form & modal--}}
    <div class="container" style="{{$visibility}}">
        <div class="panel panel-default" style="padding: 1em">
            <a href="#opleidingcollapse" class="btn btn-info" data-toggle="collapse">Opleidingen</a>
            <div id="opleidingcollapse" class="collapse">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1">

                        <h1>Opleidingen</h1>

                        <br>

                        @foreach($user->opleiding as $opl)
                            <form class="form-horizontal" method="POST"
                                  action="/profiel/opleiding/delete">

                                <h4>{{ $opl->naam }}</h4>
                                <input id="naam" type="text" class="form-control" name="naam"
                                       value="{{ $opl->naam }}" disabled> <br>
                                <input id="functie" type="text" class="form-control" name="functie"
                                       value="{{ $opl->instituut }}" disabled> <br>
                                <input id="functie" type="text" class="form-control" name="functie"
                                       value="{{ $opl->richting }}" disabled> <br>
                                <input id="begin" type="text" class="form-control" name="begin"
                                       value="{{ $opl->begin }}" disabled> <br>
                                <input id="eind" type="text" class="form-control" name="eind"
                                       value="{{ $opl->eind }}" disabled> <br>
                                <input id="adres" type="text" class="form-control" name="adres"
                                       value="{{ $opl->locatie }}" disabled> <br>
                                <input id="tel" type="text" class="form-control" name="tel"
                                       value="{{ $opl->behaald }}" disabled><br>

                                <input id="id" type="hidden" name="id" value="{{ $opl->id }}">
                                <input id="id" type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger" {{$temp}}>Delete Opleiding</button>

                                <hr>
                            </form>


                        @endforeach
                        <div>
                            <!-- Trigger/Open The Modal -->
                            <button type="button" class="btn btn-info btn-md" data-toggle="modal"
                                    data-target="#oplModal" {{$temp}}>
                                Voeg opleiding toe
                            </button>

                            <!-- The Modal -->
                            <div id="oplModal" class="modal fade">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4>Vul de opleidings informatie in</h4>
                                    </div>

                                    <div class="modal-body">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                                            <form method="POST" action="{{ url('profiel/opleiding') }}"
                                                  class="form-horizontal">
                                                {!! csrf_field() !!}

                                                <div class="form-group">
                                                    <label for="naam">Naam van de opleiding</label>
                                                    <input class="form-control" id="naam" type="text" name="naam"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="instituut">Naam van het instituut</label>
                                                    <input class="form-control" id="instituut" type="text"
                                                           name="instituut" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="richting" title="richting">Naam van de richting</label>
                                                    <select class="form-control" name="richting" title="richting"
                                                            required>
                                                        @foreach($richtingen as $richting)
                                                            <option value="{{ $richting->naam }}">{{ $richting->naam }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="begin">Begin van de opleiding</label>
                                                    <input class="form-control" id="begin" type="date" name="begin"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="eind">Einde van de opleiding</label>
                                                    <input class="form-control" id="eind" type="date" name="eind">
                                                </div>

                                                <div class="form-group">
                                                    <label for="locatie">Locatie van het instituut</label>
                                                    <input class="form-control" id="locatie" type="text" name="locatie"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="niveau">Niveau van de opleiding</label>
                                                    <input class="form-control" id="niveau" type="text" name="niveau"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="behaald">Opleiding behaald</label>
                                                    <input id="behaald" name="behaald" type="radio" value="1" required>ja
                                                    <input id="behaald" name="behaald" type="radio" value="0">nee
                                                </div>

                                                <div class="form-group">
                                                    <label for="land">Land van het instituut</label>
                                                    <input class="form-control" id="land" type="text" name="land"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="provincie">Provincie van het instituut</label>
                                                    <input class="form-control" id="provincie" type="text"
                                                           name="provincie">
                                                </div>

                                                <input id="user_id" type="hidden" name="user_id" value="{{$user->id}}">

                                                <button type="submit" class="btn btn-info">Submit</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--bedrijf form & modal--}}
    <div class="container" style="{{$visibility}}">
        <div class="panel panel-default" style="padding: 1em">
            <a href="#bedrijfcollapse" class="btn btn-info" data-toggle="collapse">Bedrijven</a>
            <div id="bedrijfcollapse" class="collapse">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1">
                        <h1>Werkplekken</h1>

                        <br>

                        @foreach($user->bedrijf as $bedrijf)
                            <form class="form-horizontal" method="POST"
                                  action="/profiel/bedrijf/delete">

                                <h4>{{ $bedrijf->naam }}</h4>
                                <input id="naam" type="text" class="form-control" name="naam"
                                       value="{{ $bedrijf->naam }}" disabled> <br>
                                <input id="functie" type="text" class="form-control" name="functie"
                                       value="{{ $bedrijf->functie }}" disabled> <br>
                                <input id="begin" type="text" class="form-control" name="begin"
                                       value="{{ $bedrijf->begin }}" disabled> <br>
                                <input id="eind" type="text" class="form-control" name="eind"
                                       value="{{ $bedrijf->eind }}" disabled> <br>
                                <input id="adres" type="text" class="form-control" name="adres"
                                       value="{{ $bedrijf->bezoekadres }}" disabled> <br>
                                <input id="tel" type="text" class="form-control" name="tel"
                                       value="{{ $bedrijf->telefoonnummer }}" disabled><br>

                                <input id="id" type="hidden" name="id" value="{{ $bedrijf->id }}">
                                <input id="id" type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger" {{$temp}}>Delete bedrijf</button>

                                <hr>
                            </form>


                        @endforeach
                        {{--modal--}}
                        <div>
                            <!-- Trigger/Open The Modal -->
                            <button type="button" class="btn btn-info btn-md" data-toggle="modal"
                                    data-target="#bedModal" {{$temp}}>
                                Voeg werkplek toe
                            </button>

                            <!-- The Modal -->
                            <div id="bedModal" class="modal fade">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Vul het bedrijf in</h4>

                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

                                        <div class="modal-body">

                                            <form method="POST" action="{{ url('profiel/bedrijf') }}"
                                                  class="form-horizontal">
                                                {!! csrf_field() !!}

                                                <div class="form-group">
                                                    <label for="functie">functie</label>
                                                    <input class="form-control" id="functie" type="text" name="functie" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="richting" title="richting">Naam van de
                                                        richting</label>
                                                    <select class="form-control" name="richting" title="richting" required>
                                                        @foreach($richtingen as $richting)
                                                            <option value="{{ $richting->naam }}">{{ $richting->naam }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="naam">naam</label>
                                                    <input class="form-control" id="naam" type="text" name="naam" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="stad">Stad</label>
                                                    <input class="form-control" id="stad" type="text" name="stad" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="adres">adres</label>
                                                    <input class="form-control" id="adres" type="text" name="adres" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="postcode">postcode</label>
                                                    <input class="form-control" id="postcode" type="text" name="postcode" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="begin">begin</label>
                                                    <input class="form-control" id="begin" type="date" name="begin" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="eind">eind</label>
                                                    <input class="form-control" id="eind" type="date" name="eind">
                                                </div>

                                                <div class="form-group">
                                                    <label for="telefoonnummer">telefoonnummer</label>
                                                    <input class="form-control" id="telefoonnummer" type="text" name="telefoonnummer">
                                                </div>

                                                <div class="form-group">
                                                    <label for="bezoekadres">bezoekadres</label>
                                                    <input class="form-control" id="bezoekadres" type="text" name="bezoekadres">
                                                </div>

                                                <div class="form-group">
                                                    <label for="land">land</label>
                                                    <input class="form-control" id="land" type="text" name="land" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="provincie">provincie</label>
                                                    <input class="form-control" id="provincie" type="text" name="provincie">
                                                </div>

                                                <input class="form-control" id="user_id" type="hidden" name="user_id"
                                                       value="{{$user->id}}">

                                                <button type="submit" class="btn btn-info">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection


