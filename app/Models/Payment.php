<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
