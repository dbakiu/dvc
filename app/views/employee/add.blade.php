@extends('master')
@section('content')
<div class="center_form_wrapper">
    <p class="center_form_title">Add new employee</p>
    {{ Form::open( ['route' => 'employee.store'] ) }}

    {{ Form::text('name', null, ['placeholder' => 'Name'] ) }}
    <br />
    <br />
    {{ Form::submit('Add') }}
    {{ Form::close() }}

</div>
@stop