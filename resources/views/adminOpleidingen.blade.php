@extends('layouts.app')

@section('content')

<div class="container">
    <form method="POST" action="/adminOpleidingen/richting">
        {!! csrf_field() !!}
        <h1>Voeg richting toe</h1>
        <input type="text" name="richtingen" placeholder="Richting">
        <input type="submit" value="Voeg toe">
    </form >
    <br />
    <form method="POST" action="/adminOpleidingen/opleiding">
        {!! csrf_field() !!}
        <h1>Voeg opleiding toe</h1>
        <select name="richtingen" id="richtingen">
            @foreach($richtingen as $richting)
                <option value="{{ $richting->id }}">
                    {{ $richting->naam }}
                </option>
            @endforeach
        </select>
        <input type="text" name="opleidingen" placeholder="Opleiding">
        <input type="submit" value="Voeg toe">
    </form>
    <form method="POST" action="/adminOpleidingen/specialisatie">
        {!! csrf_field() !!}
        <h1>Voeg specialisatie toe</h1>
        <select name="opleidingen" id="opleidingen">
            @foreach($opleidingen as $opleiding)
                <option value="{{ $opleiding->id }}">
                    {{ $opleiding->naam }}
                </option>
            @endforeach
        </select>
        <input type="text" name="specialisaties" placeholder="Specialisiatie">
        <input type="submit" value="Voeg toe">
    </form>
</div>
@endsection

