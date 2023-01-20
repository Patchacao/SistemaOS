<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
