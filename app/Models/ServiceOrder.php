<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\ObjectOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceOrder extends Model
{
    use HasFactory;
   
    protected $fillable = [
            'OS_Number',
            'customer_id',
            'status',
            'last_status',
            'created_by',
            'details',
    ];

    public function ServiceOrder()
    {
        return $this->belongsTo(Customer::class);
    }

    public function ObjectOrders()
    {
        return $this->hasMany(ObjectOrder::class,'service_orders_id','id');
    }
}
