<?php

namespace App;

use App\Observers\LoanApplicationObserver;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class CustomerApplication extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable;

    public $table = 'customer_applications';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
     
        'description',
        'analyst_id',
        'cfo_id',
        'name',
        'nic',
        'email',
        'address',
        'phone',
        'address2',
        'city',
        'married_status',
        'loan_term',
        'nic_photo',
        'bank_id',
        'nic_back',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
        'status_id',
        'interest',
        'total_amount',
        'weekly_pay',
        'gender',
        'income_type',
        'income_amount',
        'expenses',
        'loan_purpose'


    ];
 

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
    public function analyst()
    {
        return $this->belongsTo(User::class, 'analyst_id');
    }

    public function cfo()
    {
        return $this->belongsTo(User::class, 'cfo_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function logs()
    {
        return $this->morphMany(AuditLog::class, 'subject');
    }
}
