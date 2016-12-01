@extends('layouts.app')

@section('content')

    <div class="container">

{{$users->voornaam}}
@foreach($users->opleiding as $opleiding)
    {{$opleiding->naam}}
@endforeach
    </div>
@stop