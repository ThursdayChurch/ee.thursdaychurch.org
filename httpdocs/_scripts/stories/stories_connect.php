<?php
  define('DB_NAME', 'stories');
  define('DB_USER', 'storiesadmin');
  define('DB_PASS', '%M79dl2g');
  define('DB_HOST', 'localhost');

  $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if (!$con) {
    die("Cannot connect to database" . mysql_error());
  }
?>
