<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/_scripts/stories_connect.php');

	$values = $_POST['values'];

  $name = $values[0];
  $find = $values[1];
  $story = $values[2];
  $email = $values[3];

  mysqli_query($con, "INSERT INTO stories (Name, Find, Story, Email) VALUES ('$name', '$find', '$story', '$email')");

	mysqli_close($con);
?>
