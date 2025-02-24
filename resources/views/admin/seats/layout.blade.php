@extends('layouts.admin')

@section('content')
<h1>Manage Seats for {{ $bus->bus_name }} (ID: {{ $bus->id }})</h1>

<div id="seat-canvas" style="width:800px; height:600px; position:relative; border:1px solid #ccc;">
    @foreach($bus->seats as $seat)
        <div class="seat-box" 
             data-id="{{ $seat->id }}"
             style="
                position:absolute;
                width:50px;
                height:50px;
                border:1px solid #999;
                background:#f7f7f7;
                cursor:move;
                line-height:50px;
                text-align:center;
                top: {{ $seat->y_position }}px;
                left: {{ $seat->x_position }}px;
             ">
             {{ $seat->seat_label }}
        </div>
    @endforeach
</div>

<button id="save-seats" class="btn btn-primary mt-3">Save Layout</button>
@endsection

@section('scripts')
<!-- jQuery + jQuery UI (for draggable) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- You can use a CDN or your own hosted jQuery UI. Here's a common CDN link: -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
$(function() {
    // 1) Make each seat draggable
    $('.seat-box').draggable({
        containment: '#seat-canvas', // to keep seats within the canvas
        stop: function(event, ui) {
            // Optionally do something each time a seat is dropped
            // e.g. console.log(ui.position);
        }
    });

    // 2) When the admin clicks "Save Layout", gather each seat’s new (x, y)
    $('#save-seats').on('click', function() {
        let seatPositions = [];

        $('.seat-box').each(function() {
            let seatId = $(this).data('id');
            let pos = $(this).position(); // { top: ..., left: ... }

            seatPositions.push({
                id: seatId,
                x_position: pos.left,
                y_position: pos.top
            });
        });

        // 3) Send to server via AJAX (update DB)
        $.ajax({
            url: '{{ route("admin.seats.saveLayout", $bus->id) }}', 
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                seat_positions: seatPositions
            },
            success: function(response) {
                alert('Seat layout saved!');
            },
            error: function(xhr) {
                console.log(xhr);
                alert('Something went wrong saving the layout.');
            }
        });
    });
});
</script>
@endsection