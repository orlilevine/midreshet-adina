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
        'zoom_link',
        'zoom_id',
        'zoom_password',
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
