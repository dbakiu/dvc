@extends('master')

@section('content')

<div class="expense_view">
    <div class="expense_description">
        <p>Expense nr. <b>{{ $expenseData->expense_number }}</b></p>
        <p>Company: <b>{{ $expenseData->company_name }}</b></p>
        <p>Item: <b>{{ $expenseData->item }}</b></p>
        <p>Date: <b>{{ date('d/m/Y', strtotime($expenseData->date)) }}</b></p>
        <p>Sum: <b>£{{ $expenseData->sum }}</b></p>
    </div>
</div>
@stop
