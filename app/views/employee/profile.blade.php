@extends('master')
@section('content')

    <div class="employee_profile">
        @if(isset($employeeData))
        <p class="employee_profile_title">{{ 'Employee: ' . $employeeData->name }} </p>
        @endif
    </div>

@stop