@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="well well-lg">

                    <form class="form-horizontal" method="get" action="/geochart/filter">
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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="width: 1024px; height: 576px;">
                {!! Mapper::render () !!}
            </div>
        </div>
    </div>

@endsection