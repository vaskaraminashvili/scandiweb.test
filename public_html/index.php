<?php

use app\classes\Product;

include_once('../app/initialize.php');

$products = Product::select_all();

// Delete the selected items
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteId'])) {

  Product::delete();
}

?>
<!-- Have different page title for each page -->
<?php $page_title = 'Product List'; ?>
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
          <a class="nav-link active" aria-current="page" href="add-product.php">ADD</a>
        </li>
        <li class="nav-item">
          <button class="nav-link" id='delete-product-btn' form='product_list' type='submit' name='delete'>MASS DELETE</button>
        </li>
      </ul>
    </div>
  </div>
</nav>
<section class="">
  <form action="" id='product_list' method='POST'>
    <div class="container">
      <div class="row">
        <?php foreach ($products as $product): ?>
          <div class="col-xl-4 mb-xl-3">
            <div class="card mx-auto" style="width: 18rem;">
              <div class="card-body">
                <ul class="list-group">
                  <li class="list-group-item border-0">
                    <input type="checkbox" name="deleteId[]" value="<?= $product->id ?>" class="delete-checkbox">
                  </li>
                  <li class="list-group-item border-0 text-center"><?= $product->sku ?></li>
                  <li class="list-group-item border-0 text-center"><?= $product->name ?></li>
                  <li class="list-group-item border-0 text-center"><?= $product->price ?> $</li>
                  <li class="list-group-item border-0 text-center"><?= $product->getSpecificAttribute() ?></li>

                </ul>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>

  </form>
</section>

<?php include('../app/shared/footer.php'); ?>
</body>

</html>
