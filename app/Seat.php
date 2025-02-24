<?php 

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    //use HasFactory;

    protected $fillable = [
        'bus_id',
        'seat_label',
        'row_number',
        'column_number',
        'status',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}