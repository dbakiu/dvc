@extends('master')
@section('content')
<div class="center_form_wrapper">
    <p class="center_form_title">Add new vehicle type</p>
    {{ Form::open( ['route' => 'vehicle.store'] ) }}

    {{ Form::text('type', null, ['placeholder' => 'Name'] ) }}
    <br />
    {{ Form::text('price', null, ['placeholder' => 'Price']) }}
    <br />
    {{ Form::text('employee_percentage', null, ['placeholder' => 'Employees percentage']) }}
    <br />
    <br />
    {{ Form::submit('Add') }}
    {{ Form::close() }}

</div>
@stop