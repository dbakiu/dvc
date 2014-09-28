@extends('master')

@section('content')

<div class="balance_page">
  <p class="center_form_title">Expenses</p>
        <table class="flat_table">
            <thead>
              <th>Invoice nr.</th>
              <th>View</th>
              <th>Download</th>
              <th>Company</th>
              <th>Date</th>
              <th>Total amount</th>
              <th>Delete<th>
             </thead>
            <tbody>

    {{--@if($invoiceList)
        @foreach($invoiceList as $invoice)
        <tr>
            <td> {{ $invoice['invoice_number'] }} </td>
            <td> {{ link_to_route('invoice.show', 'View', $invoice['id'] ) }} </td>
             <td> {{ link_to_route('invoice.download', 'Download', $invoice['id'] ) }} </td>
             <td> {{ $invoice['bill_to'] }} </td>
             <td> {{  date("d/m/Y", strtotime($invoice['date'])) }} </td>
             <td> {{ '£' . $invoice['total'] }} </td>
              <td>
                {{ Form::open([ 'route' => ['invoice.destroy', $invoice['id']], 'method' => 'delete' ] ) }}
                    <button type="submit" href="{{  route('invoice.destroy', 'Delete', $invoice['id'] ) }}" class="btn btn-danger btn-mini">Delete</button>
                {{ Form::close() }}
                </td>
             </tr>
        @endforeach
    @endif
    --}}
    </tbody>
    </table>
        <div class="invoice_pagination">
            @if(isset($invoiceList))
            {{ $invoiceList->links(); }}
            @endif
        </div>
</div>
@stop