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
    </div>
    {{--<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">--}}
        {{--<div class="panel">--}}
            {{--<h1>Admin Tools:</h1><br>--}}

            {{--<form class="form-horizontal" method="get" action="/admin">--}}
                {{--<button class="btn btn-primary">Bevoegdheid veranderen</button>--}}
            {{--</form>--}}
            {{--<hr>--}}
            {{--<a href="{{ url('/admin') }}">Bevoegdheid veranderen</a><br><hr>--}}
            {{--<form class="form-horizontal" method="get" action="/geochart">--}}
                {{--<button class="btn btn-primary">Geocharts</button>--}}
            {{--</form>--}}
            {{--<hr>--}}

            {{--@foreach($personeel as $persoon)--}}
            {{--<b>{{$persoon->voornaam}} {{$persoon->tussenvoegsel}} {{$persoon->achternaam}}</b> @if($persoon->bevoegdheid == 3)--}}
            {{--Opleidings administrator--}}
            {{--@else Administrator @endif<br>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="container-fluid" style="padding: 1.25em;">
        <div class="row">
            {{--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">--}}
            <div class="panel">
                <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
                    <form class="form-horizontal" method="get" action="/dashboard/filter">
                        <select name="richtingen" id="richtingen" class="input-sm">
                            <option value="">-----</option>
                            @foreach($richtingen as $richting)
                                <option value="{{ $richting->naam }}">
                                    {{ $richting->naam }}
                                </option>
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
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <form class="form-horizontal" method="get" action="/dashboard">
                            <button class="btn btn-primary">Leegmaken</button>
                        </form>
                    </div>
                    <div class="btn-group">
                        <form class="form-horizontal" method="get" action="/admin">
                            <button class="btn btn-primary">Bevoegdheid veranderen</button>
                        </form>
                    </div>
                    <div class="btn-group">
                        <form class="form-horizontal" method="get" action="/geochart">
                            <button class="btn btn-primary">Geocharts</button>
                        </form>
                    </div>
                    <div class="btn-group">
                        <form class="form-horizontal" method="get" action="/addUser">
                            <button class="btn btn-primary">Add User</button>
                        </form>
                    </div>
                    <div class="btn-group">
                        <form class="form-horizontal" method="get" action="/adminOpleidingen">
                            <button class="btn btn-primary">Opleidingen toevoegen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="well">
                <canvas id="werkendInVakgebied"></canvas>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="panel">
                <canvas id="alumniVSpersoneel"></canvas>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="panel">
                <canvas id="ouders"></canvas>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="panel">
                <canvas id="GeslachtVerdeling"></canvas>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 hidden-xs">
            <div class="panel">
                <canvas id="jaarInkomen"></canvas>

            </div>
        </div>
    </div>
    </div>

    <script>


        var alumniVSpersoneelCHART = document.getElementById('alumniVSpersoneel').getContext('2d');
        var alumChart = new Chart(alumniVSpersoneelCHART, {
            type: 'pie',
            data: {
                labels: ["Alumni", "Personeel"],
                datasets: [
                    {
                        backgroundColor: ["rgba(0,70,133,1)", "rgba(213,161,15,1)"],
                        data: [{{$countUser}}, {{$countPersoneel}}]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Alumni - Personeel'
                }
            }
        });

        var GeslachtVerdelingCHART = document.getElementById('GeslachtVerdeling').getContext('2d');
        var GeslachtChart = new Chart(GeslachtVerdelingCHART, {
            type: 'doughnut',
            data: {
                labels: ["Man", "Vrouw"],
                datasets: [
                    {
                        backgroundColor: ["rgba(0,70,133,1)", "rgba(213,161,15,1)"],
                        data: [{{$man}}, {{$vrouw}}]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Geslacht Verdeling in %'
                }
            }
        });

        var JaarInkomenCHART = document.getElementById('jaarInkomen').getContext('2d');
        var InkomenChart = new Chart(JaarInkomenCHART, {
            type: 'bar',
            data: {
                labels: ["0-12500", "12500-30000", "30000-50000", "50000-100000", "100000+"],
                datasets: [
                    {
                        label: "Gebruikers per inkomensniveau",
                        backgroundColor: [
                            "rgba(0,70,133,1)",
                            "rgba(213,161,15,1)",
                            "rgba(0,70,133,1)",
                            "rgba(213,161,15,1)",
                            "rgba(0,70,133,1)"
                        ],
                        borderColor: [
                            "rgba(0,70,133,1)",
                            "rgba(213,161,15,1)",
                            "rgba(0,70,133,1)",
                            "rgba(213,161,15,1)",
                            "rgba(0,70,133,1)"
                        ],
                        borderWidth: 1,
                        data: [ {{$laaginkomen}}, {{$laagmiddeninkomen}}, {{$middeninkomen}}, {{$middenhooginkomen}}, {{$hooginkomen}} ]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'JaarInkomen'
                }
            }
        });

        var OudersCHART = document.getElementById('ouders').getContext('2d');
        var heeftKinderenChart = new Chart(OudersCHART, {
            type: 'pie',
            data: {
                labels: ["Ouders", "Niet ouders"],
                datasets: [
                    {
                        backgroundColor: ["rgba(0,70,133,1)", "rgba(213,161,15,1)"],
                        data: [{{$ouders}}, {{$nietOuders}}]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Ouders'
                }
            }
        });


        var werkendInVakgebiedCHART = document.getElementById('werkendInVakgebied').getContext('2d');
        var werkendInVakgebiedChart = new Chart(werkendInVakgebiedCHART, {
            type: 'pie',
            data: {
                labels: ["Werkt in vakgebied", "Werkt niet in vakgebied"],
                datasets: [
                    {
                        backgroundColor: ["rgba(0,70,133,1)", "rgba(213,161,15,1)"],
                        data: [{{$werkend}}, {{$nietWerkend}}]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Werkend in vakgebied'
                }
            }
        });


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

@endsection