<?php 
namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
   // use HasFactory;

    protected $fillable = [
        'bus_name',
        'origin',
        'destination',
        'departure_time',
        'arrival_time',
        'bus_type',
        // ...
    ];

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}