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
                <div class="panel-heading">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-11">
                        <form class="form-horizontal" method="get" action="/admin/search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" id="searchinput"
                                       name="searchinput">
                                <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Go!</button>
                        </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-1">
                        <form>
                            <button href="/admin" class="btn btn-primary" type="submit">Terug</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @foreach($users as $user)
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 ">
                        <img src="/uploads/avatars/{{ $user->foto }}" class="img-responsive image-rounded">
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <h4>
                            <b>{{$user->voornaam}} {{$user->tussenvoegsel}} {{$user->achternaam}}</b>
                        </h4>

                        Nummer: {{$user->studentnummer}} <br>
                        Email: {{$user->email}}

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        @if ($user->trashed())
                            <div class="btn-group btn-toolbar-margin">
                                <form method="POST" action="/restore">
                                    <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                    <button id="prorestore" class="btn btn-primary" type="submit">Restore</button>
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="dropdown-group-middle" style="float: right; vertical-align:middle">
                            <form class="form-horizontal" action="{{ route('admin.assign') }}" method="POST">
                                <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                <select class="input-sm input-margin" name="bevoegdheid">
                                    <option @if ($user->bevoegdheid == 1) selected="selected" @else @endif value="1">
                                        Alumni
                                    </option>
                                    <option @if ($user->bevoegdheid == 2) selected="selected" @else @endif value="2">
                                        OpleidingsAdmin
                                    </option>
                                    <option @if ($user->bevoegdheid == 3) selected="selected" @else @endif value="3">
                                        SuperAdmin
                                    </option>
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary" type="submit">Rollen wijzigen</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

        @endforeach

        <div class="container" style="alignment: center">
            <div class="row">
                <div>
                    {{$users->appends(request()->input())->links()}}
                </div>
            </div>
        </div>


    </div>
    <script>
        $('#prorestore').on('click', function (e) {
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: "Weet je het zeker?",
                text: "Gebruiker wordt weer zichtbaar",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ja, herstel gebruiker!",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) form.submit();
            });
        });
    </script>




@stop


