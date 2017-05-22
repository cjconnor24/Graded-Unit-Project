<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * QuoteRejection Model to represent an Quote Rejection
 *
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App
 */
class QuoteRejection extends Model
{
    /**
     * Columns which can be mass-assigned
     * @var array Array of column names
     */
    protected $fillable = ['order_id','reason'];

    /**
     * Eloquent relationship with an order
     * @return \Illuminate\Database\Eloquent\Relations\HasMany The related Order Object
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
