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


    <div class="container">
        <div class="panel panel-default">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <form method="POST" action="/adminOpleidingen/richting">
                        {!! csrf_field() !!}
                        <h2>Voeg richting toe</h2>
                        <input type="text" name="richtingen" class="form-control" placeholder="Richting" style="margin-bottom: 5px">
                        <button class="btn btn-primary" type="submit">Toevoegen</button>
                    </form>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <form method="POST" action="/adminOpleidingen/opleiding">
                        {!! csrf_field() !!}
                        <h2>Voeg opleiding toe</h2>
                        <select class="input-sm" name="richtingen" id="richtingen "style="margin-bottom: 5px">
                            @foreach($richtingen as $richting)
                                <option value="{{ $richting->id }}">
                                    {{ $richting->naam }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control" name="opleidingen" placeholder="Opleiding" style="margin-bottom: 5px">
                        <button class="btn btn-primary" type="submit">Toevoegen</button>
                    </form>

                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                    <form method="POST" action="/adminOpleidingen/specialisatie">
                        {!! csrf_field() !!}

                        <h2>Voeg specialisatie toe</h2>
                        <select class="input-sm" name="opleidingen" id="opleidingen" style="margin-bottom: 5px">
                            @foreach($opleidingen as $opleiding)
                                <option value="{{ $opleiding->id }}">
                                    {{ $opleiding->naam }}
                                </option>
                            @endforeach
                        </select>
                        <br>
                        <input type="text" class="form-control" name="specialisaties"
                               placeholder="Specialisiatie" style="margin-bottom: 5px">

                        <button class="btn btn-primary" type="submit">Toevoegen</button>
                    </form>
                </div>
            </div>
            <hr>

        </div>

@endsection

