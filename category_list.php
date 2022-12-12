<?php
require_once('database.php');

if (is_post_request()){
  $category = $_POST["new_category"] ?? "";
  new_category($category);
  redirect_to("category_list.php");
}

// Get all categories
$categories = getAllCategories();

function getAllCategories() {
  $db = db_connect();
  $sql = "SELECT * FROM categories ";
  $result = mysqli_query($db, $sql);
  $categories = Array();
  while ($row = mysqli_fetch_assoc($result)){
      $categories[] = $row;
  }
  return $categories;
  //mysql_free_result ($result);
}



//$categories = mysqli_query($db, $query);

function new_category($category_name) {
$db = db_connect();
$sql = "INSERT INTO categories ";
$sql .= "(categoryName) "; 
$sql .= "VALUES (" ;
$sql .= "'" . $category_name . "'" ;
$sql .= ")" ;

$result = mysqli_query($db, $sql);
if (!$result) {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
}

}
function redirect_to($location){
  header("Location: $location ");
  exit;
}

?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Product Manager</h1></header>
<main>
    <h1>Category List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>

        <?php $categories = getAllCategories(); ?>

        <?php foreach($categories as $category) :  ?>
        <tr>
            <th> 
                <?php echo $category['categoryName']; ?>
            </th>
        </tr>
        <?php endforeach; ?>

        <!-- add code for the rest of the table here -->
    
    </table>

    <h2>Add Category</h2>
    
    <!-- add code for the form here -->
    <form action="category_list.php" method="post">
        <label> Category Name </label><br><input type="text" name="new_category" placeholder="Name">
        <button type="submit">submit</button>
    </form>

    <br>
    <p><a href="index.php">List Products</a></p>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>