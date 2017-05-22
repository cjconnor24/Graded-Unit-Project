<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Branch Model to represent Branch within system
 *
 * @package App
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class Branch extends Model
{
    /**
     * Columns which are mass-assignable
     * @var array
     */
    protected $fillable = ['name','address1','address2','address3','address4','postcode','telephone','email'];

    /**
     * Eloquent relationship with Users
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of Users
     */
    public function users()
    {
       return  $this->hasMany(User::class);
    }

    /**
     * Eloquent relationship with Orders
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of Orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Concatenates each address field and returns single string
     * @return string Comma-separated address
     */
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
