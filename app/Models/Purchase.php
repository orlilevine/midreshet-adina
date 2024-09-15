<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function shiur()
    {
        return $this->belongsTo(Shiur::class);
    }

    // If the purchase is also linked to a User, define the relationship with User here
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
