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
     * ORDER RELATIONSHIP NOT CODED YET
     */
    public function orders()
    {

    }

}
