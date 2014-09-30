@extends('master')

@section('content')

<div class="vehicle_page">
    <p class="center_form_title">Vehicle pricelist</p>
    <table class="flat_table">
        <thead>
        <th>Vehicle type</th>
        <th>Price</th>
        <th>Employee's percentage</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <tbody>

        @foreach ($vehicles as $vehicle)

        <tr>
            <td>
             {{ $vehicle->type }}
            </td>

            <td>
             {{ '£' . $vehicle->price }}
            </td>

            <td>
             {{ $vehicle->employee_percentage . '%'}}
            </td>

            <td>
             {{  link_to_route('vehicle.edit', 'Edit', $vehicle->id ) }}
            </td>

            <td>
                {{ Form::open([ 'route' => ['vehicle.destroy', $vehicle->id], 'method' => 'delete' ] ) }}
                    <button type="submit" href="{{  route('vehicle.destroy', 'Delete', $vehicle->id ) }}"
                        class="btn btn-danger btn-mini"
                        onclick="return confirm('Are you sure you want to delete that item?');">Delete
                    </button>
                {{ Form::close() }}
            </td>

        </tr>

        @endforeach
        </tbody>


    </table>

</div>

@stop