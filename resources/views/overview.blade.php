@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-4"></div>
        <div class="col-md-4">
            @foreach($users as $user)
                <div class="panel panel-default">
                    <img src="/uploads/avatars/{{ $user->foto }}" class="thumbnail" style="width: 20%">
                    {{$user->voornaam}}
                    {{$user->achternaam}} <br>
                    <a href="mailto:{{$user->email}}">mail</a>
                    <a href="{{$user->linkedin}}">linkedin</a>
                    <a href="detailpage?id={{$user->id}}">wijzig</a>

                </div>
            @endforeach
        </div>
        <div class="col-md-4"></div>

    </div>

@stop