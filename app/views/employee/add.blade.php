@extends('master')
@section('content')
<div class="center_form_wrapper">
    <p class="center_form_title">Add new employee</p>
    {{ Form::open( ['route' => 'employee.store'] ) }}

    {{ Form::text('name', null, ['placeholder' => 'Name'] ) }} <br/>
    {{ Form::text('address', null, ['placeholder' => 'Address'] ) }} <br/>
    {{ Form::text('insuranceNumber', null, ['placeholder' => 'Insurance Number'] ) }} <br/>
    {{ Form::text('referenceNumber', null, ['placeholder' => 'Reference Number'] ) }} <br/>
    {{ Form::text('dob', null, ['placeholder' => 'Date of birth'] ) }} <br/> <br/>
    {{ Form::textarea('note', null, ['placeholder' => 'Note'] ) }}

    <br />
    <br />
    {{ Form::submit('Add') }}
    {{ Form::close() }}

</div>
@stop