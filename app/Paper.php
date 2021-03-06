<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Paper Model to represent Paper within the system
 *
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App
 */
class Paper extends Model
{
    /**
     * Columns which as mass-assignable
     * @var array Array of column names
     */
    protected $fillable = ['name','manufacturer','weight'];

    /**
     * Eloquent relationship with products
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany Collection of Product's related to Paper
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
