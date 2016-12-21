@extends('layouts.app')

@section('content')


    <table class="table table-striped table-bordered">
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
@endsection