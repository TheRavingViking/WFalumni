@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="/uploads/avatars/{{ $user->foto }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                        <h2>{{ $user->voornaam }} Profiel</h2>
                    </div>
                    <div class="panel-body">
                        body inhoud ->form?
                    </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
