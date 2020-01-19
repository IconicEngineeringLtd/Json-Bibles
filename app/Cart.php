<?php

namespace App;

class Cart
{
    public $items = NULL;
    public $totalQty = 0;
    public $totalPrice = 0;

    // Receive Passed data from Controller
    public function __construct($oldCart)
    {
      if ($oldCart) {
        $this->items = $oldCart->items;
        $this->totalQty = $oldCart->totalQty;
        $this->totalPrice = $oldCart->totalPrice;
      }
    }

    // Execute item adding commands
    public function add($item, $id)
    {
      $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
      if ($this->items) {
        if (array_key_exists($id, $this->items)) {
          $storedItem = $this->items[$id];
        }
      }
      $storedItem['qty']++;
      $storedItem['price'] = $item->price * $storedItem['qty'];
      $this->items[$id] = $storedItem;
      $this->totalQty ++;
      $this->totalPrice += $item->price;
    }

    // Execute item reduce commands
    public function cartReduce($id)
    {
      if ($this->items[$id]['qty'] > 1) {
        $this->items[$id]['qty'] --;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQty --;
        $this->totalPrice -= $this->items[$id]['item']['price'];
      }
    }
    // Execute item increase commands
    public function cartIncrease($id)
    {
      if ($this->items[$id]['qty'] >= 1) {
        $this->items[$id]['qty'] ++;
        $this->items[$id]['price'] += $this->items[$id]['item']['price'];
        $this->totalQty ++;
        $this->totalPrice += $this->items[$id]['item']['price'];
      }
    }
    // Execute item toggle commands
    public function cartToggle($id, $newQty)
    {
      if ($newQty > 0) {
        // Get Old Value
        $oldUnitQty = $this->items[$id]['qty'];
        $oldPrice = $this->items[$id]['price'];
        // Plus
        if ($newQty > $oldUnitQty) {
          // Put New Value
          $this->items[$id]['qty'] = $newQty;
          $this->items[$id]['price'] = ($this->items[$id]['qty'] * $this->items[$id]['item']['price']);
          // Get Current Value
          $this->totalQty += ($this->items[$id]['qty'] - $oldUnitQty);
          $this->totalPrice += ($this->items[$id]['price'] - $oldPrice);
        }
        // Minus
        if ($newQty < $oldUnitQty) {
          // Put New Value
          $this->items[$id]['qty'] = $newQty;
          $this->items[$id]['price'] = ($this->items[$id]['qty'] * $this->items[$id]['item']['price']);
          // Get Current Value
          $this->totalQty -= ($oldUnitQty - $this->items[$id]['qty']);
          $this->totalPrice -= ($oldPrice - $this->items[$id]['price']);
        }
      }
    }
    // Execute item toggle commands
    public function cartItemDelete($id)
    {
      $oldUnitQty = $this->items[$id]['qty'];
      $oldPrice = $this->items[$id]['price'];

      unset($this->items[$id]);

      $this->totalQty -= $oldUnitQty;
      $this->totalPrice -= $oldPrice;

    }
}
