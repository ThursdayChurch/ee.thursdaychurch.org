<?php
  class StoriesConnection {
    private $DB_NAME = "stories";
    private $DB_USER = "root";
    private $DB_PASS = "root";
    private $DB_HOST = "localhost";
    private $con;
    private $sql = "";

    public function __construct() {
      $this->con = mysqli_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
      if (!$this->con) {
        die("Cannot connect to database" . mysql_error());
      }
    }

    public function getStories() {
      $this->sql = "SELECT * FROM stories WHERE Removed = 0 ORDER BY ID DESC";
    }

    public function getByCategory($categories) {
      $this->sql = "SELECT * FROM stories WHERE Removed = 0 AND category1 = 1 ORDER BY ID DESC";
    }

    public function getByTier($tier) {

    }

    public function remove($ids) {

    }

    public function setTier($id, $tier) {

    }

    public function setCategories($id, $categories) {

    }

    // Single query to database
    public function query() {
      $result = mysqli_query($this->con, $this->sql);

      while($row = mysqli_fetch_assoc($result)) {
        $id = $row['ID'];
        $name = $row['Name'];
        $find = $row['Find'];
        $email = $row['Email'];
        $story = $row['Story'];

        $timestamp = $row['Date'];
        $date = date('M j Y', strtotime($timestamp));

        echo "
        <div id='story-$id' class='story'>
          <div class='story-header'>
            <div class='date col-sm-3'>" . $date . "</div>

            <div class='trash col-sm-1 col-sm-offset-8 text-center'>
              <i class='fa fa-trash-o'></i>
            </div>

            <div class='clearfix'></div>
          </div>

          <div class='story-content pad'>
            <div class='col-sm-12'>
              <h3>" . $name . "</h3>
            </div>

            <div class='clearfix'></div>

            <div class='more'>
              <div class='content col-sm-6'><p><strong>How Did You Find Journey Church?</strong><br>" . $find . "</p></div>
              <div class='content col-sm-6'><p><strong>Story</strong><br>" . $story . "</p></div>
              <div class='clearfix'></div>

              <div class='content col-sm-6'><p><strong>Email</strong><br><a href='mailto:$email'>" . $email . "</a></p></div>
              <div class='clearfix'></div>
            </div>
          </div>

          <div class='story-footer'>
            <div class='categories col-sm-10'>
              <div class='category col-sm-3'>Category 1</div>
            </div>

            <div class='more-info col-sm-1 col-sm-offset-1 text-center'>
              <i class='fa fa-chevron-down'></i>
            </div>

            <div class='clearfix'></div>
          </div>
        </div>

        <div class='clearfix'></div>

        <script>
          $('#story-$id .trash').click(
            function() {
              $('#story-$id').toggleClass('remove');
              $('#story-$id .trash i').toggleClass('fa-times fa-trash-o');
            }
          );

          $('#story-$id .more-info').click(
            function() {
              $('#story-$id .more').slideToggle();
              $('#story-$id .more-info i').toggleClass('fa-chevron-up fa-chevron-down');
            }
          );
        </script>
        ";
      }

      mysqli_close($this->con);
    }

    // Multiple queries to database.
    public function multiQuery() {
      mysqli_multi_query($this->con, $this->sql);
      $this->getStories();
      $this->query();
    }
  }
?>
