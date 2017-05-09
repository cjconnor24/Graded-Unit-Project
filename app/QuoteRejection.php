<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteRejection extends Model
{
    protected $fillable = ['order_id','reason'];
    /**
     * Rejection can have many orders
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
