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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form class="form-horizontal" method="get" action="/mijnopleiding/search">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="opleiding" id="opleiding" value="{{$auth}}">
                        <input type="hidden" name="jaar" id="jaar" value="{{$eind}}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" id="searchinput"
                                   name="searchinput">
                            <span class="input-group-btn"><button class="btn btn-primary"
                                                                  type="submit">Go!</button></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        @foreach($opl as $user)
            <div class="panel panel-default" style="padding: 1em">
                <div class="row">
                    <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
                        <img src="/uploads/avatars/{{ $user->foto }}" class="img-responsive"
                             style="min-width: 5em; float:left; border-radius:50%; margin-right:1em;">
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                        <div style="margin-left: 1em;">
                            <h4><b>{{$user->voornaam}} {{$user->tussenvoegsel}} {{$user->achternaam}}</b></h4>
                            Opleiding:{{$user->naam}} genoten
                            tussen:{{$user->begin}}
                            tot {{$user->eind}}
                            Behaald: @if ($user->behaald === 1)Ja @else Nee @endif<br>
                        </div>
                    </div>

                    <div class="col-xs-10 col-sm-2 col-md-2 col-lg-2" style="padding: 1em;">
                        <div class="row">
                            <button type="button" class="btn btn-default btn-lg">
                                <a href="mailto:{{$user->email}}"><span class="glyphicon glyphicon-envelope"></span></a>
                            </button>
                            <button type="button" class="btn btn-default btn-lg">
                                <a href="profiel/{{$user->id}}"><span class="glyphicon glyphicon-user"></span></a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="container" style="alignment: center">
            <div class="row">
                <div>
                    {{$opl->appends(request()->input())->links()}}
                </div>
            </div>
        </div>
    </div>




@stop

