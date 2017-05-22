<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Order Model to represent Order in system
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App
 */
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

    /**
     * Eloquent relationship with OrderProducts
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of OrderProducts related to Order
     */
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * Eloquent relationship with Customer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Customer Order Belongs to
     */
    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Eloquent relationship with Address
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Address Order belongs to
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Eloquent relationship with quoteApprovals
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of the Order Approvals
     */
    public function quoteApprovals()
    {
        return $this->hasMany(QuoteApproval::class);
    }

    /**
     * Eloquent relationship with Rejection
     * @return \Illuminate\Database\Eloquent\Relations\HasOne Rejection related to Order
     */
    public function rejection()
    {
        return $this->hasOne(QuoteRejection::class);
    }

    /**
     * Eloquent relationship with Staff User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Staff User related to Order
     */
    public function staff()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Eloquent relationship with with Notes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of Notes related to Order
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Eloquent relationship with State
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo State of the Order
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Eloquent relationship with Branch
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Branch Order belongs to
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Eloquent relationship with Payments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of Payments related to Order
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Eloquent relationship with Order Status
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Status of the Order
     */
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class,'status_id');
    }

    /**
     * Checks to see if the current state of the Order == Quote
     * @return bool true if quote
     */
    public function isQuote()
    {
        if($this->state->name=='quote'){
            return true;
        }
    }

    /**
     * Add note to order
     * @param string $content Content of the note
     * @param User $user The user who created the note
     * @return bool Indicated whether adding note was successful or not
     */
    public function addNote($content, $user)
    {
        $note = new Note;
        $note->content = $content;
        $note->user_id = $user;

        if($this->notes()->save($note)){
            return true;
        } else {
            return false;
        }
    }


    /**
     * Accessor for formatting Quote Number based on ID
     * @return string Formatted Quote Number String
     */
    public function getQuoteNumberAttribute()
    {
        return sprintf('EST%03d',$this->id);
    }

    /**
     * Accessor for formatting Order Number based on ID
     * @return string Formatted Order Number String
     */
    public function getOrderNumberAttribute()
    {
        return sprintf('ORD%03d',$this->id);
    }

    /**
     * Accessor for formatting Order Number based on ID
     * @return string Formatted Invoice Number String
     */
    public function getInvoiceNumberAttribute()
    {
        return sprintf('INV%03d',$this->id);
    }

    /**
     * Accessor to return the number of items on the order
     * @return int The number of items on the order
     */
    public function getItemCountAttribute()
    {
        return $this->OrderProducts->count();
    }

    /**
     * Calculate the total order value based on the line total accessor on the OrderProduct Model
     * @return decimal The complete value of the order
     */
    public function getOrderTotalAttribute()
    {
        return $this->OrderProducts->sum('line_total');
    }

    /**
     * Calculates the complete total of payments towards the order
     * @return float Total sum of payments towards the order
     */
    public function getPaymentTotalAttribute()
    {
        return $this->payments->sum('amount');
    }

    /**
     * Accessor to calculate the progress percentage of the order
     * @return float Progress percentage of the order
     */
    public function getOrderProgressAttribute()
    {
        return (100/7)*$this->orderStatus->id;
    }

}
