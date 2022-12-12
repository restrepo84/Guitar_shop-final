<?php
define("DB_SERVER", "localhost");
define("DB_USER", "mgs_user");
define("DB_PASS", "pa55word");
define("DB_NAME", "My Guitar Shop");

function db_connect() {
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  confirm_db_connect();
  return $connection;
}

function db_disconnect($connection) {
  if(isset($connection)) {
    mysqli_close($connection);
  }
}

function confirm_db_connect() {
  if(mysqli_connect_errno()) {
    $msg = "Database connection failed: ";
    $msg .= mysqli_connect_error();
    $msg .= " (" . mysqli_connect_errno() . ")";
    exit($msg);
  }
}

function confirm_result_set($result_set) {
  if (!$result_set) {
    exit("Database query failed.");
  }
}

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}


?>