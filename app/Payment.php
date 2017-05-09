<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['customer_id',
        'order_id',
        'transaction_id',
        'amount',
        'braintree_response',
        'success'];
    // RELATIONSHIPS

    /**
     * Payment belongs to an orders
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Payment belongs to a customer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

}
