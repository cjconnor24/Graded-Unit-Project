<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Company model to represent company within system
 *
 * @package App
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @todo Implement company logic. At the moment, single users only.
 */
class Company extends Model
{

    /**
     * Associate a main contact with the company
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function maincontact()
    {
        return $this->hasOne(User::class);
    }
}
