<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ObjectOrder;

class Repair extends Model
{
    use HasFactory;

    public function Service()
    {
        return $this->belongsTo(ObjectOrder::class);
    }

    
}
