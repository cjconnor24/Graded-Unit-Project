<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Payment Model to represent payment within application
 *
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App
 */
class Payment extends Model
{
    /**
     * Columns which are mass-assignable
     * @var array Array of Column Names
     */
    protected $fillable = ['customer_id',
        'order_id',
        'transaction_id',
        'amount',
        'payment_type',
        'braintree_response',
        'success'];
    // RELATIONSHIPS

    /**
     * Eloquent relationship with Order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Order related to payment
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Eloquent relationship with Customer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Customer related to payment
     */
    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

}
