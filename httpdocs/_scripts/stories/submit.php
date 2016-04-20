<?php
  require_once("stories_class.php");

  $connection = new StoriesConnection();
  $connection->submit($_POST["values"]);
?>
