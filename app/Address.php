<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * Associates address with a particular user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
