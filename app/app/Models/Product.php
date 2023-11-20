<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'short_des',
        'price',
        'discount',
        'discount_price',
        'image',
        'stock',
        'star',
        'remark',
        'logn_des',
        'color',
        'size',
        'brand_id',
        'category_id',
    ];

    public function brand():BelongsTo{
        return $this->belongsTo(Brand::class);
    }
    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }
}
