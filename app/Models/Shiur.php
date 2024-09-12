<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shiur extends Model
{
    protected $table = 'shiurs'; // Ensure this matches your table name

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

}
