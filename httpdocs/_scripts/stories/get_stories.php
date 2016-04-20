<?php
  require_once("stories_class.php");

  $connection = new StoriesConnection();
  $connection->remove($_POST["remove"]);
  //$connection->setCategories($_POST["categories"]);
  $connection->getStories();
  $connection->queryResults();
?>
