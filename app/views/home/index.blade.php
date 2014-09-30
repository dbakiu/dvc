@extends('master')

@section('content')

<div class="home_page">
    <p class="center_form_title">homepage</p>

    @if( null !== Session::get('message'))
         <div class="alert alert-success" role="alert">   {{  Session::pull('message') }} </div>

    @endif

    <ul class="home_page_menu">
        <a href="{{ route('invoice.create') }}"><li>
            <button class="btn btn-info btn-lg" type="button">
                New invoice
            </button>
        </li></a>

        <a href="{{ route('vehicle.index') }}"><li>
            <button class="btn btn-info btn-lg" type="button">
                Price list and vehicles
            </button>
        </li></a>
        <a href="{{ route('employee.index') }}"><li>
            <button class="btn btn-info btn-lg" type="button">
                 Employee management
            </button>
        </li></a>
        <a href="{{ route('expense.index') }}"><li>
            <button class="btn btn-info btn-lg" type="button">
                Expenses
            </button>
        </li></a>
        <a href="{{ route('balance.index') }}"><li>
            <button class="btn btn-info btn-lg" type="button">
                Balance
            </button>
        </li></a>
    </ul>

</div>

@stop