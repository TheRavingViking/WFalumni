@extends('layouts.app')

@section('content')



    <div class="container">
        @foreach($users as $user)
            <div class="panel panel-default" style="padding: 1em">
                <div class="row">

                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <img src="/uploads/avatars/{{ $user->foto }}" class="img-responsive" style="min-width: 100px">
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <h1>{{$user->voornaam}} {{$user->tussenvoegsel}} {{$user->achternaam}}</h1> <br>
                        Nationaliteit: {{$user->nationaliteit}}. Geboorteland: {{$user->geboorteland}}.
                        Geboorteplaats: {{$user->geboorteplaats}}. <br>
                        Geboortedatum: {{$user->geboortedatum}}. Geslacht: {{$user->geslacht}}.<br>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <button type="button" class="btn btn-default btn-lg">
                            <a href="mailto:{{$user->email}}"><span class="glyphicon glyphicon-envelope"></span></a>
                        </button>
                        <button type="button" class="btn btn-default btn-lg">
                            <a href="{{$user->linkedin}}"><span class="glyphicon glyphicon-user"></span></a>
                        </button>
                        <button type="button" class="btn btn-default btn-lg">
                            <a href="detailpage?id={{$user->id}}"s><span class="glyphicon glyphicon-cog"></span></a>
                        </button>
                    </div>
                </div>
            </div>

    @endforeach


@stop