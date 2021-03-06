@extends('master')

@section('content')

<div class="invoice_page">
    <p class="center_form_title">Invoices</p>
        <table class="flat_table">
            <thead>
              <th>Invoice nr.</th>
              <th>View</th>
              <th>Download</th>
              <th>Employee</th>
              <th>Date</th>
              <th>Total amount</th>
              <th>Delete<th>
             </thead>
            <tbody>

    @if($invoiceList)
        @foreach($invoiceList as $invoice)
        <tr>
            <td> {{ $invoice['invoice_number'] }} </td>
            <td> {{ link_to_route('invoice.show', 'View', $invoice['id'] ) }} </td>
             <td> {{ link_to_route('invoice.download', 'Download', $invoice['id'] ) }} </td>

             <?php
               echo "<td>";
                    foreach($employeesList as $employee){
                        if($employee->id == $invoice->employee_fk)
                           echo $employee->name;
                    }
               echo "</td>";
             ?>

             <td> {{  date("d/m/Y", strtotime($invoice['date'])) }} </td>
             <td> {{ '£' . $invoice['total'] }} </td>
              <td>
                {{ Form::open([ 'route' => ['invoice.destroy', $invoice['id']], 'method' => 'delete' ] ) }}
                    <button type="submit" href="{{  route('invoice.destroy', 'Delete', $invoice['id'] ) }}"
                        class="btn btn-danger btn-mini"
                        onclick="return confirm('Are you sure you want to delete that item?');">
                        Delete
                        </button>
                {{ Form::close() }}
                </td>
             </tr>
        @endforeach
    @endif
    </tbody>
    </table>
        <div class="invoice_pagination">
            @if(isset($invoiceList))
            {{ $invoiceList->links(); }}
            @endif
        </div>
</div>

@stop