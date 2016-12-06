@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel-default">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('/mail') }}"
                          id="delete">
                        <div class="form-group">
                            @foreach($users as $user)
                                <input type="hidden" name="users" value="{{$user->email}}">
                            @endforeach
                            <br>
                            <label for="title">Title:</label>
                            <input type="text" name="title" placeholder="Title"> <br>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <textarea class="form-control" rows="5" id="Email"></textarea> <br>
                            <input type="submit">
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop