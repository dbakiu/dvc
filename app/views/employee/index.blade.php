@extends('master')

@section('content')

<div class="employees_page">
    <table class="flat_table">
        <thead>
        <th>Employee</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <tbody>

        @foreach ($employees as $employee)

        <tr>
            <td>
             {{  link_to_route('employee.show', $employee->name, $employee->id ) }}
            </td>

            <td>
             {{  link_to_route('employee.edit', 'Edit', $employee->id ) }}
            </td>

            <td>
                {{ Form::open([ 'route' => ['employee.destroy', $employee->id], 'method' => 'delete' ] ) }}
                    <button type="submit" href="{{  route('employee.destroy', 'Delete', $employee->id ) }}" class="btn btn-danger btn-mini">Delete</button>
                {{ Form::close() }}
            </td>

        </tr>

        @endforeach
        </tbody>


    </table>

</div>

@stop