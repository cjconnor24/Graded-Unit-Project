<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * Associating the order has many products relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * An order belongs to a customer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An order belongs to a member of staff
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff()
    {
        return $this->belongsTo(User::class);
    }

}
