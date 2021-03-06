<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Size Model to represent the size of a product
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App
 */
class Size extends Model
{
    /**
     * Columns which can be mass-assigned
     * @var array Array of column names
     */
    protected $fillable = ['name','height','width'];

    /**
     * Associate size with many products
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany Collection of Products
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
