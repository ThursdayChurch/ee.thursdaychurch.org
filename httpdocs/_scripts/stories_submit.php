<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width">

		<meta name="description" content="Share a story about how your life has been changed">
		<meta name="keywords" content="Stories Jesus Life Change Journey Church Norman OK">

		<title>Stories - What's Your Story?</title>

		<!-- Fonts -->
		<link rel="stylesheet" type="text/css" href="//cloud.typography.com/6186432/688704/css/fonts.css" />

		<!-- Font Icons -->
		<link rel="stylesheet" href="/_css/font-awesome.css" type='text/css'>

		<!-- Stylesheets -->
		<link rel="stylesheet" href="/_css/stories/normalize.css">
		<link rel="stylesheet" href="/_css/stories/base.css">
		<link rel="stylesheet" href="/_css/stories/grid.css">
		<link rel="stylesheet" href="/_css/stories/style.css">

		<link rel='stylesheet' media='screen and (max-width: 995px)' href='/_css/stories/tablet.css' />
		<link rel='stylesheet' media='screen and (max-width: 767px)' href='/_css/stories/mobile.css' />
		<link rel='stylesheet' media='screen and (max-width: 479px)' href='/_css/stories/mobile-portrait.css' />

		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	</head>
	<body id="submit-body">
		<header id="header">
			<a href="/stories"><div id="logo"><img src="/_img/logo.png" width="50"/></div></a>
		</header>

		<div class="clear"></div>

    <div id="submit">
			<div class="inner">
				<div class="container">
					<div class="grid_12">
						<h1>Thank You For Sharing <span>Your</span> Story</h1>
					</div>
				</div>
			</div>

      <div class="clear"></div>
    </div>

    <?php
      define('DB_NAME', 'stories');
      define('DB_USER', 'root');
      define('DB_PASS', 'root');
      define('DB_HOST', 'localhost');

      $con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
      if (!$con) {
        die("Cannot connect to database" . mysql_error());
      }

      $db = mysql_select_db(DB_NAME, $con);
      if (!$db) {
        die("Cannot use " . DB_NAME . " " . mysql_error());
      }

      if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $find = $_POST['find'];
        $story = $_POST['story'];
        $email = $_POST['email'];
      }

      $sql = "INSERT INTO stories (Name, Find, Story, Email) VALUES ('$name', '$find', '$story', '$email')";

      if(!mysql_query($sql)) {
        die("Error " . mysql_error());
      }

      mysql_close($con);
    ?>
		<script>
			$(document).ready(function() {
				var height = $(window).height();

				$('#submit').css('height', height);
				$('#submit .inner').css('top', height/2-100);
			});
		</script>

  </body>
</html>
