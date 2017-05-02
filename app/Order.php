<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'address_id',
        'staff_id',
        'branch_id',
        'state_id',

    ];

//    /**
//     * Associating the order has many products relationship
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function products()
//    {
//        return $this->belongsToMany(Product::class);
//    }

    /**
     * Order has many order products
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * An order belongs to a customer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * An order belongs to a member of staff
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An order has many notes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * An order has a state
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Accessor for formatting Quotation Number based on ID
     * @return string
     */
    public function getQuoteNumberAttribute()
    {
        return sprintf('EST%03d',$this->id);
    }

    /**
     * Accessor for formatting Order Number based on ID
     * @return string
     */
    public function getOrderNumberAttribute()
    {
        return sprintf('ORD%03d',$this->id);
    }

    /**
     * Accessor for formatting Order Number based on ID
     * @return string
     */
    public function getInvoiceNumberAttribute()
    {
        return sprintf('INV%03d',$this->id);
    }

}
