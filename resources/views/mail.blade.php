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
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Mail Iedereen:</h3></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row col-md-10">
                            <div class="col-md-10 col-md-offset-2">
                                <form enctype="multipart/form-data" class="form-horizontal" method="POST" action=""
                                      id="delete">   {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="hidden" name="users"
                                               value="@foreach($users as $user) {{$user->email}} @endforeach">

                                        <label for="onderwerp" class="col-md-4 control-label">Onderwerp</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="subject"
                                                   placeholder="Onderwerp"><br>
                                        </div>
                                        <label for="onderwerp" class="col-md-4 control-label">titel</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="title" placeholder="Titel">
                                        </div>

                                    </div>
                                    <div class="form-group">

                            <textarea class="form-control" rows="10" name="email" id="email"
                                      placeholder="Schrijf hier je bericht."></textarea> <br>
                                        <input id="sendmail" class="btn btn-primary" type="submit">
                                    </div>
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#sendmail').on('click', function (e) {
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: "Weet je het zeker?",
                text: "Deze actie is permanent!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ffcf00",
                confirmButtonText: "Ja, mail versturen!",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) form.submit();
            });
        });
    </script>
@stop


