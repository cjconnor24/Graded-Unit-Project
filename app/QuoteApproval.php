<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteApproval extends Model
{
    protected $fillable = [
        'customer_id','order_id','token','completed'
    ];

    /**
     * An order approval belongs to One Order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function approve()
    {
        $this->completed = true;
        $this->save();
    }

}
