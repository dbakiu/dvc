@extends('master')
@section('content')
<div class="center_form_wrapper">
    <p class="center_form_title">Edit vehicle type: {{ $vehicleData->type }}</p>
    {{ Form::model($vehicleData, [ 'method' => 'PATCH', 'route' => ['vehicle.update', $vehicleData->id] ]) }}

    {{ Form::label('type', 'Type') }}
    {{ Form::text('type', $vehicleData->type, ['placeholder' => 'Type'] ) }}

    {{ Form::label('price', 'Type') }}
    {{ Form::text('price', $vehicleData->price, ['placeholder' => 'Price'] ) }}
    
    {{ Form::label('employee_percentage', 'Employees percentage') }}
    {{ Form::text('employee_percentage', $vehicleData->employee_percentage, ['placeholder' => 'Employees percentage'] ) }}

    <br />
    <br />
    {{ Form::submit('Update') }}
    {{ Form::close() }}

</div>
@stop