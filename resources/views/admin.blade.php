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
                <form action="{{ route('admin.assign') }}" method="post">
                <td>{{ $user->id }}</td>
                <td>{{ $user->voornaam }}</td>
                <td>{{ $user->achternaam }}</td>
                <td>{{ $user->studentnummer }}</td>
                <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                <td><input type="checkbox"  name="alumnus"></td>
                <td><input type="checkbox"  name="opleidingsadmin"></td>
                <td><input type="checkbox"  name="superadmin"></td>

                    {{-- Vervangt bovenstaande (hasRole -> method error)                - Laurens--}}
                    {{--<td><input type="checkbox" {{ $user->hasRole('1') ? 'checked' : '' }} name="alumnus"></td>--}}
                    {{--<td><input type="checkbox" {{ $user->hasRole('2') ? 'checked' : '' }} name="opleidingsadmin"></td>--}}
                    {{--<td><input type="checkbox" {{ $user->hasRole('3') ? 'checked' : '' }} name="superadmin"></td>--}}

            {{ csrf_field() }}
                <td><button type="submit">Rollen wijzigen</button></td>
            </form>
        @endforeach
        </tbody>
@endsection