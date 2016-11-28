@extends('layouts.app')

@section('content')

<div class="container">

    <h1>{{$users->voornaam}} {{$users->tussenvoegsel}} {{$users->achternaam}}</h1>

</div>
@stop