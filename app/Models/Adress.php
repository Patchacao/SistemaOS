<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'customer_id',
        'street',
        'adress_number',
        'CEP',
        'neighborhood',
        'city',
        'state',
        'created_by',


];

    public function Adresses()
    {
        return $this->belongsTo(Customer::class);
    }
}


