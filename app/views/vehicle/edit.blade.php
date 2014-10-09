@extends('master')
@section('content')
<div class="center_form_wrapper">
    <p class="center_form_title">Edit vehicle type: {{ $vehicleData->type }}</p>
    {{ Form::model($vehicleData, [ 'method' => 'PATCH', 'route' => ['vehicle.update', $vehicleData->id] ]) }}

    {{ Form::label('type', 'Description') }}
    {{ Form::text('type', $vehicleData->type, ['placeholder' => 'Description'] ) }}
    <br/>
    {{ Form::label('price', 'Price') }}
    {{ Form::text('price', $vehicleData->price, ['placeholder' => 'Price'] ) }}
    <br/>
    {{ Form::label('employee_percentage', 'Employees profit') }}
    {{ Form::text('employee_percentage', $vehicleData->employee_percentage, ['placeholder' => 'Employees profit'] ) . '£' }}
    <br />
    <br />
    {{ Form::submit('Update') }}
    {{ Form::close() }}

</div>
@stop