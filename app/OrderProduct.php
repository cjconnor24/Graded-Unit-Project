<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }


}
