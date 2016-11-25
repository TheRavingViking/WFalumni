@extends('layouts.app')
/**
 * Created by PhpStorm.
 * User: Freddy
 * Date: 25-11-2016
 * Time: 13:07
 */

@section('content')


    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Voornaam</td>
            <td>Achternaam</td>
            <td>Studentnummer</td>
            <td>Email</td>
        </tr>
        </thead>
        <tbody>
        @foreach($user as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->voornaam }}</td>
                <td>{{ $value->achternaam }}</td>
                <td>{{ $value->studentnummer }}</td>
                <td>{{ $value->email }}</td>
        @endforeach
        </tbody>
@endsection