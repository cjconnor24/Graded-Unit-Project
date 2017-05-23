<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Address Model to represent address within system
 *
 * @package App
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class Address extends Model
{

    /**
     * Columns which can be mass-assigned in the DB
     * @var array Array of column names
     */
    protected $fillable = ['name','address1','address2','address3','adddress4','postcode'];

    /**
     * Eloquent relationship with Address
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo User related to address
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Concatenates address fields into single string
     * @return string Comma-separated string of address fields
     */
    public function getFullAddressAttribute()
    {
        $fullAddress = '';
        $fullAddress .= $this->address1.', ';
        $fullAddress .= $this->address2.', ';
        $fullAddress .= $this->address3.', ';
        $fullAddress .= $this->address4.', ';
        $fullAddress .= $this->postcode;

        return $fullAddress;
    }

}
