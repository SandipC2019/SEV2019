<?php

//to prevent error.warning messages on page
error_reporting(0);

unset($_SESSION["username"]);
unset($_SESSION["streamer_name"]);
foreach(array_keys($_SESSION) as $k) 
{
	unset($_SESSION[$k]);
}
session_destroy();
$_SESSION = array();

header("Location: index.php");

?>

		