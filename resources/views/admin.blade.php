@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="panel panel-default">
            <div class="row">
                <div class="panel-heading">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
                </div>
            </div>
        </div>


        @foreach($users as $user)
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
                        <img src="/uploads/avatars/{{ $user->foto }}" class="img-responsive image-rounded">
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5">
                        <h4>
                            <b>{{$user->voornaam}} {{$user->tussenvoegsel}} {{$user->achternaam}}</b>
                        </h4>

                        Nummer: {{$user->studentnummer}}
                        Email: {{$user->email}}

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
                        <div class="dropdown-group-middle" style="float: right; vvertical-align:middle">
                            <form class="form-horizontal" action="{{ route('admin.assign') }}" method="POST">
                                <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                <select class="input-sm input-margin" name="bevoegdheid">
                                    <option @if ($user->bevoegdheid == 1) selected="selected" @else @endif value="1">
                                        Alumni
                                    </option>
                                    <option @if ($user->bevoegdheid == 2) selected="selected" @else @endif value="2">
                                        OpleidingsAdmin
                                    </option>
                                    <option @if ($user->bevoegdheid == 3) selected="selected" @else @endif value="3">
                                        SuperAdmin
                                    </option>
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary" type="submit">Rollen wijzigen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        @endforeach
    </div>

@endsection