<?php
if (!empty($_POST['ids'])) {

  $ids = ($_POST['ids']);
  $remove = ($_POST['remove']);
  $categories = ($_POST['categories']);

  require_once($_SERVER['DOCUMENT_ROOT'].'/_scripts/stories/stories_connect.php');

  $result = mysqli_query($con, "SELECT * FROM stories");

  $sql = "";

  while($row = mysqli_fetch_assoc($result)) {
    if(in_array($row['ID'], $ids, TRUE)) {
      $id = intval($row['ID']);

      $index = array_search($id, $ids);

      if (intval($remove[$index]) === 1) {
          $sql .= "UPDATE stories SET Removed = 1 WHERE ID = $id; ";
      }
      /*else if (!empty($categories[$index]['categories'])) {
        $categoryArray = $categories[$index]['categories'];
        $count = count($categoryArray);

        for ($i = 0; $i < $count; ++$i) {
          if ($row[$categoryArray[$i]] != 1) {

            $key = $categoryArray[$i];
            $sql .= "UPDATE stories SET $key = 1 WHERE ID = $id; ";
            echo $sql;
          }
        }
      }*/
    }
  }

  mysqli_multi_query($con, $sql);

  //echo "Your changes have been saved";

  mysqli_close($con);

}
?>
