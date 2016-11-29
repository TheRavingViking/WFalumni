@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="/uploads/avatars/{{ $user->foto }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                        <h2>{{ $user->voornaam }} Profiel</h2>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('voornaam') ? ' has-error' : '' }}">
                                <label for="voornaam" class="col-md-4 control-label">Voornaam</label>

                                <div class="col-md-6">
                                    <input id="voornaam" type="text" class="form-control" name="voornaam" value="{{$user->voornaam}}">

                                    @if ($errors->has('voornaam'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('voornaam') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tussenvoegsel') ? ' has-error' : '' }}">
                                <label for="tussenvoegsel" class="col-md-4 control-label">Tussenvoegsel</label>

                                <div class="col-md-6">
                                    <input id="tussenvoegsel" type="text" class="form-control" name="tussenvoegsel" value="{{ $user->tussenvoegsel }}">

                                    @if ($errors->has('tussenvoegsel'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tussenvoegsel') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('achternaam') ? ' has-error' : '' }}">
                                <label for="achternaam" class="col-md-4 control-label">Achternaam</label>

                                <div class="col-md-6">
                                    <input id="achternaam" type="text" class="form-control" name="achternaam" value="{{ $user->achternaam }}">

                                    @if ($errors->has('achternaam'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('achternaam') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('geslacht') ? ' has-error' : '' }}">
                                <label for="geslacht" class="col-md-4 control-label">Geslacht
                                    <br>Man:<br><br>Vrouw:
                                </label>

                                <div class="col-md-6"><br>
                                    <input id="geslacht" type="radio" class="form-control" name="geslacht" value="man">
                                    <input id="geslacht" type="radio" class="form-control" name="geslacht" value="vrouw">

                                    @if ($errors->has('geslacht'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('geslacht') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('burgerlijke staat') ? ' has-error' : '' }}">
                                <label for="burgerlijke staat" class="col-md-4 control-label">Burgerlijke staat</label>

                                <div class="col-md-6">
                                    <input id="burgerlijke staat" type="text" class="form-control" name="burgerlijke staat" value="{{ $user->burgerlijke_staat }}">

                                    @if ($errors->has('burgerlijke staat'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('burgerlijke_staat') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('studentnummer') ? ' has-error' : '' }}">
                                <label for="studentnummer" class="col-md-4 control-label">Studentnummer</label>

                                <div class="col-md-6">
                                    <input id="studentnummer" type="text" class="form-control" name="studentnummer" value="{{ $user->studentnummer }}">

                                    @if ($errors->has('studentnummer'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('studentnummer') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('post adres') ? ' has-error' : '' }}">
                                <label for="post adres" class="col-md-4 control-label">Post adres</label>

                                <div class="col-md-6">
                                    <input id="post adres" type="text" class="form-control" name="post adres" value="{{ $user->post_adres }}">

                                    @if ($errors->has('post adres'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('post_adres') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('telefoonnummer') ? ' has-error' : '' }}">
                                <label for="telefoonnummer" class="col-md-4 control-label">Telefoonnummer</label>

                                <div class="col-md-6">
                                    <input id="telefoonnummer" type="text" class="form-control" name="telefoonnummer" value="{{ $user->telefoonnummer }}">

                                    @if ($errors->has('telefoonnummer'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('telefoonnummer') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('geboortedatum') ? ' has-error' : '' }}">
                                <label for="geboortedatum" class="col-md-4 control-label">Geboortedatum</label>

                                <div class="col-md-6">
                                    <input id="geboortedatum" type="date" class="form-control" name="geboortedatum" value="{{ $user->geboortedatum }}">

                                    @if ($errors->has('geboortedatum'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('geboortedatum') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('geboorteprovincie') ? ' has-error' : '' }}">
                                <label for="geboorteprovincie" class="col-md-4 control-label">geboorteprovincie</label>

                                <div class="col-md-6">
                                    <input id="geboorteprovincie" type="text" class="form-control" name="geboorteprovincie" value="{{ $user->geboorteprovincie }}">

                                    @if ($errors->has('geboorteprovincie'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('geboorteprovincie') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('geboorteplaats') ? ' has-error' : '' }}">
                                <label for="geboorteplaats" class="col-md-4 control-label">Geboorteplaats</label>

                                <div class="col-md-6">
                                    <input id="geboorteplaats" type="text" class="form-control" name="geboorteplaats" value="{{ $user->geboorteplaats }}">

                                    @if ($errors->has('geboorteplaats'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('geboorteplaats') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('titel') ? ' has-error' : '' }}">
                                <label for="titel" class="col-md-4 control-label">Titel</label>

                                <div class="col-md-6">
                                    <input id="titel" type="text" class="form-control" name="titel" value="{{ $user->titel }}">

                                    @if ($errors->has('titel'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('titel') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nationaliteit') ? ' has-error' : '' }}">
                                <label for="nationaliteit" class="col-md-4 control-label">Nationaliteit</label>

                                <div class="col-md-6">
                                    <input id="nationaliteit" type="text" class="form-control" name="nationaliteit" value="{{ $user->nationaliteit }}">

                                    @if ($errors->has('nationaliteit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nationaliteit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Wijzig
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection