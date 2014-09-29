@extends('master')
@section('content')
{{ HTML::script('js/expense-script.js') }}

<div class="expense_form_wrapper">

        <p class="center_form_title">Expense number: {{ $expenseNumber }}</p>
    {{ Form::open( ['route' => 'expense.store'] ) }}
    <div class="expense_info">
    <span class="invoice_left">
        {{ Form::label('name', 'Item name') }}
        <br/>
        {{ Form::label('sum', 'Total sum') }}
        <br/>
        {{ Form::label('date', 'Date') }}
    </span>

    <span class="invoice_right">
        {{ Form::text('item', null, ['placeholder' => 'Item name', 'class' => 'long_input'] ) }}
        <br/>
        {{ Form::text('sum', null, ['placeholder' => 'Sum'] ) }}
        <br/>
        {{ Form::text('date', null, ['placeholder' => 'Date'] ) }}
        <br/>
    </span>
    </div>
    <div class="clear"></div>
    <br />
    <br />
    {{ Form::submit('Add') }}
    {{ Form::close() }}

</div>
@stop