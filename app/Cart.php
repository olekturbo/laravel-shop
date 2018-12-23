<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $price, $quantity) {
        $storedItem = ['qty' => 0, 'price' => $price, 'item' => $item];
        if($this->items) {
            if(array_key_exists($item->id, $this->items)) {
                $storedItem = $this->items[$item->id];

            }
        }
        $storedItem['qty'] += $quantity;
        $storedItem['price'] = $price * $storedItem['qty'];
        $this->items[$item->id] = $storedItem;
        $this->totalQty += $quantity;
        $this->totalPrice += $price;
    }
}
