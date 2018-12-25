<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seller_id', 'tr_id', 'tr_amount'
    ];

    /**
     * Get the payment record associated with the order.
     */
    public function order()
    {
        return $this->hasOne('App\Order', 'payment_id');
    }
}
