<?php
  if(isset($_POST['id'])) {
    $ids = $_POST['id'];

    require_once($_SERVER['DOCUMENT_ROOT'].'/_scripts/stories_connect.php');

    $result = mysqli_query($con, "SELECT * FROM stories ORDER BY 'Sorting Index'");

    while($row = mysqli_fetch_assoc($result)) {
      
    }

    mysqli_query($con, "UPDATE stories SET SortingIndex = 1 WHERE ID = $ids[0]");

    mysqli_close($con);
  }
?>
