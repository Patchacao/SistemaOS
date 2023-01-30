<?php

namespace App\Models;

use App\Models\ServiceOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObjectOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'Object_Number',
        'service_orders_id',
        'status',
        'last_status',
        'created_by',
        'details',
    ];

    public function ObjectOrder()
    {
        return $this->belongsTo(ServiceOrder::class);
    }
}
