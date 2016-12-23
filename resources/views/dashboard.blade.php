@extends('layouts.app')

@section('content')

    <div class="container-fluid" style="padding: 1.25em;">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <div class="well">
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        <form class="form-horizontal" method="get" action="/dashboard/filter">
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
                    <form class="form-horizontal" method="get" action="/dashboard">
                        <button class="btn btn-primary">Leegmaken</button>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="well">
                    <h1></h1><br>
                    {{--@foreach($personeel as $persoon)--}}
                    {{--<b>{{$persoon->voornaam}} {{$persoon->tussenvoegsel}} {{$persoon->achternaam}}</b> @if($persoon->bevoegdheid == 3)--}}
                    {{--Opleidings administrator--}}
                    {{--@else Administrator @endif<br>--}}
                    {{--@endforeach--}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="well">
                    <canvas id="alumniVSpersoneel"></canvas>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="well">
                    <canvas id="ouders"></canvas>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="well">
                    <canvas id="GeslachtVerdeling"></canvas>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 hidden-xs">
                <div class="well">
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
                        backgroundColor: ["rgba(153,255,51,0.4)", "rgba(153,100,51,0.4)"],
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
                        backgroundColor: ["rgba(153,255,51,0.4)", "rgba(153,100,51,0.4)"],
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
                            'rgba(153,255,51,0.4)',
                            'rgba(130,100,51,0.4)',
                            'rgba(153,10,51,0.4)',
                            'rgba(10,100,51,0.4)',
                            'rgba(255,255,51,0.4)'
                        ],
                        borderColor: [
                            'rgba(153,255,51,0.4)',
                            'rgba(130,100,51,0.4)',
                            'rgba(153,10,51,0.4)',
                            'rgba(10,100,51,0.4)',
                            'rgba(255,255,51,0.4)'
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
                        backgroundColor: ["rgba(153,255,51,0.4)", "rgba(153,100,51,0.4)"],
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


    </script>

@endsection