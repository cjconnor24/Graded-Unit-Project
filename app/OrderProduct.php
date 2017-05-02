<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';
    protected $fillable = ['product_id','paper_id','size_id','qty'];

    public $timestamps = false;

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

    public function getLineTotalAttribute()
    {
        return ($this->qty * $this->product->price);
    }


}
