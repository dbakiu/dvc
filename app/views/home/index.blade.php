@extends('master')

@section('content')

<div class="homepage">
    <p>Welcome.</p>

    {{ Form::open( ['route' => 'logout', 'method' => 'get' ] ) }}
    {{ Form::submit('Sign out') }}
    {{ Form::close() }}

</div>

@stop