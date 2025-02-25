@extends('layouts.admin') <!-- or wherever your admin layout is -->

@section('content')
    <h1>Manage Seats for {{ $bus->bus_name }} (ID: {{ $bus->id }})</h1>

    <!-- 
        This container acts like a "canvas" for seat boxes.
        position: relative; so absolutely positioned seats can be placed within it.
    -->
    <div id="seat-canvas" 
         style="width: 800px; height: 600px; position: relative; border: 1px solid #ccc; margin-bottom: 15px;">

        <!-- Loop over seats from the controller. Each seat is an absolutely positioned DIV. -->
        @foreach($bus->seats as $seat)
            <div class="seat-box" 
                 data-seat-id="{{ $seat->id }}"
                 style="
                    position: absolute;
                    width: 50px;
                    height: 50px;
                    border: 1px solid #999;
                    background: #f7f7f7;
                    cursor: move;
                    line-height: 50px;
                    text-align: center;
                    top: {{ $seat->y_position }}px;
                    left: {{ $seat->x_position }}px;
                ">

                {{ $seat->seat_label }}
            </div>
        @endforeach
    </div>

    <button id="save-seats" class="btn btn-primary">
        Save Layout
    </button>
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI for draggable -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <script>
        $(function() {
            // 1) Make each .seat-box draggable within #seat-canvas
            $('.seat-box').draggable({
                containment: '#seat-canvas'
            });

            // 2) On "Save Layout" click, gather positions and send via AJAX
            $('#save-seats').on('click', function() {
                let seatUpdates = [];

                // For each seat div, store the seat's ID and final (x, y) positions
                $('.seat-box').each(function() {
                    let seatId = $(this).data('seat-id');
                    let position = $(this).position(); // { top: #, left: # }

                    seatUpdates.push({
                        id: seatId,
                        x_position: position.left,
                        y_position: position.top
                    });
                });

                // 3) Send to server to persist changes in the DB
                $.ajax({
                    url: '{{ route("admin.seats.saveLayout", $bus->id) }}', 
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        seats: seatUpdates
                    },
                    success: function(response) {
                        alert('Layout saved successfully!');
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Error saving seat layout.');
                    }
                });
            });
        });
    </script>
@endsection