<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    /**
     * Order status has many related orders
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

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
