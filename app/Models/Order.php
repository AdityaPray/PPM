<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'phone',
        'note',
        'status',       // tambahkan ini
        'quantity',     // dan ini
        'total_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
