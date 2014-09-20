@extends('master')

@section('content')

<div class="login_form_wrapper">
    {{ Form::open( ['route' => 'sessions.store'] ) }}

    {{ Form::text('name', null, array('placeholder' => 'Username', 'id' => 'name' )) }}
    <br /><br />
    {{ Form::password('password', array('placeholder' => 'Password',  'id' => 'password')) }}
    <br /><br />
    {{ Form::submit('Log in') }}

    {{ Form::close() }}
</div>

@stop