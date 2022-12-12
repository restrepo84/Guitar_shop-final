<?php
function new_category($category_name) {
global $db;
$sql = "INSERT INTO categories ";
$sql .= "(categoryName) "; 
$sql .= "VALUES (" ;
$sql .= "'" . $category_name . "'" ;
$sql .= ")" ;

$result = mysqli_query($db, $sql);
if (!$result) {
    echo mysql_error($db);
    db_disconnect($db);
    exit;
}

}
?>