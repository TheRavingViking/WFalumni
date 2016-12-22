@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="">
                            {{ csrf_field() }}
                            <div>
                                <input title="deleted_at" id="deleted_at" name="deleted_at" value="null" hidden>
                            </div>

                            <div class="form-group">
                                <label for="voornaam" class="col-md-4 control-label">Voornaam</label>

                                <div class="col-md-6">
                                    <input id="voornaam" type="text" class="form-control" name="voornaam" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tussenvoegsel" class="col-md-4 control-label">Tussenvoegsel</label>

                                <div class="col-md-6">
                                    <input id="tussenvoegsel" type="text" class="form-control" name="tussenvoegsel">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="achternaam" class="col-md-4 control-label">Achternaam</label>

                                <div class="col-md-6">
                                    <input id="achternaam" type="text" class="form-control" name="achternaam" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required>
                                </div>
                            </div>

                            {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                            {{--@if ($errors->has('password'))--}}
                            {{--<span class="help-block">--}}
                            {{--<strong>{{ $errors->first('password') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                            {{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <label for="geslacht" class="col-md-4 control-label">Geslacht
                                    <br>Man:<br>Vrouw:
                                </label>

                                <div class="col-md-6"><br>
                                    <input id="geslacht" type="radio" name="geslacht" value="man" required><br>
                                    <input id="geslacht" type="radio" name="geslacht" value="vrouw" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="studentnummer" class="col-md-4 control-label">Studentnummer</label>
                                <div class="col-md-6">
                                    <input id="studentnummer" type="number" class="form-control" name="studentnummer" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="post_adres" class="col-md-4 control-label">Postadres</label>
                                <div class="col-md-6">
                                    <input id="post_adres" type="text" class="form-control" name="post_adres" value="{{ old('post_adres') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="telefoonnummer" class="col-md-4 control-label">Telefoonnummer</label>
                                <div class="col-md-6">
                                    <input id="telefoonnummer" type="text" class="form-control" name="telefoonnummer" value="{{ old('telefoonnummer') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="geboortedatum" class="col-md-4 control-label">Geboortedatum</label>
                                <div class="col-md-6">
                                    <input id="geboortedatum" type="date" class="form-control" name="geboortedatum" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="geboorteplaats" class="col-md-4 control-label">Geboorteplaats</label>
                                <div class="col-md-6">
                                    <input id="geboorteplaats" type="text" class="form-control" name="geboorteplaats" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="geboorteprovincie" class="col-md-4 control-label">Geboorteprovincie</label>
                                <div class="col-md-6">
                                    <input id="geboorteprovincie" type="text" class="form-control" name="geboorteprovincie" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="geboorteland" class="col-md-4 control-label">Geboorteland</label>
                                <div class="col-md-6">
                                    <input id="geboorteland" type="text" class="form-control" name="geboorteland" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nationaliteit" class="col-md-4 control-label">Nationaliteit</label>
                                <div class="col-md-6">
                                    <input id="nationaliteit" type="text" class="form-control" name="nationaliteit" required>
                                </div>
                            </div>

                            <h1>Opleiding</h1>

                            <div class="form-group">
                                <label for="opleidingsnaam" class="col-md-4 control-label">Opleidingsnaam</label>
                                <div class="col-md-6">
                                    <select name="opleidingen" id="opleidingen" class="form-control">
                                        @foreach($opleidingen as $opleiding)
                                            <option value="{{ $opleiding->naam }}">
                                                {{ $opleiding->naam }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="richting" class="col-md-4 control-label">Opleidingsrichting</label>
                                <div class="col-md-6">
                                    <select name="richtingen" id="richtingen" class="form-control">
                                        @foreach($richtingen as $richting)
                                            <option value="{{ $richting->naam }}">
                                                {{ $richting->naam }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="opleidingsinstituut" class="col-md-4 control-label">Opleidingsinstituut</label>
                                <div class="col-md-6">
                                    <input id="opleidingsinstituut" type="text" class="form-control" name="opleidingsinstituut" value="Windesheim Flevoland" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="begin" class="col-md-4 control-label">Begindatum</label>
                                <div class="col-md-6">
                                    <input id="begin" type="date" class="form-control" name="begin" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="eind" class="col-md-4 control-label">Einddatum</label>
                                <div class="col-md-6">
                                    <input id="eind" type="date" class="form-control" name="eind" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="locatie" class="col-md-4 control-label">Locatie</label>
                                <div class="col-md-6">
                                    <input id="locatie" type="text" class="form-control" name="locatie" value="Almere" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="niveau" class="col-md-4 control-label">Niveau</label>
                                <div class="col-md-6">
                                    <select name="niveau" id="niveau" class="form-control">
                                        <option value="AD">AD</option>
                                        <option value="Bachelor" selected>Bachelor</option>
                                        <option value="Master">Master</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="opleidingsprovincie" class="col-md-4 control-label">Opleidingsprovincie</label>
                                <div class="col-md-6">
                                    <input id="opleidingsprovincie" type="text" class="form-control" name="opleidingsprovincie" value="Flevoland" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="opleidingsland" class="col-md-4 control-label">Opleidingsland</label>
                                <div class="col-md-6">
                                    <input id="opleidingsland" type="text" class="form-control" name="opleidingsland" value="Nederland" required>
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
