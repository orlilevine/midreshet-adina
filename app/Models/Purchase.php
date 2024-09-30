<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{

    use HasFactory;
    protected $fillable = [
        'user_id', 'shiur_id', 'series_id', 'amount', 'payment_method',
        'zelle_account_from', 'zelle_amount', 'zelle_date',
        'check_name', 'check_amount', 'check_date', 'coupon', 'coupon_code',
    ];

    public function shiur()
    {
        return $this->belongsTo(Shiur::class);
    }

    // If the purchase is also linked to a User, define the relationship with User here
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id');
    }

}
