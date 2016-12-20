@extends('layouts.app')
@php($user = 'test@test.com')
@section('content')
    <div class="container">
        <div class="panel-default">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form enctype="multipart/form-data" class="form-horizontal" method="POST" action=""
                          id="delete">
                        <div class="form-group">

                                <input type="hidden" name="users" value="{{$user}}">

                            <br>
                            <label for="title">Title:</label>
                            <input type="text" name="title" placeholder="Title"> <br>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <textarea class="form-control" rows="5" name="email" id="email"></textarea> <br>
                            <input type="submit">
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


{{--@foreach($users as $user) {{$user->email}} @endforeach--}}