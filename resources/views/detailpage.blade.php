@extends('layouts.app')

@section('content')

    <div class="container">

        {{$users->voornaam}}

        @foreach($users->opleiding as $user)
            {{$user->naam}}
            @endforeach

    </div>
@stop