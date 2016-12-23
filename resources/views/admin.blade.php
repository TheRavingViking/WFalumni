@extends('layouts.app')

@section('content')

<div class="container col-xs-12 col-sm-12 col-md-1 col-lg-10 col-md-offset-1" style="background-color:#f7fcff;
border-bottom-left-radius: 7px; border-bottom-right-radius: 7px;
border-top-left-radius: 7px; border-top-right-radius: 7px;
-webkit-box-shadow: 0px 10px 30px -1px rgba(0,0,0,0.20);
-moz-box-shadow: 0px 10px 30px -1px rgba(0,0,0,0.20);
box-shadow: 0px 10px 30px -1px rgba(0,0,0,0.20);">
    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Voornaam</td>
            <td>Achternaam</td>
            <td>Studentnummer</td>
            <td>Email</td>
            <td>Alumni</td>
            <td>OpleidingsAdmin</td>
            <td>SuperAdmin</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
               {{--{{ dd($users) }}--}}
                <form action="{{ route('admin.assign') }}" method="POST">
                    {{--{{ method_field('PATCH') }}--}}
                <td>{{ $user->id }}</td><input type="hidden" name="id" value="{{ $user->id }}"></td>
                <td>{{ $user->voornaam }}</td>
                <td>{{ $user->achternaam }}</td>
                <td>{{ $user->studentnummer }}</td>
                <td>{{ $user->email }}
                <td><input type="radio" {{ $user->bevoegdheid === 1 ? 'checked' : '' }} name="bevoegdheid" value="1"></td>
                <td><input type="radio" {{ $user->bevoegdheid === 2 ? 'checked' : '' }} name="bevoegdheid" value="2"></td>
                <td><input type="radio" {{ $user->bevoegdheid === 3 ? 'checked' : '' }} name="bevoegdheid" value="3"></td>
            {{ csrf_field() }}
                <td><button type="submit">Rollen wijzigen</button></td>
            </form>
        @endforeach
        </tbody>
    </table>
</div>
@endsection