<?php
require('database.php');

$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$product_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

var_dump($price);

update_product(['categoryID' => $category_id, 'productCode' => $code, 'productName' => $name, 'listPrice' => $price, 'productID' => $product_id]);

function update_product($product)
{
  $db = db_connect();

  $sql = "UPDATE products SET ";
  $sql .= "categoryID = '" . $product['categoryID'] . "' ,";
  $sql .= "productCode = '" . $product['productCode'] . "' ,";
  $sql .= "productName = '" . $product['productName'] . "' ,";
  $sql .= "listPrice = '" . $product['listPrice'] . "' ";
  $sql .= "WHERE productID = '" . $product['productID'] . "';";
  $result = mysqli_query($db, $sql);
  if ($result) {
    redirect_to("index.php?category_id=" . $product['categoryID']);
  } else {
    $error = mysqli_error($db);
    db_disconnect($db);
    include("error.php");
    exit;
  }
}

// Display the Product List page
function redirect_to($location)
{
  header('Location: ' . $location);
  exit;
}
