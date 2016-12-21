@extends('layouts.app')

@section('content')


    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="panel panel-default" style="padding: 2em">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                    <form class="form-horizontal" method="get" action="/overview/search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" id="searchinput"
                                   name="searchinput">
                            <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Go!</button>
                        </span>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">

                <form class="form-horizontal" method="get" action="/overview/filter">
                    <select name="richtingen" id="richtingen">
                        <option value="">-----</option>
                        @foreach($richtingen as $richting)
                            <option value="{{ $richting->naam }}">
                                {{ $richting->naam }}
                            </option>
                        @endforeach
                    </select>
                    <select name="opleidingen" id="opleidingen">
                        <option value="">-----</option>
                        @foreach($opleidingen as $opleiding)
                            <option value="{{ $opleiding->naam }}">
                                {{ $opleiding->naam }}
                            </option>
                        @endforeach
                    </select>
                    <select name="specialisaties" id="specialisaties">
                        <option value="">-----</option>
                        @foreach($specialisaties as $specialisatie)
                            <option value="{{ $specialisatie->naam }}">
                                {{ $specialisatie->naam }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary">Go</button>
                </form>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                    <button class="btn btn-default">
                        <a href="mailto: @foreach ($users as $mail){{$mail->email}}@endforeach">Mail
                            iedereen</a>
                    </button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-1">
                    <form enctype="multipart/form-data" method="POST" action="/overview"
                          id="delete">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">Delete User</button>
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
                            <h4>
                                <b>{{$user->voornaam}} {{$user->tussenvoegsel}} {{$user->achternaam}}</b>
                            </h4>
                            Opleiding:{{$user->opleiding->last()->naam}} genoten
                            tussen:{{$user->opleiding->last()->begin}}
                            tot {{$user->opleiding->last()->eind}}
                            Behaald: @if ($user->opleiding->last()->behaald === 1)Ja @else Nee @endif<br>
                        </div>
                    </div>

                    <div class="col-xs-10 col-sm-2 col-md-2 col-lg-2" style="padding: 1em;">
                        <div class="row">
                            <a href="https://{{$user->facebook}}" class="btn btn-social-icon btn-facebook">
                                <span class="fa fa-facebook"></span>
                            </a>
                            <a href="https://{{$user->linkedin}}" class="btn btn-social-icon btn-linkedin">
                                <span class="fa fa-linkedin"></span>
                            </a>
                            <a href="mailto:{{$user->email}}" class="btn btn-social-icon btn-google"><span
                                        class="fa fa-envelope"></span></a>
                            <a href="profiel/{{$user->id}}" class="btn btn-social-icon btn-linkedin">
                                <span class="fa fa-user"></span></a>
                            <input type="checkbox" name="checkbox[]" value="{{$user->id}}">
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
            </form>
            <div class="container" style="alignment: center">
                <div class="row">
                    <div>
                        {{$users->appends(request()->input())->links()}}
                    </div>
                </div>
            </div>
    </div>



@stop