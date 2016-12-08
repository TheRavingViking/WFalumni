@extends('layouts.app')

@section('content')

    <div class="container">
        @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
        <div class="panel panel-default" style="padding: 2em">
            <div class="row">
                <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="/personeelOverview/delete" id="delete">
                    {{ csrf_field() }}
                    <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                        <button type="submit" class="btn btn-danger">Delete Personeel</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>



    <div class="container">
        @foreach($personeel as $persoon)

            <div class="panel panel-default" style="padding: 1em">
                <div class="row">
                    <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
                        <img src="/uploads/avatars/{{ $persoon->foto }}" class="img-responsive"
                             style="min-width: 5em; float:left; border-radius:50%; margin-right:1em;">
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                        <div style="margin-left: 1em;">
                            <h4><b>{{$persoon->voornaam}} {{$persoon->tussenvoegsel}} {{$persoon->achternaam}}</b></h4>
                        </div>
                    </div>

                    <div class="col-xs-10 col-sm-2 col-md-2 col-lg-2" style="padding: 1em;">
                        <div class="row">
                            <button type="button" class="btn btn-default btn-lg">
                                <a href="mailto:{{$persoon->email}}"><span class="glyphicon glyphicon-envelope"></span></a>
                            </button>
                            <button type="button" class="btn btn-default btn-lg">
                                <a href="https://{{$persoon->linkedin}}"><span class="glyphicon glyphicon-user"></span></a>
                            </button>
                            <button type="button" class="btn btn-default btn-lg">
                                <a href="profiel/{{$persoon->id}}"><span class="glyphicon glyphicon-cog"></span></a>
                            </button>
                            <input type="checkbox" name="checkbox[]" value="{{$persoon->id}}">
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

        <div class="container" style="alignment: center">
            <div class="row">
                <div>
                    {{ $personeel->links() }}
                </div>
            </div>
        </div>
    </div>

@stop