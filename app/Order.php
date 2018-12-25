<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'price', 'payment_id'
    ];

    /**
     * Get the payment record associated with the order.
     */
    public function payment()
    {
        return $this->belongsTo('App\Payment', 'payment_id');
    }

    /**
     * The products that belong to the order.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_product', 'order_id', 'product_id')->withPivot('quantity', 'size');
    }
}
