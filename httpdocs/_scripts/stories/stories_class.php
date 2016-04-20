<?php
  class StoriesConnection {
    private $DB_NAME = "stories";
    private $DB_USER = "root";
    private $DB_PASS = "root";
    private $DB_HOST = "localhost";
    private $con;
    private $sql = "";
    private $result;

    public function __construct() {
      $this->con = mysqli_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);

      if (!$this->con) {
        die("Cannot connect to database" . mysql_error());
      }
    }

    public function submit($values) {
      $name = $values[0];
      $beginning = $values[1];
      $persevered = $values[2];
      $growth = $values[3];
      $thanks = $values[4];
      $email = $values[5];

      $this->sql .= "INSERT INTO stories (Name, Beginning, Persevered, Growth, Thanks, Email) VALUES ('$name', '$beginning', '$persevered', '$growth', '$thanks', '$email')";

      mysqli_query($this->con, $this->sql);

      mysqli_close($this->con);
    }

    public function getStories() {
      $this->sql .= "SELECT * FROM stories WHERE Removed = 0 ORDER BY ID DESC";

      $this->result = mysqli_query($this->con, $this->sql);

      while($row = mysqli_fetch_assoc($this->result)) {
        $id = $row['ID'];
        $name = $row['Name'];
      	$beginning = $row['Beginning'];
      	$persevered = $row['Persevered'];
      	$growth = $row['Growth'];
      	$thanks = $row['Thanks'];
      	$email = $row['Email'];

        $timestamp = $row['Date'];
        $date = date('M j Y', strtotime($timestamp));

        $this->printStory($id, $name, $beginning, $persevered, $growth, $thanks, $email, $date);
      }

      mysqli_close($this->con);
    }

    public function remove($remove) {
      foreach($remove as $id) {
        $this->sql .= "UPDATE stories SET Removed = 1 WHERE ID = $id";
      }
    }

    public function setTier($tier) {

    }

    public function setCategories($categories) {

    }

    // multiple queries from database to admin
    public function update() {
      mysqli_multi_query($this->con, $this->sql);
      $this->sql = "";
      $this->getStories();
    }

    private function printStory($id, $name, $beginning, $persevered, $growth, $thanks, $email, $date) {
      echo "
      <div id='story-$id' class='story'>
        <div class='story-header'>
          <div class='date col-sm-3'>$date</div>

          <div class='trash col-sm-1 col-sm-offset-8 text-center'>
            <i class='fa fa-trash-o'></i>
          </div>

          <div class='clearfix'></div>
        </div>

        <div class='story-content pad'>
          <div class='col-sm-12'>
            <h3>$name</h3>
          </div>

          <div class='clearfix'></div>

          <div class='more'>
            <div class='content col-sm-6'><p><strong>Where does your story begin? Describe that season…</strong><br>$beginning</p></div>
            <div class='content col-sm-6'><p><strong>Can you further describe how you persevered during that season?</strong><br>$persevered</p></div>
            <div class='clearfix'></div>

            <div class='content col-sm-6'><p><strong>In the timeline of your story, how have you changed? Where were you before? Where are you now?</strong><br>$growth</p></div>
            <div class='content col-sm-6'><p><strong>How would you thank God for His provision and/or guidance during this time?</strong><br>$thanks</p></div>
            <div class='clearfix'></div>

            <div class='content col-sm-6'><p><strong>Email</strong><br><a href='mailto:$email'>$email</a></p></div>
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
  }
?>
