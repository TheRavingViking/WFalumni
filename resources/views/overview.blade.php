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
                <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="/overview"
                      id="delete">
                    {{ csrf_field() }}
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                        <button type="submit" class="btn btn-danger">Delete User</button>
                    </div>
                </form>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                    <button class="btn btn-default">
                        <a href="mailto: @foreach ($users as $mail){{$mail->email}}@endforeach " target="_top">Mail
                            iedereen</a>
                    </button>
                </div>
                <form class="form-horizontal" method="get" action="">
                    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                    <input type="text" name="searchinput" placeholder="Search.." id="searchinput">
                    <button class="btn btn-primary">Go</button>
                </form>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form class="form-horizontal" method="get" action="">
                    <select name="richtingen" id="richtingen">
                        @foreach($richtingen as $richting)
                            <option value="{{ $richting->id }}">
                                {{ $richting->naam }}
                            </option>
                        @endforeach
                    </select>
                    <select name="opleidingen" id="opleidingen">
                        @foreach($opleidingen as $opleiding)
                            <option value="{{ $opleiding->id }}">
                                {{ $opleiding->naam }}
                            </option>
                        @endforeach
                    </select>
                    <select name="specialisaties" id="specialisaties">
                        @foreach($specialisaties as $specialisatie)
                            <option value="{{ $specialisatie->id }}">
                                {{ $specialisatie->naam }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary">Go</button>
                </form>
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
                            Opleiding:{{$user->opleiding->last()->naam}} genoten
                            tussen:{{$user->opleiding->last()->begin}}
                            tot {{$user->opleiding->last()->eind}}
                            Behaald: @if ($user->opleiding->last()->behaald === 1)Ja @else Nee @endif<br>
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
                                <a href="profiel/{{$user->id}}"><span class="glyphicon glyphicon-cog""></span></a>
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
                    {{--{{ $users->links() }}--}}
                    {{$users->appends(request()->input())->links()}}
                </div>
            </div>
        </div>
    </div>




@stop