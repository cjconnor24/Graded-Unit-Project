<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * OrderProduct Model used to represend order line item
 * @package App
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class OrderProduct extends Model
{
    /**
     * Table name to store Model
     * @var string
     */
    protected $table = 'order_product';

    /**
     * Columns which as mass-assignable
     * @var array Array of column names
     */
    protected $fillable = ['product_id','paper_id','size_id','qty','description'];

    /**
     * Disable timestamps
     * @var bool Disable timestamps
     */
    public $timestamps = false;

    /**
     * Eloquent relationship with Order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Order which OrderProduct belongs to
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Eloquent relationship with Product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Product related to OrderProduct
     */
    public function product(){
        return $this->belongsTo(Product::class);
    }

    /**
     * Eloquent relationship with Paper
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Paper related to OrderProduct
     */
    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    /**
     * Eloquent relationship with Size
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Size related to OrderProduct
     */
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    /**
     * Calculates the total or the line item by multiplying the Quantity by the Price of the Product
     * @return integer Line Total
     */
    public function getLineTotalAttribute()
    {
        return ($this->qty * $this->product->price);
    }

}
