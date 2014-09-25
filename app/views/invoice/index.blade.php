@extends('master')

@section('content')

<div class="invoice_page">
    <p>Invoice page.</p>

    @if($invoiceList)
        @foreach($invoiceList as $invoice)
            {{ $invoice['id'] . ' '  }}
            {{ $invoice['bill_to'] }}
            <br/>
        @endforeach
    @endif
</div>

@stop