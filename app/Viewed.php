<?php

namespace App;

class Viewed
{
    public $products = NULL;

    public function __construct($oldViewed)
    {
      if ($oldViewed) {
        $this->products = $oldViewed->products;
      }
    }
    public function add($product, $id)
    {
      $viewedItem = $product;

      if ($this->products) {
        if (array_key_exists($id, $this->products)) {
          $viewedItem = $this->products[$id];
        }
      }
      $this->products[$id] = $viewedItem;
    }
}
