<?php

namespace App;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Notifications\Notifiable;

/**
 * Class User used to represent a user within the system
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App
 */
class User extends EloquentUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array Array of column names
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array Array of column names
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Eloquent link for addresses
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of Addresses
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Associate user with multiple notes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of Notes
     */
    public function notes()
    {
        return $this->hasMany(Note::class,'user_id');
    }

    /**
     * Associate user with multiple orders
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of Orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class,'customer_id');
    }

    /**
     * Eloquent link with orders belonging to staff
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of ORders
     */
    public function stafforders()
    {
        return $this->hasMany(Order::class,'staff_id');
    }

    /**
     * Eloquent link for payments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of Payments
     */
    public function payments()
    {
        return $this->hasMany(Payment::class,'customer_id');
    }

    /**
     * Accessor to return concatenated full name
     * @return string Full name based on first and last name
     */
    public function getFullNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }


}
