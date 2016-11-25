@extends('layouts.app')

@section('content')


@foreach($users as $user)

    <div>
        {{$user->voornaam}}
        {{$user->achternaam}}
        <a href="mailto:{{$user->email}}">mail</a>
        <a href="{{$user->linkedin}}">linkedin</a>
        <a href="detailpage?id={{$user->id}}">wijzig</a>

    </div>
@endforeach


@stop