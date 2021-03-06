<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * OrderStatus Model used to represent Order Status
 *
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App
 */
class OrderStatus extends Model
{
    /**
     * Eloquent relationship with Orders
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of Orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Accessor to return a colour related to a particular status
     * @return string Bootstrap colour class name
     */
    public function getColourAttribute()
    {
        $colour = [
            1=>'danger',
            2=>'info',
            3=>'warning',
            4=>'info',
            5=>'info',
            6=>'success',
            7=>'success',
        ];

        return $colour[$this->id];

    }
}
