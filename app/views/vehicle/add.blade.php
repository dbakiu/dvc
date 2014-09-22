@extends('master')
@section('content')
{{ HTML::script('js/vehicle-script.js') }}

<div class="center_form_wrapper">
    <p class="center_form_title">Add new vehicle type</p>
    {{ Form::open( ['route' => 'vehicle.store'] ) }}

    {{ Form::text('type', null, ['placeholder' => 'Name'] ) }}
    <br />
    {{ Form::text('price', null, ['placeholder' => 'Price', 'id' => 'price']) }}
    <br />
    {{ Form::text('employee_percentage', null, ['placeholder' => 'Employees percentage', 'id' => 'employee_percentage']) . '%' }}
    <br />
    <br />

    {{ Form::submit('Add') }}
    {{ Form::close() }}

</div>
@stop