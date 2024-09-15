<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = ['title', 'description', 'image_path', 'number_of_shiurs', 'speaker_id'];

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function shiurs()
    {
        return $this->hasMany(Shiur::class);
    }
}
