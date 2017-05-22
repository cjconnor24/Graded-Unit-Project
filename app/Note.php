<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Note Model to represent an order Note
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App
 */
class Note extends Model
{

    /**
     * Columns which are mass-assignable
     * @var array
     */
    protected $fillable = ['content'];

    /**
     * Eloquent relationship with
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Eloquent relationship with user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo User related to Note
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
