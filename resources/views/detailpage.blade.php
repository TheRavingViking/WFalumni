@extends('layouts.app')

@section('content')

    <div class="container">

        {{$users->voornaam}}
        @foreach($users->opleiding as $opleiding)
            {{$opleiding->naam}}
        @endforeach

        @foreach($users->bedrijf as $bedrijf)
            {{$bedrijf->naam}}
        @endforeach

        @foreach($users->woonplaats as $woonplaats)
            {{$woonplaats->naam}}
        @endforeach
    </div>
@stopww