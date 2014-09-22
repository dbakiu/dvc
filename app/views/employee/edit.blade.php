@extends('master')
@section('content')
<div class="center_form_wrapper">
    <p class="center_form_title">Edit employee: {{ $employeeData->name }}</p>
    {{ Form::model($employeeData, [ 'method' => 'PATCH', 'route' => ['employee.update', $employeeData->id] ]) }}
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', $employeeData->name, ['placeholder' => 'Name'] ) }}
    <br />
    <br />
    {{ Form::submit('Update') }}
    {{ Form::close() }}

</div>
@stop