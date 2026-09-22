<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'kitchen_status'
    ];

    // 🔗 LIÊN KẾT MÓN ĂN
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // 🔗 LIÊN KẾT HÓA ĐƠN
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
