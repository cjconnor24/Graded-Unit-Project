<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * Allowable mass assignment values
     * @var array
     */
    protected $fillable = [
        'address_id',
        'staff_id',
        'branch_id',
        'state_id',

    ];

    // ELOQUENT RELATIONSHIPS

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

    /**
     * An order has an address
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * An order can have many order approvals
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quoteApprovals()
    {
        return $this->hasMany(QuoteApproval::class);
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
     * An order belongs to a branch
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Each order has an order status
     * @return mixed
     */
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class,'status_id');
    }

    // ACCESSORS

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

    /**
     * Accessor to return the number of items on the order
     * @return mixed
     */
    public function getItemCountAttribute()
    {
        return $this->OrderProducts->count();
    }

    /**
     * Calculate the total order value based on the line total accessor on the OrderProduct Model
     * @return mixed
     */
    public function getOrderTotalAttribute()
    {
        return $this->OrderProducts->sum('line_total');
    }

}
