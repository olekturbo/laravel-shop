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

    public function add($item, $price, $quantity, $size) {
        $storedItem = ['qty' => 0, 'price' => 0, 'item' => $item];
        if($this->items) {
            if(array_key_exists($item->id, $this->items) && array_key_exists($size, $this->items[$item->id])) {
                $storedItem = $this->items[$item->id][$size];
            }
        }
        $storedItem['qty'] += $quantity;
        $storedItem['price'] = $price * $storedItem['qty'];
        $this->items[$item->id][$size] = $storedItem;
        $this->totalQty += $quantity;
        $this->totalPrice += $price * $quantity;
    }

    public function edit($item, $quantity, $size) {
        $oldQuantity = $this->items[$item->id][$size]['qty'];

        if($this->items) {
            if(array_key_exists($item->id, $this->items) && array_key_exists($size, $this->items[$item->id])) {
                $storedItem = $this->items[$item->id][$size];
            }
        }

        $storedItem['qty'] += $quantity - $oldQuantity;
        $storedItem['price'] += ($item->discount_price ?? $item->price) * $quantity - ($item->discount_price ?? $item->price) * $oldQuantity;;
        $this->items[$item->id][$size] = $storedItem;
        $this->totalQty += $quantity - $oldQuantity;
        $this->totalPrice += ($item->discount_price ?? $item->price) * $quantity - ($item->discount_price ?? $item->price) * $oldQuantity;
    }

    public function remove($item, $size) {
        $quantity = $this->items[$item->id][$size]['qty'];
        $price = $this->items[$item->id][$size]['price'];

        unset($this->items[$item->id][$size]);

        if(empty($this->items[$item->id])) {
            unset($this->items[$item->id]);
        }

        $this->totalQty -= $quantity;
        $this->totalPrice -= $price;
    }
}
