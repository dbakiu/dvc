@extends('master')
@section('content')

    <div class="employee_profile">
        @if(isset($employeeData))
        <p class="employee_profile_title">{{ 'Employee: ' . $employeeData->name }} </p>
        {{ 'This employee has processed ' . $processedVehicles  . ' vehicles.'}}
        @endif
    </div>

@stop