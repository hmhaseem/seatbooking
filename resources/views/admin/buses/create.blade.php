@extends('layouts.admin')

@section('content')
    <h1>{{ isset($bus) ? 'Edit Bus' : 'Create Bus' }}</h1>

    <form 
        action="{{ isset($bus) 
                    ? route('admin.buses.update', $bus->id) 
                    : route('admin.buses.store') 
                 }}" 
        method="POST"
    >
        @csrf
        @if(isset($bus))
            @method('PUT')
        @endif

        <div>
            <label>Bus Name</label>
            <input type="text" name="bus_name" value="{{ $bus->bus_name ?? old('bus_name') }}" required>
        </div>

        <div>
            <label>Origin</label>
            <input type="text" name="origin" value="{{ $bus->origin ?? old('origin') }}" required>
        </div>

        <div>
            <label>Destination</label>
            <input type="text" name="destination" value="{{ $bus->destination ?? old('destination') }}" required>
        </div>

        <div>
            <label>Departure Time</label>
            <input type="datetime-local" name="departure_time"
                value="{{ isset($bus) ? \Carbon\Carbon::parse($bus->departure_time)->format('Y-m-d\TH:i') : old('departure_time') }}"
                required>
        </div>

        <div>
            <label>Arrival Time</label>
            <input type="datetime-local" name="arrival_time"
                value="{{ isset($bus) ? \Carbon\Carbon::parse($bus->arrival_time)->format('Y-m-d\TH:i') : old('arrival_time') }}"
                required>
        </div>

        <button type="submit">{{ isset($bus) ? 'Update' : 'Create' }}</button>
    </form>
@endsection