<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Log the user out
if(isUserLoggedIn())
{	session_destroy();
	$loggedInUser->userLogOut();
}

header('Location: ../index.php');

					die();
	

?>

