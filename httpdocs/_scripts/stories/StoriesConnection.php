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

    public function getStories($categories, $tier) {
      $this->sql .= "SELECT * FROM stories WHERE Removed = 0";

      if (!empty($categories) && !empty($tier)) {
        foreach($categories as $category) {
           $this->sql .= " AND $category = 1";
        }

        if ($tier != 'all') {
            $this->sql .= " AND tier = '$tier'";
        }
      }
      else if (!empty($categories)) {
        foreach($categories as $category) {
           $this->sql .= " AND $category = 1";
        }
      }
      else if (!empty($tier)) {
        if ($tier != 'all') {
            $this->sql .= " AND tier = '$tier'";
        }
      }

      $this->sql .= " ORDER BY ID DESC";

      $this->result = mysqli_query($this->con, $this->sql);

      while($row = mysqli_fetch_assoc($this->result)) {
        $id = $row['ID'];
        $name = $row['Name'];
      	$beginning = $row['Beginning'];
      	$persevered = $row['Persevered'];
      	$growth = $row['Growth'];
      	$thanks = $row['Thanks'];
      	$email = $row['Email'];
        $tier = $row['tier'];

        $timestamp = $row['Date'];
        $date = date('M j Y', strtotime($timestamp));

        $this->printStory($id, $name, $beginning, $persevered, $growth, $thanks, $email, $date, $tier);
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

    private function printStory($id, $name, $beginning, $persevered, $growth, $thanks, $email, $date, $tier) {
      $tierString = str_replace('-', ' ', $tier);

      echo "
      <div id='story-$id' class='story'>
        <div class='header'>
          <div class='date col-sm-3 col-xs-4'>$date</div>

          <div class='$tier col-sm-3 col-xs-4 col-sm-offset-4 col-xs-offset-2'>$tierString</div>

          <div class='edit-category col-sm-1 col-xs-2 col-sm-offset-0 col-xs-offset-4 text-center'>
            <i class='fa fa-pencil-square-o'></i>
          </div>

          <div class='trash col-sm-1 col-xs-2 text-center'>
            <i class='fa fa-trash-o'></i>
          </div>

          <div class='clearfix'></div>
        </div>

        <div class='content'>
          <div class='col-sm-12'>
            <div class='col-sm-12'>
              <h3>$name</h3>
            </div>

            <div class='clearfix'></div>

            <div class='more'>
              <div class='entry col-sm-6'><p><strong>Where does your story begin? Describe that season…</strong><br>$beginning</p></div>
              <div class='entry col-sm-6'><p><strong>Can you further describe how you persevered during that season?</strong><br>$persevered</p></div>
              <div class='clearfix'></div>

              <div class='entry col-sm-6'><p><strong>In the timeline of your story, how have you changed? Where were you before? Where are you now?</strong><br>$growth</p></div>
              <div class='entry col-sm-6'><p><strong>How would you thank God for His provision and/or guidance during this time?</strong><br>$thanks</p></div>
              <div class='clearfix'></div>

              <div class='entry col-sm-6'><p><strong>Email</strong><br><a href='mailto:$email'>$email</a></p></div>
              <div class='clearfix'></div>
            </div>
          </div>
          <div class='clearfix'></div>
        </div>

        <div class='footer'>
          <div class='col-sm-12'>
            <div class='edit-categories'>
              <div class='col-sm-12'>
                <form>
                  <input type='checkbox' name='marriage'> Marriage<br>
                  <input type='checkbox' name='addiction'> Addiction<br>
                  <input type='checkbox' name='adoption'> Adoption<br>
                  <input type='checkbox' name='death-&-loss'> Death & Loss<br>
                  <input type='checkbox' name='financial'> Financial<br>
                  <input type='checkbox' name='parenting'> Parenting<br>
                  <input type='checkbox' name='family'> Family<br>
                  <input type='checkbox' name='reconciliation'> Reconciliation<br>
                  <input type='checkbox' name='doubt'> Doubt<br>
                  <input type='checkbox' name='religion'> Religion<br>
                  <input type='checkbox' name='missions'> Missions<br>
                  <input type='checkbox' name='persecution'> Persecution<br>
                  <input type='checkbox' name='redemption'> Redemption<br>
                  <input type='checkbox' name='dissapointment'> Dissapointment<br>
                  <input type='checkbox' name='love'> Love<br>
                  <input type='checkbox' name='prophecy'> Prophecy<br>
                  <input type='checkbox' name='healing'> Healing<br>
                  <input type='checkbox' name='apathy'> Apathy<br>
                  <input type='checkbox' name='synnacism'> Synnacism<br>
                  <input type='checkbox' name='bitterness'> Bitterness<br>
                  <input type='checkbox' name='forgiveness'> Forgiveness<br>
                  <input type='checkbox' name='anger'> Anger<br>
                </form>
              </div>
            </div>

            <div class='categories'>
              <div class='col-sm-6'>
                <div class='category'>
                  Category 1
                </div>
              </div>

              <div class='col-sm-6'>
                <div class='category'>
                  Category 1
                </div>
              </div>

              <div class='col-sm-6'>
                <div class='category'>
                  Category 1
                </div>
              </div>
            </div>
          </div>

          <div class='more-info col-sm-1 col-xs-2 col-sm-offset-11 col-xs-offset-10 text-center'>
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

        $('#story-$id .edit-category').click(
          function() {
            $('#story-$id .edit-categories').slideToggle();
            $('#story-$id .edit-category i').toggleClass('fa-times fa-pencil-square-o');
          }
        );
      </script>
      ";
    }
  }
?>
