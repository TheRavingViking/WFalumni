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
                            <span class="input-group-btn"><button class="btn btn-primary" data-style="expand-right"
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
                    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
                        <img src="/uploads/avatars/{{ $user->user->foto }}" class="img-responsive img-circle">
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                        <div>
                            <h4>
                                <b style="align-text:left">
                                    @if($user->user->bevoegdheid == 2) Docent <i
                                            class="glyphicon glyphicon-user"> </i> :
                                </b><b style="align-text:left">
                                    @elseif($user->user->bevoegdheid == 1) Student <i
                                            class="glyphicon glyphicon-user"> </i> :
                                </b><b style="align-text:left">
                                    @elseif($user->user->bevoegdheid == 3) Admin <i
                                            class="glyphicon glyphicon-user"> </i> :
                                    @endif
                                </b>
                                {{$user->user->voornaam}} {{$user->user->tussenvoegsel}} {{$user->user->achternaam}}
                            </h4>
                            Opleiding:{{$user->naam}} genoten
                            tussen:{{$user->begin}}
                            tot {{$user->eind}}
                            Behaald: @if ($user->behaald === 1)Ja @else Nee @endif<br>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                        <div class="row">
                            <div class="social-icons-bar">
                                <a href="https://{{$user->user->facebook}}" class="btn btn-social-icon btn-facebook">
                                    <span class="fa fa-facebook"></span>
                                </a>
                                <a href="https://{{$user->user->linkedin}}" class="btn btn-social-icon btn-linkedin">
                                    <span class="fa fa-linkedin"></span>
                                </a>
                                <a href="mailto:{{$user->user->email}}" class="btn btn-social-icon btn-google"><span
                                            class="fa fa-envelope"></span></a>
                                <a href="profiel/{{$user->user->id}}" class="btn btn-social-icon btn-linkedin">
                                    <span class="fa fa-user"></span></a>
                            </div>
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

@endsection

