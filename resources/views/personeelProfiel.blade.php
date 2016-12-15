@extends('layouts.app')

@section('content')

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

    <div class="container">
        <div class="panel panel-default" style="padding: 1em">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <img src="/uploads/avatars/{{ $persoon->foto }}" class="img-responsive" style="min-width: 100px; float:left; border-radius:50%; margin-right:25px;">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2>{{ $persoon->voornaam }} {{ $persoon->tussenvoegsel }} {{ $persoon->achternaam }}</h2>
                    </div>

                    <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="/personeelProfiel/store" id="personeelProfielform">

                        {{ csrf_field() }}

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                            <label>Update profiel foto</label>
                            <input type="file" name="avatar">

                            <label for="voornaam">Voornaam</label>
                            <input id="voornaam" type="text" class="form-control" name="voornaam" value="{{$persoon->voornaam}}">

                            <label for="tussenvoegsel">Tussenvoegsel</label>
                            <input id="tussenvoegsel" type="text" class="form-control" name="tussenvoegsel" value="{{ $persoon->tussenvoegsel }}">

                            <label for="achternaam">Achternaam</label>
                            <input id="achternaam" type="text" class="form-control" name="achternaam" value="{{ $persoon->achternaam }}">

                            <label for="email">E-Mail Address</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $persoon->email }}">

                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password">

                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                            <label for="telefoonnummer">Telefoonnummer</label>
                            <input id="telefoonnummer" type="text" class="form-control" name="telefoonnummer" value="{{ $persoon->telefoonnummer }}">

                            <label for="facebook">facebook</label>
                            <input id="facebook" type="text" class="form-control" name="facebook" value="{{ $persoon->facebook }}">

                            <label for="linkedin">linkedin</label>
                            <input id="linkedin" type="text" class="form-control" name="linkedin" value="{{ $persoon->linkedin }}">

                            <label for="twitter">twitter</label>
                            <input id="twitter" type="text" class="form-control" name="twitter" value="{{ $persoon->twitter }}">

                            <label for="website">website</label>
                            <input id="website" type="text" class="form-control" name="website" value="{{ $persoon->website }}">

                            <label for="bevoegdheid">bevoegdheid</label>
                            <input id="bevoegdheid" type="text" class="form-control" name="bevoegdheid" value="{{ $persoon->bevoegdheid }}">

                            <label for="richting">richting</label>
                            <input id="richting" type="text" class="form-control" name="richting" value="{{ $persoon->richting }}">

                            <label for="opleiding1">opleiding1</label>
                            <input id="opleiding1" type="text" class="form-control" name="opleiding1" value="{{ $persoon->opleiding1 }}">

                            <label for="opleiding2">opleiding2</label>
                            <input id="opleiding2" type="text" class="form-control" name="opleiding2" value="{{ $persoon->opleiding2 }}">

                            <label for="opleiding3">opleiding3</label>
                            <input id="opleiding3" type="text" class="form-control" name="opleiding3" value="{{ $persoon->opleiding3 }}">

                           </div>
                    </form>

                    <form action="/personeelProfiel/delete" method="POST">
                        <input type="hidden" name="id" value="{{ $persoon->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-danger">
                                    Delete Persoon
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


