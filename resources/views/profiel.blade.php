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

                    <div class="panel-body">
                        <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="/profiel" id="profielform">
                            {{ csrf_field() }}

                            <label>Update profiel foto</label>
                            <input type="file" name="avatar">

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
                                    <br>Man:<br>Vrouw:
                                </label>

                                <div class="col-md-6"><br>

                                    @if($user->geslacht == 'man') <input id="geslacht" name="geslacht" type="radio" value="man" checked><br>
                                    @else <input id="geslacht" name="geslacht" type="radio" value="man"><br>
                                    @endif

                                    @if($user->geslacht == 'vrouw') <input id="geslacht" name="geslacht" type="radio" value="vrouw" checked>
                                    @else <input id="geslacht" name="geslacht" type="radio" value="vrouw">
                                    @endif

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
                                    {{--<input id="burgerlijke staat" type="text" class="form-control" name="burgerlijke staat" value="{{ $user->burgerlijke_staat }}">--}}
                                    <select id="burgerlijke staat" name="burgelijke_staat" form="profielform">
                                        <option name="burgelijke_staat" value="ongehuwd">ongehuwd</option>
                                        <option name="burgelijke_staat" value="gehuwd">gehuwd</option>
                                    </select>
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

                            <div class="form-group{{ $errors->has('geboorteland') ? ' has-error' : '' }}">
                                <label for="geboorteland" class="col-md-4 control-label">geboorteland</label>

                                <div class="col-md-6">
                                    <input id="geboorteland" type="text" class="form-control" name="geboorteland" value="{{ $user->geboorteland }}">

                                    @if ($errors->has('geboorteland'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('geboorteland') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('geboortedatum') ? ' has-error' : '' }}">
                                <label for="geboortedatum" class="col-md-4 control-label">geboortedatum</label>

                                <div class="col-md-6">
                                    <input id="geboortedatum" type="date" class="form-control" name="geboortedatum" value="{{ $user->geboortedatum }}">

                                    @if ($errors->has('geboortedatum'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('geboortedatum') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                                <label for="facebook" class="col-md-4 control-label">facebook</label>

                                <div class="col-md-6">
                                    <input id="facebook" type="text" class="form-control" name="facebook" value="{{ $user->facebook }}">

                                    @if ($errors->has('facebook'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('linkedin') ? ' has-error' : '' }}">
                                <label for="linkedin" class="col-md-4 control-label">linkedin</label>

                                <div class="col-md-6">
                                    <input id="linkedin" type="text" class="form-control" name="linkedin" value="{{ $user->linkedin }}">

                                    @if ($errors->has('linkedin'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('heeft_kinderen') ? ' has-error' : '' }}">
                                <label for="heeft_kinderen" class="col-md-4 control-label">heeft_kinderen</label>

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
                                <label for="jaarinkomen" class="col-md-4 control-label">jaarinkomen</label>

                                <div class="col-md-6">
                                    <input id="jaarinkomen" type="text" class="form-control" name="jaarinkomen" value="{{ $user->jaarinkomen }}">

                                    @if ($errors->has('jaarinkomen'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('jaarinkomen') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('twitter') ? ' has-error' : '' }}">
                                <label for="twitter" class="col-md-4 control-label">twitter</label>

                                <div class="col-md-6">
                                    <input id="twitter" type="text" class="form-control" name="twitter" value="{{ $user->twitter }}">

                                    @if ($errors->has('twitter'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                <label for="website" class="col-md-4 control-label">website</label>

                                <div class="col-md-6">
                                    <input id="website" type="text" class="form-control" name="website" value="{{ $user->website }}">

                                    @if ($errors->has('website'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @foreach($user->opleiding as $opl)

                            <div class="form-group{{ $errors->has('naam') ? ' has-error' : '' }}">
                                <label for="naam" class="col-md-4 control-label">opleiding</label>

                                <div class="col-md-6">
                                    <input id="naam" type="text" class="form-control" name="naam" value="{{ $opl->naam }}" disabled>

                                    @if ($errors->has('naam'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('naam') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @endforeach


                            <div class="form-group{{ $errors->has('geenmailverzenden') ? ' has-error' : '' }}">
                                <label for="geenmailverzenden" class="col-md-4 control-label">Wenst email te ontvangen:
                                    <br>Ja, graag<br>Nee, dank je
                                </label>

                                <div class="col-md-6"><br>

                                    @if($user->geenmailverzenden == 1) <input id="geenmailverzenden" name="geenmailverzenden" type="radio" value="1" checked><br>
                                    @else <input id="geenmailverzenden" name="geenmailverzenden" type="radio" value="1"><br>
                                    @endif

                                    @if($user->geenmailverzenden == 0) <input id="geenmailverzenden" name="geenmailverzenden" type="radio" value="0" checked>
                                    @else <input id="geenmailverzenden" name="geenmailverzenden" type="radio" value="0">
                                    @endif

                                    @if ($errors->has('geenmailverzenden'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('geenmailverzenden') }}</strong>
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
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-danger">
                                        Delete User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <label for="naam" class="col-md-4 control-label">voeg een opleiding toe</label>

    <div class="col-md-6">
        <!-- Trigger/Open The Modal -->
        <button id="myBtn">Voeg toe</button>

        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">x</span>
                <p>Some text in the Modal..</p>
            </div>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

@endsection

