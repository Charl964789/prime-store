<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_method',
          'amount_paid',
          'balance',
       'payment_status',



    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}