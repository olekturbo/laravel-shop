<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items;
    public $totalQty = 0;
    public $totalPrice = 0;
    private $couponCode;
    private $promotionAmount;

    public function __construct($oldCart)
    {
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
        $this->couponCode = session()->get('coupon');
        if($this->couponCode)
            $this->promotionAmount = Coupon::where('code', $this->couponCode)->first()->amount / 100;
    }

    public function add($item, $price, $quantity, $size) {
        if($quantity > 0) {
            $this->couponCode ? $price = round($price * (1 - $this->promotionAmount), 2) : "";

            $storedItem = ['qty' => 0, 'price' => 0, 'item' => $item];
            if($this->items) {
                if(array_key_exists($item->id, $this->items) && array_key_exists($size, $this->items[$item->id])) {
                    $storedItem = $this->items[$item->id][$size];
                }
            }
            if($storedItem['qty'] + $quantity <= $storedItem['item']->quantity) {
                $storedItem['qty'] += $quantity;
                $storedItem['price'] = $price * $storedItem['qty'];
                $this->items[$item->id][$size] = $storedItem;
                $this->totalQty += $quantity;
                $this->totalPrice += $price * $quantity;
            }
        }
    }

    public function edit($item, $quantity, $size) {

            $oldQuantity = $this->items[$item->id][$size]['qty'];

            if($quantity < 0 || $quantity > $this->items[$item->id][$size]['item']->quantity) {
                $quantity = 0;
            }

            if($this->items) {
                if(array_key_exists($item->id, $this->items) && array_key_exists($size, $this->items[$item->id])) {
                    $storedItem = $this->items[$item->id][$size];
                }
            }

            $price = $item->discount_price ?? $item->price;

            $this->couponCode ? $price = $price * (1 - $this->promotionAmount) : "";

            $storedItem['qty'] += $quantity - $oldQuantity;
            $storedItem['price'] += $price * $quantity - $price * $oldQuantity;;
            $this->items[$item->id][$size] = $storedItem;
            $this->totalQty += $quantity - $oldQuantity;
            $this->totalPrice += $price * $quantity - $price * $oldQuantity;

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

    public function coupon() {
        $this->totalPrice = 0;
        foreach($this->items as $item) {
            foreach($item as $size => $single_item) {
                $price = round($single_item['price'] * (1 - $this->promotionAmount), 2);
                $this->items[$item[$size]['item']->id][$size]['price'] = $price;
                $this->totalPrice += $price;
            }
        }
    }
}
