<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ObjectOrder;

class Service extends Model
{
    use HasFactory;

    public function items()
    {

        return $this->belongsToMany(ObjectOrder::class);

    }
}
