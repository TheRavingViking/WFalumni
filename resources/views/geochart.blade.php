@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div style="height: 1080px; width: 1920px;">
            {!! Mapper::render () !!}
        </div>
    </div>




@endsection