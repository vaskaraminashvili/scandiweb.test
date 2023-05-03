<?php include_once('../app/initialize.php'); ?>
<?php


use app\classes\Book;
use app\classes\DVD;
use app\classes\Furniture;

$errors = '';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = validate_inputs();
    if (!empty($errors['html'])) {
        echo json_encode($errors);
        return;
    }else{
        $result = '';
        $args = [];
        $args['sku'] = $_POST['sku'] ?? null;
        $args['name'] = $_POST['name'] ?? null;
        $args['price'] = $_POST['price'] ?? null;
        $args['weight'] = $_POST['weight'] ?? null;
        $args['size'] = $_POST['size'] ?? null;
        $args['width'] = $_POST['width'] ?? null;
        $args['length'] = $_POST['length'] ?? null;
        $args['height'] = $_POST['height'] ?? null;

        if ($_POST['weight'] != null) {
            $book = new Book($args);
            $result = $book->save();

        }

        if ($_POST['size'] != null) {
            $dvd = new DVD($args);
            $result = $dvd->save();
        }

        if ($_POST['width'] != null && $_POST['length'] != null && $_POST['height'] != null) {
            $furniture = new Furniture($args);
            $result = $furniture->save();
        }

        if ($result === true) {
            echo json_encode([
                'status' => 200,
                'message' => 'created'
            ]);
            return;
        } else {

        }

    }
    return true;
}

?>
<!-- Have different page title for each page -->
<?php $page_title = 'Product Add'; ?>
<?php include('../app/shared/head.php'); ?>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-xl-4">
      <div class="container">
        <a class="navbar-brand" href="/">scandiweb</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./index.php">Cancel</a>
            </li>
            <li class="nav-item">
              <button class="btn btn-success px-3" id="submit" form='product_form' type='submit'>Save</button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
        <form class="row needs-validation" action="" id='product_form' method='POST' novalidate>
            <div class="col-xl-6 mx-auto">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="mb-3">
                          <label for="name" class="form-label">Product name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Product name" value="<?= $_POST['name'] ?? ''; ?>"  required>

                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mb-3">
                          <label for="sku" class="form-label">SKU</label>
                          <input type="text" class="form-control" id="sku" name="sku" placeholder="VKR12345" value="<?= $_POST['sku'] ?? ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mb-3">
                          <label for="price" class="form-label">Price ($)</label>
                          <input type="number" class="form-control" id="price" name="price" placeholder="0.00" value="<?= $_POST['price'] ?? ''; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="productType" class="form-label">Type Switcher</label>
                            <select class="form-select" name="typeSwitcher" id="productType" required>
                                <option value="dvd" id='DVD' <?= get_selected_type('dvd'); ?>>DVD</option>
                                <option value="book" id='Book' <?= get_selected_type('book'); ?>>Book</option>
                                <option value="furniture" id='Furniture' <?= get_selected_type('furniture'); ?>>Furniture</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="size-container">
                    <div class="col">
                        <div class="mb-3">
                          <label for="size" class="form-label">Size (MB)</label>
                          <input type="text" class="form-control" id="size" name="size" placeholder="0" value="<?= $_POST['size'] ?? ''; ?>" required>
                          <small id="passwordHelpBlock" class="form-text text-muted">Please provide a size in megabyte (MB).</small>
                        </div>
                    </div>
                </div>
                <div class="row" id="weight-container">
                    <div class="col">
                        <div class="mb-3">
                          <label for="weight" class="form-label">Weight (KG)</label>
                          <input type="text" class="form-control" id="weight" name="weight" placeholder="0.00" value="<?= $_POST['weight'] ?? ''; ?>" required>
                          <small id="" class="form-text text-muted">Please provide a weight in kilograms (KG).</small>
                        </div>
                    </div>
                </div>
                <div class="row" id="dimensions-container">
                    <div class="col">
                        <div class="mb-3">
                          <label for="height" class="form-label">Height (CM)</label>
                          <input type="text" class="form-control" id="height" name="height" placeholder="0" value="<?= $_POST['height'] ?? ''; ?>" required>
                          <small id="" class="form-text text-muted">Please provide a size in megabyte (MB).</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                          <label for="width" class="form-label">Width (CM)</label>
                          <input type="text" class="form-control" id="width" name="width" placeholder="0" value="<?= $_POST['width'] ?? ''; ?>" required>
                          <small id="" class="form-text text-muted">Please provide a size in megabyte (MB).</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                          <label for="length" class="form-label">Length (CM)</label>
                          <input type="text" class="form-control" id="length" name="length" placeholder="0" value="<?= $_POST['length'] ?? ''; ?>" required>
                          <small id="passwordHelpBlock" class="form-text text-muted">Please provide a size in megabyte (MB).</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div id="custom_errors">

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


  <?= $errors ;?>


  <?php include('../app/shared/footer.php'); ?>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src='./script.js'></script>
</body>

</html>
