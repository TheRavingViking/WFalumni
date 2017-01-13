@extends('layouts.app')

@section('content')

    <div class="container">
        @foreach ($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach

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
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Wachtwoord instellen</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="/setPass">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Wachtwoord</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirmpw" class="col-md-4 control-label">Wachtwoord bevestigen</label>
                                <div class="col-md-6">
                                    <input id="confirmpw" type="password" class="form-control" name="confirmpw" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Bevestig
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" name="auth" value="<?php echo $_GET['auth']; ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection