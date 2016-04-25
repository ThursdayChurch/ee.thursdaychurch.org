<?php
  require_once("StoriesConnection.php");

  $connection = new StoriesConnection();
  $connection->submit($_POST["values"]);
?>
