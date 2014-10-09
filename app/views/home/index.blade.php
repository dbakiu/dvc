@extends('master')

@section('content')

<div class="home_page">
    <p class="center_form_title">homepage</p>

    @if( null !== Session::get('message'))
         <div class="alert alert-success" role="alert">   {{  Session::pull('message') }} </div>

    @endif

    <ul class="nav nav-pills nav-stacked span2">

        <a href="{{ route('invoice.create') }}"><li>
            <button class="btn btn-info btn-lg btn-block" type="button">
                New invoice
            </button>
        </li></a>

        <a href="{{ route('vehicle.index') }}"><li>
            <button class="btn btn-info btn-lg btn-block" type="button">
               Pricelist
            </button>
        </li></a>

        <a href="{{ route('employee.index') }}"><li>
            <button class="btn btn-info btn-lg btn-block" type="button">
                 Employee management
            </button>
        </li></a>
        <a href="{{ route('wages') }}"><li>
            <button class="btn btn-info btn-lg btn-block" type="button">
                Wages
            </button>
        </li></a>
        <a href="{{ route('expense.index') }}"><li>
            <button class="btn btn-info btn-lg btn-block" type="button">
                Expenses
            </button>
        </li></a>
        <a href="{{ route('balance.index') }}"><li>
            <button class="btn btn-info btn-lg btn-block" type="button">
                Balance
            </button>
        </li></a>
    </ul>

</div>

@stop