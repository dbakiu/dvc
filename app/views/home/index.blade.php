@extends('master')

@section('content')

<div class="home_page">
    <p class="center_form_title">homepage</p>
    <ul class="home_page_menu">
        <a href="{{ route('invoice.create') }}"><li>New invoice</li></a>
        <a href="{{ route('vehicle.index') }}"><li>Price list and vehicles</li></a>
        <a href="{{ route('employee.index') }}"><li>Employee management</li></a>
        <a href="{{ route('expense.index') }}"><li>Expenses</li></a>
        <a href="{{ route('balance.index') }}"><li>Balance sheets</li></a>
    </ul>
</div>

@stop