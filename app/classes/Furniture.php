<?php

namespace app\classes;
use app\classes\Product;

class Furniture extends Product {
  static protected $columns = ['id', 'sku', 'name', 'price', 'dimensions'];
  public function __construct($args=[]) {
    $this->sku = $args['sku'] ?? '';
    $this->name = $args['name'] ?? '';
    $this->price = $args['price'] ?? '';
    $this->width = $args['width'] ?? '';
    $this->length = $args['length'] ?? '';
    $this->height = $args['height'] ?? '';
  }
  public function save() {
    $sql = "INSERT INTO products SET
        sku='{$this->sku}',
        name='{$this->name}',
        price='{$this->price}',
        dimensions='{$this->height},{$this->width},{$this->length}'";
    $result = self::$database->query($sql);
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }


}

?>
