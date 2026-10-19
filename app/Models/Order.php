<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
       protected $fillable = [
        'name', 'user_id', 'phone', 'address', 'comment', 'sum', 'status_id'
    ];

    use HasFactory;
    public function status()
    {
        return $this->belongsTo(status::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('quantity', 'price');
    }
    public function user()
    {
       return $this->belongsTo(User::class);
    }
}