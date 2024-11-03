<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shiur extends Model
{
    protected $table = 'shiurs'; // Ensure this matches your table name
    protected $casts = [
        'shiur_date' => 'datetime',
    ];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }


    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function speaker()
    {
        return $this->belongsTo(User::class, 'speaker_id');
    }


}
