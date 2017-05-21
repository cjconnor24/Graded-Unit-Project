<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class State - Model to represent an Order's State
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App
 */
class State extends Model
{
    /**
     * Fields which can be mass-assigned
     * @var array Array of column names
     */
    protected $fillable = ['name'];

    /**
     * Reltationship with orders - order state can have many orders
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of Orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
