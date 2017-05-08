<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name','address1','address2','address3','address4','postcode','telephone','email'];

    /**
     * Relationship for users
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
       return  $this->hasMany(User::class);
    }

    /**
     * Branches have many orders related to them
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getFullAddressAttribute()
    {
        $address = '';
        $address .= $this->address1.', ';
        $address.= $this->address2.', ';
        $address.= $this->address3.', ';
        $address.= $this->address4.', ';
        $address.= $this->postcode;

        return $address;
    }

}
