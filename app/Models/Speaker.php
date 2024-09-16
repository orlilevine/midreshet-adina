<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    protected $fillable = ['salutation', 'first_name', 'last_name', 'bio', 'image_path'];

    // Add accessor for full_name
    public function getFullNameAttribute()
    {
        return trim("{$this->salutation} {$this->first_name} {$this->last_name}");
    }
}
