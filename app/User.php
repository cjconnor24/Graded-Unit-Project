<?php

namespace App;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Notifications\Notifiable;


class User extends EloquentUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * A user has many addresses
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Associate user with multiple notes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Associate user with multiple orders
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class,'customer_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Accessor to return concatenated full name
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }


}
