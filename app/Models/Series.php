<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'speaker_id',
        'price',
        'daily_link',
        'zoom_link',
        'zoom_password',
        'zoom_id',
        'starting_time',
        'shiur_date_1',
        'shiur_date_2',
        'shiur_date_3',
        'shiur_date_4',
        'shiur_date_5',
        'shiur_date_6',
        'shiur_date_7',
        'shiur_date_8',
    ];
    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function shiurs()
    {
        return $this->hasMany(Shiur::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'series_id');
    }

}
