@extends('master')
@section('content')

{{ HTML::script('/js/employee-script.js') }}
<div class="center_form_wrapper">
        @if($startDate != '1970-01-01')
          <p class="center_form_title">Wages earned from {{ $startDate }} to {{ $endDate }}</p>
        @else
          <p class="center_form_title">Total wages earned</p>
        @endif
         <table class="flat_table">
            <thead>
            <th>Employee</th>
            <th>Wage</th>
            </thead>
            <tbody>
            @foreach ($employeeWages as $employee => $wage)
            <tr>
                <td>
                    {{ $employee }}
                </td>

                <td>
                    £{{ $wage }}
                </td>
            </tr>
            @endforeach
            </tbody>
         </table>


    {{ Form::open([ 'route' => ['wages.check'], 'method' => 'post' ] ) }}
         {{ Form::label('startDate', 'Start date:') }}
         {{ Form::text('startDate', null, ['id' => 'start_date']) }}
         {{ Form::label('endDate', 'End date:') }}
         {{ Form::text('endDate', null, ['id' => 'end_date']) }}
         <br/> <br/>
         {{ Form::submit('Check') }}
    {{ Form::close() }}
</div>

@stop