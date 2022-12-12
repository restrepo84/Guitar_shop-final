<?php
require_once('database.php');


// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}


function categoryName($category_id) {
    $db = db_connect();
    $sql = "SELECT categoryName FROM categories ";
    $sql .= "WHERE categoryID = $category_id";
    $result = mysqli_query($db, $sql);
    $name = mysqli_fetch_assoc($result);
    return $name['categoryName'];
    //mysql_free_result ($result);
}
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

function productSelected($category_id) {
    $db = db_connect();
    $sql = "SELECT * FROM products "; 
    $sql .= "WHERE categoryID = $category_id";
    $result = mysqli_query($db, $sql);
    $products = Array();
    while ($row = mysqli_fetch_assoc($result)){
        $products[] = $row;
    }
    return $products;
    //mysql_free_result ($result);
}
// Get name for selected category
$category_name = categoryName($category_id);

// Get all categories
$categories = getAllCategories();

// Get products for selected category
$products = productSelected($category_id);

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
    <h1>Product List</h1>

    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo $category_name; ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['productCode']; ?></td>
                <td><?php echo $product['productName']; ?></td>
                <td class="right"><?php echo $product['listPrice']; ?></td>
                <td><form action="delete_product.php" method="post">
                    <input type="hidden" name="product_id"
                           value="<?php echo $product['productID']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $product['categoryID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="add_product_form.php">Add Product</a></p>
        <p><a href="category_list.php">List Categories</a></p>        
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
</footer>
</body>
</html>