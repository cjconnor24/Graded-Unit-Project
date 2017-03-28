<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function maincontact()
    {
        return $this->hasOne(User::class);
    }
}
