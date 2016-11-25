@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('voornaam') ? ' has-error' : '' }}">
                            <label for="voornaam" class="col-md-4 control-label">Voornaam</label>

                            <div class="col-md-6">
                                <input id="voornaam" type="text" class="form-control" name="voornaam" value="{{ old('voornaam') }}" required autofocus>

                                @if ($errors->has('voornaam'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('voornaam') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('achternaam') ? ' has-error' : '' }}">
                            <label for="achternaam" class="col-md-4 control-label">Achternaam</label>

                            <div class="col-md-6">
                                <input id="achternaam" type="text" class="form-control" name="achternaam" value="{{ old('achternaam') }}" required>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                                <input id="password" type="password" class="form-control" name="password" required>

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('geslacht') ? ' has-error' : '' }}">
                            <label for="geslacht" class="col-md-4 control-label">Geslacht</label>

                            <div class="col-md-6">
                                <input id="geslacht" type="radio" class="form-control" name="geslacht" value="man" required>Man
                                <input id="geslacht" type="radio" class="form-control" name="geslacht" value="vrouw" required>Vrouw

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
                                <input id="burgerlijke staat" type="text" class="form-control" name="burgerlijke staat" value="{{ old('burgerlijke staat') }}" required>

                                @if ($errors->has('burgerlijke staat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('burgerlijke staat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('studentnummer') ? ' has-error' : '' }}">
                            <label for="studentnummer" class="col-md-4 control-label">Studentnummer</label>

                            <div class="col-md-6">
                                <input id="studentnummer" type="text" class="form-control" name="studentnummer" value="{{ old('studentnummer') }}" required>

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
                                <input id="post adres" type="text" class="form-control" name="post adres" value="{{ old('post adres') }}" required>

                                @if ($errors->has('post adres'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('post adres') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telefoonnummer') ? ' has-error' : '' }}">
                            <label for="telefoonnummer" class="col-md-4 control-label">Telefoonnummer</label>

                            <div class="col-md-6">
                                <input id="telefoonnummer" type="text" class="form-control" name="telefoonnummer" value="{{ old('telefoonnummer') }}" required>

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
                                <input id="geboortedatum" type="date" class="form-control" name="geboortedatum" value="{{ old('geboortedatum') }}" required>

                                @if ($errors->has('geboortedatum'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('geboortedatum') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('geboorteplaats') ? ' has-error' : '' }}">
                            <label for="geboorteplaats" class="col-md-4 control-label">Geboorteplaats</label>

                            <div class="col-md-6">
                                <input id="geboorteplaats" type="text" class="form-control" name="geboorteplaats" value="{{ old('geboorteplaats') }}" required>

                                @if ($errors->has('geboorteplaats'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('geboorteplaats') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nationaliteit') ? ' has-error' : '' }}">
                            <label for="nationaliteit" class="col-md-4 control-label">Nationaliteit</label>

                            <div class="col-md-6">
                                <input id="nationaliteit" type="text" class="form-control" name="nationaliteit" value="{{ old('nationaliteit') }}" required>

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
