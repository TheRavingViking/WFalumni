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

        <div class="panel-default">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form enctype="multipart/form-data" class="form-horizontal" method="POST" action=""
                          id="delete">
                        <div class="form-group">
                            <input type="hidden" name="users"
                                   value="@foreach($users as $user) {{$user->email}} @endforeach">
                            <label for="Onderwerp">Onderwerp:</label>
                            <input type="text" name="subject" placeholder="Onderwerp"> <br>
                            <label for="title">Title:</label>
                            <input type="text" name="title" placeholder="Titel"> <br>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <textarea class="form-control" rows="5" name="email" id="email"
                                      placeholder="Schrijf hier je bericht."></textarea> <br>
                            <input type="submit">
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


