<?php
require_once('database.php');

// Get IDs
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Delete the product from the database
$sql = "DELETE FROM products WHERE productID = '" . $product_id . "' AND categoryID = '" . $category_id . "' LIMIT 1";
$result = mysqli_query($db, $sql);
// Display the Product List page
redirect_to("Location:http://localhost/My_Guitar_Shop/index.php");

redirect_to("Location:http://localhost/My_Guitar_Shop/database_error.php");