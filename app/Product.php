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

    /**
     * Associate product with multiple papers
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function papers()
    {
        return $this->belongsToMany(Paper::class);
    }

    /**
     * Associate product with one category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
