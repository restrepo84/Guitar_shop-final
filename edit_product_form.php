<?php
require('database.php');
//Get Categories from the Database
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

$products = selected_products($product_id);

function selected_products($product_id)
{
  $db = db_connect();
  $sql = "SELECT * FROM products ";
  $sql .= "WHERE productID = $product_id";
  $result = mysqli_query($db, $sql);
  $products = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $products = $row;
  }
  return $products;
  //mysql_free_result ($result);
}

$categories = getAllCategories();

function getAllCategories()
{
  $db = db_connect();
  $sql = "SELECT * FROM categories ";
  $result = mysqli_query($db, $sql);
  $categories = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
  }
  return $categories;
  //mysql_free_result ($result);
}
?>
<!DOCTYPE html>
<html>

<!-- the head section -->

<head>
  <title>My Guitar Shop</title>
  <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->

<body>
  <header>
    <h1>Product Manager</h1>
  </header>

  <main>
    <h1>Edit Product</h1>
    <form action="edit_product.php" method="post" id="edit_product_form">

      <label>Category:</label>
      <select name="category_id">
        <?php foreach ($categories as $category) :
          $selected = "";
          if ($category['categoryID'] == $category_id) {
            $selected = "selected";
          }
        ?>
          <option value="<?php echo $category['categoryID']; ?>" <?php echo $selected; ?>>
            <?php echo $category['categoryName']; ?>
          </option>
        <?php endforeach; ?>
      </select><br>

      <label>Code:</label>
      <input type="hidden" name="id" value="<?php echo $product_id; ?>">
      <input type="text" name="code" value="<?php echo $products['productCode']; ?>"><br>

      <label>Name:</label>
      <input type="text" name="name" value="<?php echo $products['productName']; ?>"><br>

      <label>List Price:</label>
      <input type="text" name="price" value="<?php echo $products['listPrice']; ?>"><br>

      <label>&nbsp;</label>
      <input type="submit" value="edit Product"><br>
    </form>
    <p><a href="index.php">View Product List</a></p>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
  </footer>
</body>

</html>