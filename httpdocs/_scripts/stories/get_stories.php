<?php
  require_once("StoriesConnection.php");

  $connection = new StoriesConnection();
  $connection->getStories($_POST['categories'], $_POST['tier'], $_POST['startDate'], $_POST['endDate']);
?>
