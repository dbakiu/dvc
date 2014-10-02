@extends('master')
@section('content')
{{ HTML::script('js/invoice-script.js') }}



<div class="invoice_form_wrapper">
    @if( null !== Session::get('message'))
         <div class="alert alert-danger" role="alert">   {{  Session::pull('message') }} </div>
    @endif

    <p class="center_form_title">Invoice number: {{ $invoiceNumber }}</p>
    {{ Form::open(['route' => 'invoice.store']) }}
    <div class="invoice_info">
    <span class="invoice_left">
    {{ Form::label('bill_to',  'Company name' ) }} <br/>
    {{ Form::label('date',  'Invoice date' ) }} <br/>
    {{ Form::label('employee_fk', 'Employee')  }} <br/>
    </span>

    <span class="invoice_right">
    {{ Form::text('bill_to', null, ['placeholder' => 'Bill to'] ) }}
    <br/>
    {{ Form::text('date', null, ['placeholder' => 'Invoice date', 'id' => 'date'] ) }}
    <br/>
    {{ Form::select('employee_fk', $employeesList, null,  ['id' => 'employee_fk']  ) }}
    </span>
    </div>
    <div class="clear"></div>
    <hr />

    <div class="invoice_info">
    <span class="invoice_left">
    {{ Form::label('valeted_date', 'Valeted on')  }}<br/>
    {{ Form::label('quantity', 'Quantity')  }}<br/>
    {{ Form::label('vehicle_fk', 'Vehicle type')  }}<br/>
    </span>

    <span class="invoice_right">
    {{ Form::text('valeted_date', null, ['id' => 'valeted_date', 'placeholder' => 'Date']) }} <br/>
    {{ Form::text('quantity', null, ['id' => 'quantity', 'placeholder' => 'Quantity']) }} <br/>
    {{ Form::select('vehicle_fk', $vehiclesList, null, ['id' => 'vehicle_fk']  ) }} <br/>
    {{ Form::select('vehicles_pricelist', $vehiclesPricelist, null, ['id' => 'vehicles_pricelist', 'class' => 'hidden']  ) }}
    </span>
    <div class="clear"></div>
    {{ Form::button('Add', ['id' => 'add_element', 'class' => 'center_button']) }}

    </div>

    <div class="clear"></div>

    <div class="invoice_elements_wrapper" id="invoice_elements_wrapper">
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
        <div class="invoice_totals">
             <label for="subtotal">Subtotal: £</label>
             <span id="subtotal"></span>
             <br/>
             <label for="vat">VAT: 20%</label>
             <span id="vat"></span>
             <br/>
             <label for="total_sum">Total: £</label>
             <span id="total_sum"></span>
             <br/>
        </div>
        {{ Form::submit('Store invoice', ['class' => 'center_button'])  }}
    </div>

      {{ Form::text('elements_list', null, ['id' => 'elements_list', 'class' => 'hidden']) }}

      {{ Form::text('vat_hidden', '20', ['id' => 'vat_hidden', 'class' => 'hidden']) }}


    </div>

    {{ Form::close() }}
</div>

@stop