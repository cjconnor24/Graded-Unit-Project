<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = ['name','manufacturer','weight'];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
