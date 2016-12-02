@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="panel panel-default" style="padding: 1em">
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <img src="/uploads/avatars/{{ $user->foto }}" class="img-responsive" style="min-width: 100px; float:left; border-radius:50%; margin-right:25px;">
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <form enctype="multipart/form-data" action="{{ url('/profiel') }}" method="post">
                            <label>Update profiel foto</label>
                            <input type="file" name="avatar">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
                            <input type="submit" class="pull-leftbtn btn-sm btn-primary"><br>
                        </form>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2>{{ $user->voornaam }} {{ $user->achternaam }} Profiel</h2>
                    </div>
                <div>
                    <br><br><br><br><br><br><br>
                    <h4>geslacht</h4><h5>{{ $user->geslacht }}</h5><br>
                    <h4>email</h4><h5>{{ $user->email }}</h5><br>
                    <h4>nationaliteit</h4><h5>{{ $user->nationaliteit }}</h5><br>
                    <h4>geboorteland</h4><h5>{{ $user->geboorteland }}</h5><br>
                    <h4>geboorteprovincie</h4><h5>{{ $user->geboorteprovincie }}</h5><br>
                    <h4>geboorteplaats</h4><h5>{{ $user->geboorteplaats }}</h5><br>
                    <h4>geboortedatum</h4><h5>{{ $user->geboortedatum }}</h5><br>
                    <h4>titel</h4><h5>{{ $user->titel }}</h5><br>
                    <h4>burgerlijke_staat</h4><h5>{{ $user->burgerlijke_staat }}</h5><br>
                    <h4>heeft_kinderen</h4><h5>{{ $user->heeft_kinderen }}</h5><br>
                    <h4>jaarinkomen</h4><h5>{{ $user->jaarinkomen }}</h5><br>
                    <h4>post_adres</h4><h5>{{ $user->post_adres }}</h5><br>
                    <h4>studentnummer</h4><h5>{{ $user->studentnummer }}</h5><br>
                    <h4>telefoonnummer</h4><h5>{{ $user->telefoonnummer }}</h5><br>
                    <h4>facebook</h4><h5>{{ $user->facebook }}</h5><br>
                    <h4>linkedin</h4><h5>{{ $user->linkedin }}</h5><br>
                    <h4>twitter</h4><h5>{{ $user->twitter }}</h5><br>
                    <h4>website</h4><h5>{{ $user->website }}</h5><br>

                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-primary" href="editprofiel">edit profiel</a>
                </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Wijzig
                            </button>
                        </div>
                    </div>
    {{--{!!  Form::open(['method'=>'DELETE','action'=>['UserController@destroy', $user->id]]) !!}--}}
    {{--<div class="form-group"><div class="col-md-6 col-md-offset-4">--}}
            {{--{!! Form::submit('Delete Users',['class'=>'btn btn-danger']) !!}--}}
            {{--{!! Form::close() !!}--}}
        {{--</div>--}}
@endsection
