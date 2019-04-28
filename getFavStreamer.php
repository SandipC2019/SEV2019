<?php
//getFavStreamer.php

//to prevent error.warning messages on page
error_reporting(0);

//set timeout for 1 year
$session_expiration = time() + 3600 * 24 * 365; 
ini_set('session.gc_maxlifetime', $session_expiration);
session_set_cookie_params($session_expiration);

//start the session
session_start();

$errorMsg = null;
	/*if(isset($_POST['submit-login'])) {
		$username = $_POST['username'];
		$_SESSION['streamer_name'] = $username;
		echo("username: ".$username);
		//header("Location: home.php");
		header("Location: index.php");
	}*/

if(isset($_POST['submit-signUp'])) {
	if($_POST['username'] == null || $_POST['username'] == '')
	{
		$errorMsg = 'Please provide a streamer name';
	}
	else{
		$username = $_POST['username'];
		$_SESSION['streamer_name'] = $username;
		header("Location: home.php");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head style="background-color: rgb(205,205,205);>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Get Streamer Name</title>
	<style>
	.loginButtonStyle {
		display: block;
		min-width: 355px;
		height: 35px;
		padding: 0 0 3px 0;
		border-right-width: 0px;
		border-left-width: 0px;
		border-top-width: 0px;
		border-bottom-width: 0px;
		margin-top: 2px;
		margin-bottom: 2px;
		color: white;
		font-size: 13px;
		font-weight: bold;
		text-align: center;
		text-decoration: none;
		background: none;
		--background-color: #fb5820;
		--background-color: rgb(82,9,98);
		background-color: rgb(58,166,218);
		--background-color: rgb(75,36,151);
		cursor: pointer;
		--font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		font-family: CustomFont1, Arial, Helvetica, sans-serif;
	}

	.inputField {
		min-width: 355px;
		height: 32px;
		padding: 0 0 3px 0;
		border-right-width: 0px;
		border-left-width: 0px;
		font-size: 25px;
		font-weight: bold;
	}
	</style>
</head>
<body>
<?php
if(isset($_SESSION['username'])) {
	/*if(isset($_SESSION['streamer_name'])) {
		echo "Hi you are watching ".$_SESSION['streamer_name'];
	}
	else {*/
?>
	<div  align="right">
		<a href="<?php echo htmlspecialchars("logout.php");?>" style="color: #6441A4; font-size: 20px; font-weight: bold; margin-right:20px;">Logout</a>
	</div>
	<div style="background-color: #6441A4; margin-top: 20px; height:430px; padding-top: 150px;" align="center">
		<p style="color: #ffffff; font-size: 35px; font-weight: bold; "><?php echo 'Welcome ' . $_SESSION['username'];?> </p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="login_form">
			<table>
				<tr style="color: #ffffff; font-size: 25px; font-weight: bold; "><td>Favorite Streamer Name: </td></tr>
				<tr><td><input type="text" id="login_username" name="username" maxlength="50" class="inputField"/> </td></tr>
				<!--<tr><td><input type="submit" value="Enter" name="submit-login" class="loginButtonStyle"/> </td></tr>-->
			</table>
			<input type="submit" value="Submit" name="submit-signUp" id="submit-signUp" class="loginButtonStyle"/>
		</form>
		<p style="color: red; font-size: 15px; font-weight: bold;"><?php echo $errorMsg;?></p>
	</div>
<?php
}
else
{
	echo "Please Authenticate";
}

?>
</body>
</html>