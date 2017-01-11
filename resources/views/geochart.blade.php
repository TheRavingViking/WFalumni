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

    <div class="container col-md-offset-2 col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div class="row ">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Geocharts:</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="get" action="/geochart/filter">
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
                        Woonplaats
                        <input id="radio" name="radio" type="radio"
                               value="woonplaats">
                        bedrijven
                        <input id="radio" name="radio" type="radio"
                               value="bedrijf">
                        <button class="btn btn-primary">Go</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="embed-responsive embed-responsive-16by9">
                        <div id="map_canvas" class="embed-responsive-item" style="padding: 1em">
                            {!! Mapper::render () !!}
                        </div>
                    </div>
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
@endsection


