<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Bus;
use App\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    // Show a page to manage seats for a specific bus
    public function manage($busId)
    {
        $bus = Bus::with('seats')->findOrFail($busId);
        return view('admin.seats.manage', compact('bus'));
    }
    public function manageLayout($busId)
{
    $bus = Bus::with('seats')->findOrFail($busId);
    return view('admin.seats.layout', compact('bus'));
}
public function saveLayout(Request $request, $busId)
{
    $bus = Bus::findOrFail($busId);
    $seats = $request->input('seats'); // array of {id, x_position, y_position}

    foreach ($seats as $seatData) {
        Seat::where('id', $seatData['id'])
            ->where('bus_id', $bus->id)
            ->update([
                'x_position' => $seatData['x_position'],
                'y_position' => $seatData['y_position'],
            ]);
    }

    return response()->json(['status' => 'success']);
}
    // Store or update seats (depending on your approach)
    public function storeOrUpdate(Request $request, $busId)
    {
        $bus = Bus::findOrFail($busId);

        // Example: If you want to handle seat creation in bulk
        $seats = $request->input('seats'); 
        // seats might be an array of row_number, column_number, seat_label

        foreach ($seats as $seatData) {
            Seat::updateOrCreate(
                [
                    'bus_id' => $bus->id,
                    'row_number' => $seatData['row_number'],
                    'column_number' => $seatData['column_number'],
                ],
                [
                    'seat_label' => $seatData['seat_label'],
                    'status' => 'available',
                ]
            );
        }

        return response()->json(['status' => 'success']);
    }
}