<?php
  require_once("StoriesConnection.php");

  $connection = new StoriesConnection();
  $connection->remove($_POST["remove"], $_POST["id"]);
  $connection->update();
?>
