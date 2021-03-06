<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Product Model to represent a product
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App
 */
class Product extends Model
{
    /**
     * Columns which are mass-assignable
     * @var array Array of column names
     */
    protected $fillable = (['name','description','price']);
    /**
     * Eloquent relationship with Size
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection of Sizes
     */
    public function sizes()
    {
       return $this->belongsToMany(Size::class);
    }

    /**
     * Eloquent relationship with Paper
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany Collection of Papers
     */
    public function papers()
    {
        return $this->belongsToMany(Paper::class);
    }

    /**
     * Eloquent relationship with Category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Category which product belongs to
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Eloquent relationship with Orders
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Collection of Orders featuring Product
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * Eloquent relationship with OrderProduct
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Collection or ORderProducts Product belongs to
     */
    public function OrderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

}
