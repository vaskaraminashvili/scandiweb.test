<?php

namespace app\classes;
use app\classes\Product;

class DVD extends Product {
  static protected $columns = ['id', 'sku', 'name', 'price', 'size'];

  public function __construct($args=[]) {
    $this->sku = $args['sku'] ?? '';
    $this->name = $args['name'] ?? '';
    $this->price = $args['price'] ?? '';
    $this->size = $args['size'] ?? '';
  }
}

?>
