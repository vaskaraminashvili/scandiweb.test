<?php

namespace app\classes;

class Product
{
  static protected $database;
  static protected $columns = [];

  public $id;
  public $sku;
  public $name;
  public $price = 0.0;
  public $weight_kg = 0.0;
  public $size = 0;
  public $width = 0;
  public $length = 0;
  public $height = 0;
  public $dimensions = '';

  // Set the database
  static public function set_database($database) {
    self::$database = $database;
  }

  // Select all items from the database
  static public function select_all() {
    $sql = "SELECT * FROM products";
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }

    // results into objects
    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = self::instantiate($record);
    }

    $result->free();

    return $object_array;
  }

  // Create objects from the database items
  static protected function instantiate($record) {
    $object = new self;
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }

  // Get the columns and their values for the given class
  public function attributes()
  {
    $attributes = [];
    foreach (static::$columns as $column) {
      if ($column == 'id') {
        continue;
      }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }


  // Get the columns and their values for the given class
  public function getSpecificAttribute()
  {
    $attr  = '';
    if (!empty($this->size)) {
        $attr = 'Size : ' . $this->size . ' MB';
    }elseif(!empty($this->weight_kg)){
        $attr = 'Weight : ' . $this->weight_kg . ' KG';
    }else{
        $new_array = explode(',', $this->dimensions);
        $new_string = implode('x', $new_array);
        $attr= 'Dimensions : ' . $new_string;
    }
    return $attr;
}

  // Escape the values to make sure they can be used in a SQL statement
  protected function sanitized_attributes()
  {
    $sanitized = [];
    foreach ($this->attributes() as $key => $value) {
      $sanitized[$key] = self::$database->real_escape_string($value);
    }
    return $sanitized;
  }

  // Save the items into the database
  public function save() {
    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO products (";
    $sql .= join(', ', array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";
    $result = self::$database->query($sql);
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

  // Delete item from database
  static public function delete() {
    $selected = $_POST['deleteId'];
    $extracted_id = implode(',', $selected);
  
    $sql = "DELETE FROM products ";
    $sql .= "WHERE id IN(" . $extracted_id . ")";
    $result = self::$database->query($sql);
  
    if($result) {
      header("Location: index.php");
    }
  }

}

?>
