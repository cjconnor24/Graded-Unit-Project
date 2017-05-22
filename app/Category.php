<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Category Model to represent product category within system
 * @package App
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class Category extends Model
{
    /**
     * Columns which are mass-assignable
     * @var array
     */
    protected $fillable = (['name']);

    /**
     * Eloquent relationship with Product
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of Products
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
