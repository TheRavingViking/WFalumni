@extends('layouts.app')

@section('content')

<a href="mailto: @foreach ($users as $mail){{$mail->email}},@endforeach " target="_top">Link to all the mail</a>
    <div class="container">
        {{--{{dd($users)}}--}}
        @foreach($users as $user)

            <div class="panel panel-default" style="padding: 1em">
                <div class="row">
                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <img src="/uploads/avatars/{{ $user->foto }}" class="img-responsive"
                             style="min-width: 100px; float:left; border-radius:50%; margin-right:25px;">
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <h1 href="overview/{{$user->id}}">{{$user->voornaam}} {{$user->tussenvoegsel}} {{$user->achternaam}}</h1>
                            <br>
                        {{$user->opleiding[0]->naam}} {{$user->opleiding[0]->begin}} tot {{$user->opleiding[0]->eind}}
                        Behaald: @if ($user->opleiding[0]->behaald === 1)Ja @else Nee @endif

                    </div>
                    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1" align="right">
                        <button type="button" class="btn btn-default btn-lg">
                            <a href="mailto:{{$user->email}}"><span class="glyphicon glyphicon-envelope"></span></a>
                        </button>
                        <button type="button" class="btn btn-default btn-lg">
                            <a href="{{$user->linkedin}}"><span class="glyphicon glyphicon-user"></span></a>
                        </button>
                        <button type="button" class="btn btn-default btn-lg">
                            <a href="overview/{{$user->id}}"><span class="glyphicon glyphicon-cog"></span></a>
                        </button>
                    </div>
                </div>
            </div>

        @endforeach
        <div class="container" style="alignment: center">
            <div class="row">
                <div>
                    {{--{{ $users->links() }}--}}
                </div>
            </div>
        </div>
@stop