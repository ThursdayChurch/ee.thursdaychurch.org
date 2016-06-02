<?php
  require_once("StoriesConnection.php");

  $connection = new StoriesConnection();
  $connection->submit($_POST["name"], $_POST["beginning"], $_POST["persevered"], $_POST["growth"], $_POST["email"]);

  echo "Thank You For Submiting Your Story! Our Stories Team will be in touch";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width">

		<meta name="description" content="Share a story about how your life has been changed">
		<meta name="keywords" content="Stories Jesus Life Change Journey Church Norman OK">

		<title>Stories - What's Your Story?</title>

		{!-- Stylesheets --}
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<link rel="stylesheet" href="/_css/stories/style.css" type='text/css'>

		{!-- Fonts --}
		<link rel="stylesheet" type="text/css" href="//cloud.typography.com/6186432/688704/css/fonts.css" />

		{!-- Font Icons --}
		<link rel="stylesheet" href="/_css/font-awesome.css" type='text/css'>
	</head>
	<body>
    <section id="submit" class="bg-img text-center">
      <div class="inner">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <p>Thank you for sharing your story! It takes courage to shed light on a piece of yourself that's so personal.<br><br>By telling your story, you are helping us connect with you which is an integral part of who we are at Journey. We are on a mission to build healthy relationships. With your permission, of course, we would like to use some of these stories as a connection to others in the Church. This could be in the form of a video narrative, social media spotlight, or live interview.<br><br>If your story is selected, we will be in touch with you concerning next steps. Thank you again for your sharing your story. It was made to be told.</p><br><br>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
              <a href="/stories"><button class="btn btn-default btn-block">Share Another Story</button></a>
            </div>
          </div>
        </div>
      </div>
    </section>

		{!-- Jquery --}
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		{!-- Latest compiled and minified JavaScript --}
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</body>
</html>
