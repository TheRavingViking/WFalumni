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
                        <button id="richt" class="btn btn-primary" type="submit">Toevoegen</button>
                    </form>
                    <h2>Richting aanpassen</h2>
                    <form method="POST" action="/adminOpleidingen/richtingEdit">
                        {!! csrf_field() !!}
                        <select class="input-sm" name="richting_id" id="richting_id" style="margin-bottom: 5px">

                            @foreach($richtingen as $richting)
                                <option value="{{ $richting->id }}">
                                    {{ $richting->naam }}
                                </option>
                            @endforeach
                        </select>
                                <input type="text" name="richtingen_edit" id="richtingen_edit" class="form-control" placeholder="Richting" style="margin-bottom: 5px">


                        <button id="richtingen" class="btn btn-primary" type="submit">Edit</button>
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
                        <button id="opl" class="btn btn-primary" type="submit">Toevoegen</button>
                    </form>
                    <h2>Opleiding aanpassen</h2>
                    <form method="POST" action="/adminOpleidingen/opleidingEdit">
                        {!! csrf_field() !!}
                        <select class="input-sm" name="opleiding_id" id="opleiding_id" style="margin-bottom: 5px">

                            @foreach($opleidingen as $opleiding)
                                <option value="{{ $opleiding->id }}">
                                    {{ $opleiding->naam }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" name="opleiding_edit" id="opleiding_edit" class="form-control" placeholder="Opleiding" style="margin-bottom: 5px">


                        <button id="opleidingen" class="btn btn-primary" type="submit">Edit</button>
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
                            @foreach($specialisaties as $specialisatie)
                                <option value="{{ $specialisatie->id }}">
                                    {{ $specialisatie->naam }}
                                </option>
                            @endforeach
                        </select>
                        <br>
                        <input  type="text" class="form-control" name="specialisaties"
                               placeholder="Specialisiatie" style="margin-bottom: 5px">

                        <button id="spec" class="btn btn-primary" type="submit">Toevoegen</button>
                    </form>
                    <h2>Specialisatie aanpassen</h2>

                    <form method="POST" action="/adminOpleidingen/specialisatieEdit">
                        {!! csrf_field() !!}
                        <select class="input-sm" name="specialisatie_id" id="specialisatie_id" style="margin-bottom: 5px">

                            @foreach($specialisaties as $specialisatie)
                                <option value="{{ $specialisatie->id }}">
                                    {{ $specialisatie->naam }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" name="specialisatie_edit" id="specialisatie_edit" class="form-control" placeholder="Specialisatie" style="margin-bottom: 5px">


                        <button id="specialisaties" class="btn btn-primary" type="submit">Edit</button>
                    </form>
                </div>
            </div>
            <hr>

        </div>

<script>

    $('#richtingen').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        swal({
            title: "Weet je het zeker?",
            text: "Deze actie is permanent!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ffcf00",
            confirmButtonText: "Ja, wijzig richting!",
            closeOnConfirm: false
        }, function(isConfirm){
            if (isConfirm) form.submit();
        });
    });

    $('#opleidingen').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        swal({
            title: "Weet je het zeker?",
            text: "Deze actie is permanent!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ffcf00",
            confirmButtonText: "Ja, wijzig opleiding!",
            closeOnConfirm: false
        }, function(isConfirm){
            if (isConfirm) form.submit();
        });
    });

    $('#specialisaties').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        swal({
            title: "Weet je het zeker?",
            text: "Deze actie is permanent!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ffcf00",
            confirmButtonText: "Ja, wijzig specialisatie!",
            closeOnConfirm: false
        }, function(isConfirm){
            if (isConfirm) form.submit();
        });
    });

    $('#richt').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        swal({
            title: "Weet je het zeker?",
            text: "Deze actie is permanent!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ffcf00",
            confirmButtonText: "Ja, voeg richting toe!",
            closeOnConfirm: false
        }, function(isConfirm){
            if (isConfirm) form.submit();
        });
    });

    $('#opl').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        swal({
            title: "Weet je het zeker?",
            text: "Deze actie is permanent!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ffcf00",
            confirmButtonText: "Ja, voeg opleiding toe!",
            closeOnConfirm: false
        }, function(isConfirm){
            if (isConfirm) form.submit();
        });
    });

    $('#spec').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        swal({
            title: "Weet je het zeker?",
            text: "Deze actie is permanent!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ffcf00",
            confirmButtonText: "Ja, voeg specialisatie toe!",
            closeOnConfirm: false
        }, function(isConfirm){
            if (isConfirm) form.submit();
        });
    });



</script>



@endsection

