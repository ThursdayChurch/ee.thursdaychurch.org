<?php
  require_once("StoriesConnection.php");

  $connection = new StoriesConnection();
  $connection->submit($_POST["values"]);

  echo "Thank You For Submiting Your Story! Our Stories Team will be in touch";
?>
