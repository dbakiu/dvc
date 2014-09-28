@extends('...master')
@section('content')
<div class="center_form_wrapper">
    <p class="center_form_title">Add new employee</p>
    {{ Form::open( ['route' => 'expense.store'] ) }}

    {{ Form::text('name', null, ['placeholder' => 'Item name'] ) }}
    {{ Form::text('sum', null, ['placeholder' => 'Sum'] ) }}
    {{ Form::text('date', null, ['placeholder' => 'Date'] ) }}

    <br />
    <br />
    {{ Form::submit('Add') }}
    {{ Form::close() }}

</div>
@stop