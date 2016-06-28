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
    <?php
      require_once("StoriesConnection.php");

      $connection = new StoriesConnection();
      $connection->submit($_POST["name"], $_POST["beginning"], $_POST["persevered"], $_POST["growth"], $_POST["email"]);

			$subject = "New Story Submission: " . $_POST["name"];

			$message = '<html>
			<head>
			  <title>New Story Submission: ' . $_POST["name"] . '</title>
			</head>
			<body>
			  <h3>What is your name?</h3><br><p>' . $_POST["name"] . '</p><br><br>
				<h3>Where does your story begin? Describe that season…</h3><br><p>' . $_POST["beginning"] . '</p><br><br>
				<h3>Can you further describe how you persevered during that season?</h3><br><p>' . $_POST["persevered"] . '</p><br><br>
				<h3>How did that season change you and impact your story? Where were you before? Where are you now?</h3><br><p>' . $_POST["growth"] . '</p><br><br>
				<h3>What is your email address?</h3><br><p>' . $_POST["email"] . '</p>
			</body>
			</html>';

			// In case any of our lines are larger than 70 characters, we should use wordwrap()
			$message = wordwrap($message, 70, "\r\n");

			// Send
			mail('zac.conant@journeychurch.tv', $subject , $message);
    ?>

    <section id="submit" class="bg-img text-center">
      <div class="inner">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
              <p>Thank you for sharing your story! We will be in touch with you concerning the next steps. Your story was made to be told.</p><br><br>
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
