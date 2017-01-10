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

        <div class="panel panel-default">
            <div class="row">
                <div class="panel-heading">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
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

                    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                        <button class="btn btn-primary">Mail iedereen
                            <a href="mailto: @foreach ($users as $mail){{$mail->email}}@endforeach"></a>
                        </button>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                        <form enctype="multipart/form-data" method="POST" action="/overview"
                              id="delete">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Delete User</button>
                        </form>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-top: 2em">
                        <form class="form-horizontal" method="get" action="/overview/filter">
                            <select name="richtingen" id="richtingen" class="input-sm">
                                <option value="">Kies een Richting</option>
                                @foreach($richtingen as $richting)
                                    <option value="{{ $richting->naam }}">{{ $richting->naam }}</option>
                                @endforeach
                            </select>
                            <select name="opleidingen" id="opleidingen" class="input-sm">
                                <option value="">-----</option>
                            </select>
                            <select name="specialisaties" id="specialisaties" class="input-sm">
                                <option value="">-----</option>
                            </select>
                            <button class="btn btn-primary">Go</button>
                        </form>
                    </div>

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

    <script>

        $('#richtingen').on('change', function (e) {
            console.log(e);


            var richting_naam = e.target.value;

            //ajax

            $.get('/richtingen?richting_naam=' + richting_naam, function (data) {

                $('#opleidingen').empty();
                $("<option value=''>Kies een opleiding</option>").appendTo('#opleidingen');

                $.each(data, function (index, opleidingen) {

                    $('#opleidingen').append('<option value="' + opleidingen.naam + '">' + opleidingen.naam + '</option>');

                })
            });

        });


        $('#opleidingen').on('change', function (e) {
            console.log(e);


            var opleidingen_naam = e.target.value;

            //ajax

            $.get('/opleidingen?opleidingen_naam=' + opleidingen_naam, function (data) {

                $('#specialisaties').empty();
                $("<option value=''>Optioneel</option>").appendTo('#specialisaties');

                $.each(data, function (index, specialisaties) {

                    $('#specialisaties').append('<option value="' + specialisaties.naam + '">' + specialisaties.naam + '</option>');

                })
            });

        });


    </script>





@stop