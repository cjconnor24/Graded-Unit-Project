<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Address - Model to represent address
 * @package App
 */
class Address extends Model
{
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
