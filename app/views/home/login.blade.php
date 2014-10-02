@extends('master')

@section('content')

<div class="login_form_wrapper">
    @if( null !== Session::get('message'))
         <div class="alert alert-danger" role="alert">   {{  Session::pull('message') }} </div>
    @endif
    {{ Form::open( ['route' => 'sessions.store'] ) }}

    {{ Form::text('name', null, array('placeholder' => 'Username', 'id' => 'name' )) }}
    <br /><br />
    {{ Form::password('password', array('placeholder' => 'Password',  'id' => 'password')) }}
    <br /><br />
    {{ Form::submit('Log in') }}

    {{ Form::close() }}
</div>

@stop
