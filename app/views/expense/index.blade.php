@extends('master')

@section('content')

<div class="expense_page">
  <p class="center_form_title">Expenses</p>
        <table class="flat_table flat_table_1">
            <thead>
              <th>Expense nr.</th>
              <th>View</th>
              <th>Item</th>
              <th>Company</th>
              <th>Date</th>
              <th>Total amount</th>
              <th>Delete<th>
             </thead>

             <tbody>

        @if($expenseList)
         @foreach($expenseList as $expense)
         <tr>
             <td> {{ $expense->expense_number }} </td>
             <td> {{ link_to_route('expense.show', 'View', $expense->id ) }} </td>
              <td> {{ $expense->item }} </td>
              <td> {{ $expense->company_name }} </td>
              <td> {{  date("d/m/Y", strtotime($expense->date)) }} </td>
              <td> {{ '£' . $expense->sum }} </td>
               <td>
                 {{ Form::open([ 'route' => ['expense.destroy', $expense->id], 'method' => 'delete' ] ) }}
                     <button type="submit" href="{{  route('invoice.destroy', 'Delete', $expense->id ) }}" class="btn btn-danger btn-mini">Delete</button>
                 {{ Form::close() }}
                 </td>
              </tr>
         @endforeach
     @endif
     </tbody>
     </table>
         <div class="invoice_pagination">
             @if(isset($expenseList))
             {{ $expenseList->links(); }}
             @endif
         </div>
</div>
@stop