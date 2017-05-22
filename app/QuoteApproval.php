<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * QuoteApproval
 * Model to represent an approval for a quotation
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App
 */
class QuoteApproval extends Model
{
    /**
     * Columns which can be mass-assigned
     * @var array Array of column names
     */
    protected $fillable = [
        'customer_id','order_id','token','completed'
    ];

    /**
     * Eloquent relationship linking quote approval to an order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Related Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Eloquent relationship linking Quote Approval to Customer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Related Customer
     */
    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Sets the Quote Approval to Completed
     * @return bool true
     */
    public function approve()
    {
        $this->completed = true;
        $this->save();

        return true;
    }

}
