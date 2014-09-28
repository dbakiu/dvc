@extends('master')
@section('content')
    {{ HTML::script('/js/employee-script.js') }}
    <div class="employee_profile">
        @if(isset($employeeData))

        @if($processedVehicles > 1)
            <?php $carsStr = 'cars'; ?>
        @else
            <?php $carsStr = 'car'; ?>
        @endif

        <p class="employee_profile_title">{{ 'Employee: ' . $employeeData->name }} </p>
        {{ 'In total, <b>' . $employeeData->name . '</b> has valeted <b>' . $processedVehicles  . ' ' . $carsStr . '</b>.' }}
        {{ 'Total sum earned: <b>£' . $totalSum . '</b>' }}
        @endif
        <hr/>

        <div class="employee_form_wrapper">
             <p class="center_form_title">Check earnings</p>

             @if(isset($rangeSum))
                @if($rangeValetedVehicles > 1)
                      <?php $carsStr = 'cars'; ?>
                 @else
                     <?php $carsStr = 'car'; ?>
                 @endif
                <p>{{'<b>' . $employeeData->name . '</b> valeted <b>' . $rangeValetedVehicles . ' ' . $carsStr . '</b> and has earned <b>£' . $rangeSum . '</b> for the period between ' . $startDate . ' and ' . $endDate }}.</p>
                <br/>
             @endif


            {{ Form::open([ 'route' => ['employee.check', $employeeData->id], 'method' => 'post' ] ) }}
                 {{ Form::label('startDate', 'Start date:') }}
                 {{ Form::text('startDate', null, ['id' => 'start_date']) }}
                 {{ Form::label('endDate', 'End date:') }}
                 {{ Form::text('endDate', null, ['id' => 'end_date']) }}
                 <br/> <br/>

                 {{ Form::submit('Check') }}
            {{ Form::close() }}


            </div>

    </div>



@stop