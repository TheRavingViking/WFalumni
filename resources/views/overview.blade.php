@extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel panel-default" style="padding: 2em">
        <div class="row">
            <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="/overview" id="delete">
                {{ csrf_field() }}
            <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                <button type="submit" class="btn btn-danger">Delete User</button>
            </div>
                <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                <button class="btn btn-default">
                    <a href="mailto: @foreach ($users as $mail){{$mail->email}},@endforeach " target="_top">Mail iedereen</a>
                </button>
                </div>
        </div>
    </div>
</div>



    <div class="container">
        @foreach($users as $user)

            <div class="panel panel-default" style="padding: 1em">
                <div class="row">
                    <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
                        <img src="/uploads/avatars/{{ $user->foto }}" class="img-responsive"
                             style="min-width: 5em; float:left; border-radius:50%; margin-right:1em;">
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                        <div style="margin-left: 1em;">
                            <h4><b>{{$user->voornaam}} {{$user->tussenvoegsel}} {{$user->achternaam}}</b></h4>
                            Opleiding:{{$user->opleiding[0]->naam}} genoten tussen:{{$user->opleiding[0]->begin}}
                            tot {{$user->opleiding[0]->eind}}
                            Behaald: @if ($user->opleiding[0]->behaald === 1)Ja @else Nee @endif<br>
                        </div>
                    </div>

                    <div class="col-xs-10 col-sm-2 col-md-2 col-lg-2" style="padding: 1em;">
                        <div class="row">
                            <button type="button" class="btn btn-default btn-lg">
                                <a href="mailto:{{$user->email}}"><span class="glyphicon glyphicon-envelope"></span></a>
                            </button>
                            <button type="button" class="btn btn-default btn-lg">
                                <a href="https://{{$user->linkedin}}"><span class="glyphicon glyphicon-user"></span></a>
                            </button>
                            <button type="button" class="btn btn-default btn-lg">
                                <a href="profiel/{{$user->id}}"><span class="glyphicon glyphicon-cog"></span></a>
                            </button>
                            <input type="checkbox" name="checkbox[]" value="{{$user->id}}">
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

        <div class="container" style="alignment: center">
            <div class="row">
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
            </form>

@stop