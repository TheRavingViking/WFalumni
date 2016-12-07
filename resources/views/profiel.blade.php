@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default" style="padding: 1em">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <img src="/uploads/avatars/{{ $user->foto }}" class="img-responsive" style="min-width: 100px; float:left; border-radius:50%; margin-right:25px;">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2>{{ $user->voornaam }} {{ $user->tussenvoegsel }} {{ $user->achternaam }}</h2>
                    </div>

                    <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="/profiel" id="profielform">
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ csrf_field() }}

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                            <label>Update profiel foto</label>
                            <input type="file" name="avatar">

                            <label for="voornaam">Voornaam</label>
                            <input id="voornaam" type="text" class="form-control" name="voornaam" value="{{$user->voornaam}}">

                            <label for="tussenvoegsel">Tussenvoegsel</label>
                            <input id="tussenvoegsel" type="text" class="form-control" name="tussenvoegsel" value="{{ $user->tussenvoegsel }}">

                            <label for="achternaam">Achternaam</label>
                            <input id="achternaam" type="text" class="form-control" name="achternaam" value="{{ $user->achternaam }}">

                            <label for="email">E-Mail Address</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">

                            <label for="studentnummer">Studentnummer</label>
                            <input id="studentnummer" type="text" class="form-control" name="studentnummer" value="{{ $user->studentnummer }}">

                            @foreach($user->woonplaats as $woonplaats)
                                <label for="woonplaats">Woonplaats</label>
                                <input id="woonplaats" type="text" class="form-control" name="woonplaats" value="{{ $user->naam }}" disabled>

                            @endforeach

                            <label for="post adres">Post adres</label>
                            <input id="post adres" type="text" class="form-control" name="post adres" value="{{ $user->post_adres }}">

                            <label for="telefoonnummer">Telefoonnummer</label>
                            <input id="telefoonnummer" type="text" class="form-control" name="telefoonnummer" value="{{ $user->telefoonnummer }}">

                            <label for="facebook">facebook</label>
                            <input id="facebook" type="text" class="form-control" name="facebook" value="{{ $user->facebook }}">

                            <label for="linkedin">linkedin</label>
                            <input id="linkedin" type="text" class="form-control" name="linkedin" value="{{ $user->linkedin }}">

                            <label for="twitter">twitter</label>
                            <input id="twitter" type="text" class="form-control" name="twitter" value="{{ $user->twitter }}">

                            <label for="website">website</label>
                            <input id="website" type="text" class="form-control" name="website" value="{{ $user->website }}">

                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password">

                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                            <label for="geslacht">Geslacht
                                <br>Man:&nbsp&nbsp&nbsp
                                @if($user->geslacht == 'man') <input id="geslacht" name="geslacht" type="radio" value="man" checked>
                                @else <input id="geslacht" name="geslacht" type="radio" value="man">
                                @endif
                                <br>Vrouw:
                                @if($user->geslacht == 'vrouw') <input id="geslacht" name="geslacht" type="radio" value="vrouw" checked>
                                @else <input id="geslacht" name="geslacht" type="radio" value="vrouw">
                                @endif
                            </label>

                            <br><label for="burgerlijke staat" title="burgelijke staat">Burgerlijke staat</label>
                            <select name="burgerlijke staat" title="burgelijke staat">
                                <option value="ongehuwd">ongehuwd</option>
                                <option value="gehuwd">gehuwd</option>
                            </select><br>

                            <label for="heeft_kinderen">heeft_kinderen</label>
                            <input id="heeft_kinderen" type="text" class="form-control" name="heeft_kinderen" value="{{ $user->heeft_kinderen }}">

                            <label for="nationaliteit">Nationaliteit</label>
                            <input id="nationaliteit" type="text" class="form-control" name="nationaliteit" value="{{ $user->nationaliteit }}">

                            <label for="geboortedatum">Geboortedatum</label>
                            <input id="geboortedatum" type="date" class="form-control" name="geboortedatum" value="{{ $user->geboortedatum }}">

                            <label for="geboorteplaats">Geboorteplaats</label>
                            <input id="geboorteplaats" type="text" class="form-control" name="geboorteplaats" value="{{ $user->geboorteplaats }}">

                            <label for="geboorteprovincie">geboorteprovincie</label>
                            <input id="geboorteprovincie" type="text" class="form-control" name="geboorteprovincie" value="{{ $user->geboorteprovincie }}">

                            <label for="geboorteland">geboorteland</label>
                            <input id="geboorteland" type="text" class="form-control" name="geboorteland" value="{{ $user->geboorteland }}">

                            @foreach($user->opleiding as $opl)

                                <label for="naam">opleiding</label>
                                <input id="naam" type="text" class="form-control" name="naam" value="{{ $opl->naam }}" disabled>

                            @endforeach

                            <label for="opleiding">voeg een opleiding toe</label>

                            <div>
                                <!-- Trigger/Open The Modal -->
                                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Open Modal</button>

                                <!-- The Modal -->
                                <div id="myModal" class="modal fade">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Vul de opleidings informatie in</h4>
                                        </div>
                                        <div class="modal-body">
                                            <label for="naam">Naam van de opleiding</label>
                                            <input id="naam" type="text" name="naam">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default" data-dismiss="modal">Submit</button>
                                        </div>
                                    </div>
                                </div>


                            </div><br><br>

                            <label for="titel">Titel</label>
                            <input id="titel" type="text" class="form-control" name="titel" value="{{ $user->titel }}">

                            @foreach($user->bedrijf as $bedrijf)

                                <label for="naam">Werkplaats</label>
                                <input id="naam" type="text" class="form-control" name="naam" value="{{ $bedrijf->naam }}" disabled>

                            @endforeach

                            <label for="werkplaats">voeg een werkplaats toe</label>

                            <div>
                                <!-- Trigger/Open The Modal -->
                                <button id="werkBut" class="btn btn-info btn-md" type="button">Voeg toe</button>

                            </div><br><br>

                            <label for="jaarinkomen">jaarinkomen</label>
                            <input id="jaarinkomen" type="text" class="form-control" name="jaarinkomen" value="{{ $user->jaarinkomen }}">

                            <label for="geenmailverzenden">Wenst email te ontvangen:
                                <br>Ja, graag&nbsp&nbsp&nbsp&nbsp&nbsp

                                @if($user->geenmailverzenden == 1) <input id="geenmailverzenden" name="geenmailverzenden" type="radio" value="1" checked><br>
                                @else <input id="geenmailverzenden" name="geenmailverzenden" type="radio" value="1"><br>
                                @endif

                                Nee, dank je
                                @if($user->geenmailverzenden == 0) <input id="geenmailverzenden" name="geenmailverzenden" type="radio" value="0" checked>
                                @else <input id="geenmailverzenden" name="geenmailverzenden" type="radio" value="0">
                                @endif
                            </label>

                            <br><button type="submit" class="btn btn-primary">
                                Wijzig
                            </button>
                        </div>

                    </form>
                </div>
                </form>
                <form action="/profiel/delete" method="POST">
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-danger">
                                Delete User
                            </button>
                        </div>
                    </div>
                </div>
        </div></form>
            </div>
@endsection


