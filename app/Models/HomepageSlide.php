<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSlide extends Model {
    protected $table = 'homepage_slides';
    protected $fillable = ['image_url', 'title', 'subtitle'];
}
