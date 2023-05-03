<?php


// Display errors
function display_errors($errors=[]) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<ul class='list-group'>";
    foreach($errors as $error) {
      $output .= "<li class='list-group-item list-group-item-danger'>" . $error . "</li>";
    }
    $output .= "</ul>";
  }
  return $output;
}

function get_current_inputs() {
  $input_values = ['sku', 'name', 'price'];

  if($_POST['typeSwitcher'] == 'dvd') {
    $input_values[] = 'size';
  }

  if($_POST['typeSwitcher'] == 'book') {
    $input_values[] = 'weight';
  }

  if($_POST['typeSwitcher'] == 'furniture') {
    $input_values[] = 'width';
    $input_values[] = 'length';
    $input_values[] = 'height';
  }

  return $input_values;
}

// Validate inputs
function validate_inputs() {
  $errors = [];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputs = get_current_inputs();

    foreach ($inputs as $input) {
      if (empty($_POST[$input]) || trim($_POST[$input]) == '') {
        $errors[$input] = ucfirst($input) . " can't be empty.";
      }
    }

    // Check if the input strings include special characters
    $pattern = "/^[a-zA-Z0-9]*$/";
    if (preg_match($pattern, $_POST['sku']) === 0) {
      $errors['sku'] = "Please, include only letters, numbers or the combination of both in the SKU.";
    }

    if (preg_match($pattern, $_POST['name']) === 0) {
      $errors['name'] = "Please, include only letters, numbers or the combination of both in the Name.";
    }

    // Check if the sku already exists in the database
    global $database;

    $sql = "SELECT * FROM products ";
    $sql .= "WHERE sku='" . $_POST['sku'] . "'";
    $result = $database->query($sql);
    if (mysqli_num_rows($result) > 0) {
      $errors['sku'] = "This SKU already exists. Please, provide a unique stock keeping unit (SKU).";
    }

    if (!empty($_POST['price']) && !is_numeric($_POST['price'])) {
      $errors['price'] = "Please, provide a numeric value for the price.";
    }

    if (!empty($_POST['size']) && !is_numeric($_POST['size'])) {
      $errors['size'] = "Please, provide a numeric value for the size.";
    }

    if (!empty($_POST['weight']) && !is_numeric($_POST['weight'])) {
      $errors['weight'] = "Please, provide a numeric value for the weight.";
    }

    if (!empty($_POST['length']) && !is_numeric($_POST['length'])) {
      $errors['length'] = "Please, provide a numeric value for the length.";
    }

    if (!empty($_POST['width']) && !is_numeric($_POST['width'])) {
      $errors['width'] = "Please, provide a numeric value for the width.";
    }

    if (!empty($_POST['height']) && !is_numeric($_POST['height'])) {
      $errors['height'] = "Please, provide a numeric value for the height.";
    }
    if (!empty($errors)) {
      return [
        'html' => display_errors($errors),
        'fields' => $errors,
      ];
    } 
  }
}

  // dump and die
function dd()
{
  foreach (func_get_args() as $arg) {
    var_dump($arg);
  }
  die();
}

  // Get the selected type
  function get_selected_type($type) {
    if(isset($_POST['typeSwitcher']) && $_POST['typeSwitcher'] == $type) {
    echo 'selected';
    }
  }
