@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2 col-md-2 col-lg-2 sidenav hidden-xs">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="/dashboard">Dashboard</a></li>
                <li><a href="/overview">User Overview</a></li>
                <li><a href="">Persooneel toevoegen</a></li>
                <li><a href="#section3">Alumni toevoegen</a></li>
                <li><a href="/admin">Rechten aanpassen</a></li>
            </ul><br>
        </div>
        <br>

        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10" >
            <div class="well">
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
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="well">
                        <h4>Alumni</h4>
                        <p>{{$countUser}}</p>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="well">
                        <h4>Personeel</h4>
                        <p>{{$countPersoneel}}</p>
                        {{--<a href="">Voeg personeel toe</a>--}}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="well">
                        <canvas id="GeslachtVerdeling"></canvas>

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="well">
                        <h4>Bounce</h4>
                        <p>30%</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="well">
                        <p>Text</p>
                        <p>Text</p>
                        <p>Text</p>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="well">
                        <p>Text</p>
                        <p>Text</p>
                        <p>Text</p>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="well">
                        <p>Text</p>
                        <p>Text</p>
                        <p>Text</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <div class="well">
                        <p>Text</p>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="well">
                        <p>Text</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{$man}}
<div>

</div>
<script>


    var GeslachtVerdelingCHART = document.getElementById('GeslachtVerdeling').getContext('2d');
    var PieChart = new Chart(GeslachtVerdelingCHART, {
        type: 'pie',
        data: {
            labels: ["Man", "Vrouw"],
            datasets: [
                {
                    backgroundColor:[ "rgba(153,255,51,0.4)", "rgba(153,100,51,0.4)" ],
                    data: [{{$man}}, {{$vrouw}}]
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Geslacht Verdeling'
            }
        }
    })


</script>
</body>
</html>
@endsection