@extends('...master')
@section('content')
    <div class="center_form_wrapper">
        <p class="center_form_title">SETUP ADMIN ACCOUNT</p>
    {{ Form::open(['route' => 'create.admin']) }}
    {{ Form::text('name', null, ['placeholder' => 'Name']) }}<br/>
    {{ Form::text('password', null, ['placeholder' => 'Password']) }}<br/><br/>
    {{ Form::submit() }}<br/>
    {{  Form::close() }}
    </div>
@stop