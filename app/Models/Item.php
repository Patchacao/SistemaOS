<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function linkable_objects()
    {

        return $this->belongsToMany('App\Models\LinkableObject');

    }

    public function services()
    {

        return $this->belongsToMany('App\Models\Service');

    }
}
