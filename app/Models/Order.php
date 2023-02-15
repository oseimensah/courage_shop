<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'uuid',
        'code',
        'link',
        'amount',
        'status', 'order_date', 'deleted_at', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function order_products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('price', 'quantity');
    }

    public function getAmountWithCurrencyAttribute()
    {
        return "$ " . $this->amount;
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
