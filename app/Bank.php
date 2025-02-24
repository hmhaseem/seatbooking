<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Bank extends Model
{
    public $table = 'bank';
    protected $dates = [
        'created_at',
        'updated_at',

    ];
    protected $fillable = [
        'id',
        'name',
        'account_no',
        'branch',
        'remark',
        'created_at',
        'updated_at',

    ];

   

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
