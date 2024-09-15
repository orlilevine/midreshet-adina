<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    public function series()
    {
        return $this->hasMany(Series::class);
    }
}

