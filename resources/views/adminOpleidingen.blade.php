@extends('layouts.app')

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2">
        <div class="panel panel-default" style="padding: 1em">
    <form method="POST" action="/adminOpleidingen/richting">
        {!! csrf_field() !!}
        <h2>Voeg richting toe</h2>
        <input  type="text" name="richtingen" placeholder="Richting">
        <button class="btn btn-primary" type="submit">Toevoegen</button>
    </form >
    <br /><hr>
    <form method="POST" action="/adminOpleidingen/opleiding">
        {!! csrf_field() !!}
        <h2>Voeg opleiding toe</h2>
        <select class="input-sm"name="richtingen" id="richtingen">
            @foreach($richtingen as $richting)
                <option value="{{ $richting->id }}">
                    {{ $richting->naam }}
                </option>
            @endforeach
        </select>
        <input  type="text" name="opleidingen" placeholder="Opleiding">
        <button class="btn btn-primary" type="submit">Toevoegen</button>
    </form><br><hr>
    <form method="POST" action="/adminOpleidingen/specialisatie">
        {!! csrf_field() !!}
        <h2>Voeg specialisatie toe</h2>
        <select class="input-sm" name="opleidingen" id="opleidingen">
            @foreach($opleidingen as $opleiding)
                <option value="{{ $opleiding->id }}">
                    {{ $opleiding->naam }}
                </option>
            @endforeach
        </select>
        <input type="text" name="specialisaties" placeholder="Specialisiatie">

        <button class="btn btn-primary" type="submit">Toevoegen</button>
    </form><hr>
</div>
    <br>
@endsection

