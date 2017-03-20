<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Associate sizes with product
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sizes()
    {
       return $this->belongsToMany(Size::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
