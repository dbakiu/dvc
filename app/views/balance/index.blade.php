@extends('master')
@section('content')

{{ HTML::script('js/balance-script.js') }}

<div class="balance_page">
    @if(isset($startDate))
        <p class="center_form_title">Balance for {{ $startDate }} to {{ $endDate }}</p>
    @else
            <p class="center_form_title">Total balance</p>
    @endif
      <div class="balance_wrapper">

        <a href="{{ route('invoice.index') }}">
            <div class="balance_in btn btn-primary">
                <span class="total_sum_in">IN:  £{{ $totalIncome }}</span>
            </div>
        </a>

        <a href="{{ route('expense.index') }}">
            <div class="balance_out btn btn-info">
                <span class="total_sum_out">OUT:  £{{ $totalExpenses }}</span>
            </div>
        </a>

        <div class="clear"></div>
        <hr/>
        @if( $totalBalance > 0 && $totalBalance > 100)
        <div class="balance_total btn btn-success">
            <span class="total_sum_balance">BALANCE:  £{{ $totalBalance }}</span>
        </div>

        @elseif( $totalBalance > 0 && $totalBalance < 100)
        <div class="balance_total btn btn-warning">
            <span class="total_sum_balance">BALANCE:  £{{ $totalBalance }}</span>
        </div>
        @else
        <div class="balance_total btn btn-danger">
            <span class="total_sum_balance">BALANCE:  £{{ $totalBalance }}</span>
        </div>
        @endif

        <div class="employee_form_wrapper">
         <p class="center_form_title">Check balance</p>
        {{ Form::open([ 'route' => ['balance.check'], 'method' => 'post' ] ) }}
            {{ Form::label('startDate', 'Start date:') }}
            {{ Form::text('startDate', null, ['id' => 'start_date']) }}
            {{ Form::label('endDate', 'End date:') }}
            {{ Form::text('endDate', null, ['id' => 'end_date']) }}
            <br/><br/>
            {{ Form::submit('Check') }}
        {{ Form::close() }}
        </div>


      </div>

</div>
@stop