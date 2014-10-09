@extends('master')
@section('content')
{{ HTML::script('js/vehicle-script.js') }}

<div class="center_form_wrapper">
    <p class="center_form_title">new vehicle description</p>
    {{ Form::open( ['route' => 'vehicle.store'] ) }}

    {{ Form::text('type', null, ['placeholder' => 'Name'] ) }}
    <br />
    £{{ Form::text('price', null, ['placeholder' => 'Price', 'id' => 'price']) }}
    <br />
    £{{ Form::text('employee_percentage', null, ['placeholder' => 'Employees profit', 'id' => 'employee_percentage']) }}
    <br />
    <br />

    {{ Form::submit('Add') }}
    {{ Form::close() }}

</div>
@stop