@extends('master')
@section('content')
{{ HTML::script('js/invoice-script.js') }}

<div class="invoice_form_wrapper">
    <p class="center_form_title">New invoice</p>
    {{ Form::open(['route' => 'invoice.store']) }}
    {{ Form::text('date', null, ['placeholder' => 'Invoice date'] ) }}

    {{ Form::text('bill_to', null, ['placeholder' => 'Bill to'] ) }}

    {{ Form::text('admin_name', null, ['placeholder' => '#Name'] ) }}

    {{ Form::text('vat_number', null, ['placeholder' => 'Vat number'] ) }}
    <br />
    <hr />
    {{ Form::close() }}
    {{ Form::text('valeted_date', null, ['id' => 'valeted_date', 'placeholder' => 'Date']) }}
    {{ Form::text('quantity', null, ['id' => 'quantity', 'placeholder' => 'Quantity']) }}

    {{ Form::label('vehicle_fk', 'Vehicle type')  }}
    {{ Form::select('vehicle_fk', $vehiclesList, null, ['id' => 'vehicle_fk']  ) }}

    {{ Form::label('employee_fk', 'Employee')  }}
    {{ Form::select('employee_fk', $employeesList, null,  ['id' => 'employee_fk']  ) }}

    {{ Form::select('vehicles_pricelist', $vehiclesPricelist, null, ['id' => 'vehicles_pricelist', 'class' => 'hidden']  ) }}


    {{ Form::button('Add', ['id' => 'add_element']) }}

    <div class="invoice_elements_wrapper">
         <table class="flat_table flat_table_1">
            <thead>
                <th>QTY</th>
                <th>DESCRIPTION</th>
                <th>UNIT PRICE</th>
                <th>LINE TOTAL</th>
                <th>#</th>
            </thead>
             <tbody id="invoice_elements">

            </tbody>
        </table>
    </div>
    </div>
</div>

@stop