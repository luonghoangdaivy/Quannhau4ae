<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'is_active'
    ];

    // 🔗 Danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 🔗 Các món trong order (CHO BẾP + ĐƠN HÀNG)
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}
