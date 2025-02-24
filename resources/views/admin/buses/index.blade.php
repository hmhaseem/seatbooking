@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>All Buses</h1>
        <a href="{{ route('admin.buses.create') }}">Create New Bus</a>
        
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-LoanApplication">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bus Name</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buses as $bus)
                            <tr>
                                <td>{{ $bus->id }}</td>
                                <td>{{ $bus->bus_name }}</td>
                                <td>{{ $bus->origin }}</td>
                                <td>{{ $bus->destination }}</td>
                                <td>
                                    <a href="{{ route('admin.buses.edit', $bus->id) }}">Edit</a>
                                    <form action="{{ route('admin.buses.destroy', $bus->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                    <a href="{{ route('admin.seats.manage', $bus->id) }}">Manage Seats</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </table>
        </div>
    </div>

 
  
@endsection