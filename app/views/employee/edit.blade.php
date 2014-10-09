@extends('master')
@section('content')
<div class="center_form_wrapper">
    <p class="center_form_title">Edit employee: {{ $employeeData->name }}</p>
    {{ Form::model($employeeData, [ 'method' => 'PATCH', 'route' => ['employee.update', $employeeData->id] ]) }}
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', $employeeData->name, ['placeholder' => 'Name'] ) }} <br/>

    {{ Form::label('address', 'Address') }}
    {{ Form::text('address', $employeeData->address, ['placeholder' => 'Address'] ) }} <br/>

    {{ Form::label('insuranceNumber', 'Name') }}
    {{ Form::text('insuranceNumber', $employeeData->insuranceNumber, ['placeholder' => 'Insurance Number'] ) }} <br/>

    {{ Form::label('referenceNumber', 'Reference Number') }}
    {{ Form::text('referenceNumber', $employeeData->referenceNumber, ['placeholder' => 'Reference Number'] ) }} <br/>

    {{ Form::label('dob', 'D.O.B.') }}
    {{ Form::text('dob', $employeeData->dob, ['placeholder' => 'Date of birth'] ) }} <br/>

    {{ Form::textarea('note', $employeeData->note, ['placeholder' => 'Note'] ) }}
    <br />
    <br />
    {{ Form::submit('Update') }}
    {{ Form::close() }}

</div>
@stop