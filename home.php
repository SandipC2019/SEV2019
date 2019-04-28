<?php
//home.php

//to prevent error.warning messages on page
error_reporting(0);

//set timeout for 1 year
$session_expiration = time() + 3600 * 24 * 365; 
ini_set('session.gc_maxlifetime', $session_expiration);
session_set_cookie_params($session_expiration);

//start the session
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head style="background-color: rgb(205,205,205);>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Home</title>
</head>
	<div  align="right">
		<a href="<?php echo htmlspecialchars("logout.php");?>" 
		style="color: #6441A4; font-size: 20px; font-weight: bold; margin-right:20px;">Logout</a>
	</div>
	<div style="background-color: #6441A4; margin-top: 20px; height:560px; padding-top: 20px;" align="center">
	<?php
	if(isset($_SESSION['username']) && isset($_SESSION['streamer_name'])) {
		
	?>
		<div style="color: cyan; font-size: 20px; font-weight: bold; padding-bottom: 10px;">
			<?php echo "Hi, ".$_SESSION['username'].". You are watching your favorite streamer: ".$_SESSION['streamer_name'];?>
		</div>
		<!-- Add a placeholder for the Twitch embed -->
		<div id="twitch-embed"></div>

		<!-- Load the Twitch embed script -->
		<script src="https://embed.twitch.tv/embed/v1.js"></script>

		<!--
		  Create a Twitch.Embed object that will render
		  within the "twitch-embed" root element.
		-->
		<script type="text/javascript">
		  var embed = new Twitch.Embed("twitch-embed", {
			width: 1100,
			height: 480,
			channel: "<?php echo $_SESSION['streamer_name']; ?>",
			layout: "video-with-chat",
			chat: "default",
			autoplay: false
		  });

		  embed.addEventListener(Twitch.Embed.VIDEO_READY, () => {
			var player = embed.getPlayer();
			player.play();
		  });
		</script>
	<?php
	}
	else
	{
		echo "Please Authenticate";
	}

	?>
  </body>
</html>