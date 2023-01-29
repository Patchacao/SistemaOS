<?php

namespace App\Models;

use App\Models\ServiceOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'last_name',
        'phone_number',
        'nickname',
        'whatsapp',
        'cpf',
        'created_by'
    ];

    public function ServiceOrders()
    {
        return $this->hasMany(ServiceOrder::class,'customer_id','id');
    }
}
