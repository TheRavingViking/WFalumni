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
                        <h2>{{ $user->voornaam }} {{ $user->achternaam }} Profiel</h2>
                    </div>
                <div>
                    <br><br><br><br><br><br><br>
                    <h4>geslacht</h4><h5>{{ $user->geslacht }}</h5><br>
                    <h4>email</h4><h5>{{ $user->email }}</h5><br>
                    <h4>nationaliteit</h4><h5>{{ $user->nationaliteit }}</h5><br>
                    <h4>geboorteland</h4><h5>{{ $user->geboorteland }}</h5><br>
                    <h4>geboorteprovincie</h4><h5>{{ $user->geboorteprovincie }}</h5><br>
                    <h4>geboorteplaats</h4><h5>{{ $user->geboorteplaats }}</h5><br>
                    <h4>geboortedatum</h4><h5>{{ $user->geboortedatum }}</h5><br>
                    <h4>titel</h4><h5>{{ $user->titel }}</h5><br>
                    <h4>burgerlijke_staat</h4><h5>{{ $user->burgerlijke_staat }}</h5><br>
                    <h4>heeft_kinderen</h4><h5>{{ $user->heeft_kinderen }}</h5><br>
                    <h4>jaarinkomen</h4><h5>{{ $user->jaarinkomen }}</h5><br>
                    <h4>post_adres</h4><h5>{{ $user->post_adres }}</h5><br>
                    <h4>studentnummer</h4><h5>{{ $user->studentnummer }}</h5><br>
                    <h4>telefoonnummer</h4><h5>{{ $user->telefoonnummer }}</h5><br>
                    <h4>facebook</h4><h5>{{ $user->facebook }}</h5><br>
                    <h4>linkedin</h4><h5>{{ $user->linkedin }}</h5><br>
                    <h4>twitter</h4><h5>{{ $user->twitter }}</h5><br>
                    <h4>website</h4><h5>{{ $user->website }}</h5><br>

                </div>

                    </div>
                </div>
            </div>
        <a class="btn btn-primary" href="editprofiel">edit profiel</a>
        </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/profiel') }}">
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
                                <label for="geslacht" class="col-md-4 control-label">Geslacht:
                                    <br>Ik ben een Man<br>Ik ben een Vrouw
                                </label>

                                <div class="col-md-6"><br>
                                    {{--<input id="geslacht" type="radio" class="form-control" name="geslacht" value="man">--}}
                                    {{--<input id="geslacht" type="radio" class="form-control" name="geslacht" value="vrouw">--}}

                                    <input id="geslacht" name="geslacht" type="radio" value="man"><br>
                                    <input id="geslacht" name="geslacht" type="radio" value="vrouw">

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
                                <label for="geboorteprovincie" class="col-md-4 control-label">Geboorteprovincie</label>

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

                            <div class="form-group{{ $errors->has('Linkedin') ? ' has-error' : '' }}">
                                <label for="Linkedin" class="col-md-4 control-label">Linkedin ref</label>

                                <div class="col-md-6">
                                    <input id="linkedin" type="text" class="form-control" name="linkedin" value="{{ $user->linkedin }}">

                                    @if ($errors->has('linkedin'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                                <label for="facebook" class="col-md-4 control-label">Facebook</label>

                                <div class="col-md-6">
                                    <input id="facebook" type="text" class="form-control" name="facebook" value="{{ $user->facebook }}">

                                    @if ($errors->has('facebook'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                                <label for="twitter" class="col-md-4 control-label">Twitter</label>

                                <div class="col-md-6">
                                    <input id="twitter" type="text" class="form-control" name="twitter" value="{{ $user->twitter }}">

                                    @if ($errors->has('twitter'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                                <label for="website" class="col-md-4 control-label">Website</label>

                                <div class="col-md-6">
                                    <input id="website" type="text" class="form-control" name="website" value="{{ $user->website }}">

                                    @if ($errors->has('website'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('heeft_kinderen') ? ' has-error' : '' }}">
                                <label for="heeft_kinderen" class="col-md-4 control-label">Kinderen</label>

                                <div class="col-md-6">
                                    <input id="heeft_kinderen" type="text" class="form-control" name="heeft_kinderen" value="{{ $user->heeft_kinderen }}">

                                    @if ($errors->has('heeft_kinderen'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('heeft_kinderen') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('jaarinkomen') ? ' has-error' : '' }}">
                                <label for="jaarinkomen" class="col-md-4 control-label">Jaarinkomen</label>

                                <div class="col-md-6">
                                    <input id="jaarinkomen" type="text" class="form-control" name="jaarinkomen" value="{{ $user->jaarinkomen }}">

                                    @if ($errors->has('jaarinkomen'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('jaarinkomen') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('geenmailverzenden') ? ' has-error' : '' }}">
                                <label for="geenmailverzenden" class="col-md-4 control-label">Wenst email te ontvangen:
                                    <br>Ja, graag<br>Nee, dank je
                                </label>

                                <div class="col-md-6"><br>
                                    {{--<input id="geslacht" type="radio" class="form-control" name="geslacht" value="man">--}}
                                    {{--<input id="geslacht" type="radio" class="form-control" name="geslacht" value="vrouw">--}}

                                    <input id="geenmailverzenden" name="geenmailverzenden" type="radio" value="1"><br>
                                    <input id="geenmailverzenden" name="geenmailverzenden" type="radio" value="0">

                                    @if ($errors->has('geslacht'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('geslacht') }}</strong>
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
