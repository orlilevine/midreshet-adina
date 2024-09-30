<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'messages';

    // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
