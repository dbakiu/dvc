@extends('master')

@section('content')

<div class="invoice_page">
    <p>Invoice page.</p>
        <table class="flat_table">
            <thead>
              <th>Invoice nr.</th>
              <th>Company</th>
              <th>Date</th>
              <th>Total amount</th>
             </thead>
            <tbody>

    @if($invoiceList)
        @foreach($invoiceList as $invoice)
        <tr>
            <td> {{ $invoice['invoice_number'] }} </td>
             <td> {{ $invoice['bill_to'] }} </td>
             <td> {{ $invoice['date'] }} </td>
             <td> {{ $invoice['date'] }} </td>
        </tr>
        @endforeach
    @endif
    </tbody>
    </table>
</div>

@stop