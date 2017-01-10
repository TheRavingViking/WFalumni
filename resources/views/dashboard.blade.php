@extends('layouts.app')

@section('content')

    <div class="container-fluid" style="padding: 1.25em;">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel">
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
                            <select name="opleidingen" id="opleidingen" class="input-sm">
                                <option value="">-----</option>

                            </select>
                            <select name="specialisaties" id="specialisaties" class="input-sm">
                                <option value="">-----</option>

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
                        backgroundColor: ["rgba(153,255,51,0.4)", "rgba(153,100,51,0.4)"],
                        data: [{{$werkend}}, {{$nietWerkend}}]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'werkendInVakgebied'
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