<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_name',
        'qty',
        'unitprice',
        'image',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($product) {
            // Generate a unique product ID
            $product->product_id = 'PROD-' . strtoupper(Str::random(8));
        });
    }
}
