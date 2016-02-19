<?php
  if(isset($_POST['id'])) {
    $ids = $_POST['id'];

    require_once($_SERVER['DOCUMENT_ROOT'].'/_scripts/stories_connect.php');

    $result = mysqli_query($con, "SELECT ID, SortingIndex FROM stories ORDER BY SortingIndex");

    $sql = "";

    while($row = mysqli_fetch_assoc($result)) {
      if(in_array($row['ID'], $ids, TRUE)) {
        $id = intval($row['ID']);

        $sortingIndex = intval($row['SortingIndex']);

        $index = array_search($id, $ids);

        if($index != $sortingIndex) {
            $sql .= "UPDATE stories SET SortingIndex = $index WHERE ID = $id; ";
        }
      }
    }

    mysqli_multi_query($con, $sql);

    echo "Your changes have been saved";

    mysqli_close($con);
  }
?>
