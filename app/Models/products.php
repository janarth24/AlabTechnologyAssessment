<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
     protected $fillable = ['name', 'description', 'price', 'stock'];
     public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
