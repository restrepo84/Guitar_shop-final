<?php
// Get the product data
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

// Validate inputs
if (
  $category_id == null || $category_id == false ||
  $code == null || $name == null || $price == null || $price == false
) {
  $error = "Invalid product data. Check all fields and try again.";
  include('error.php');
  exit;
} else {
  require_once('database.php');
}


insert_product(['categoryID' => $category_id, 'productCode' => $code, 'productName' => $name, 'listPrice' => $price]);

// Add the product to the database  
function insert_product($product)
{
  $db = db_connect();

  $sql = "INSERT INTO products ";
  $sql .= "(categoryID, productCode, productName, listPrice) ";
  $sql .= "VALUES (";
  $sql .= $product['categoryID'] . ",";
  $sql .= "'" . $product['productCode'] . "',";
  $sql .= "'" . $product['productName'] . "',";
  $sql .= $product['listPrice'];
  $sql .=  ")";
  var_dump($sql);
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
