<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

//File directory information
//Put your file directory here



$db_host = "localhost"; //Host address (most likely localhost)
$db_name = "user736_db1"; //Name of Database
$db_user = "user736"; //Name of database user
$db_pass = "F2mlW2Er"; //Password for database user
$db_table_prefix = "uc_";

/*
//Database Information
$db_host = "localhost"; //Host address (most likely localhost)
$db_name = "texteditor"; //Name of Database
$db_user = "root"; //Name of database user
$db_pass = ""; //Password for database user
$db_table_prefix = "uc_";
*/

GLOBAL $errors;
GLOBAL $successes;

$errors = array();
$successes = array();

/* Create a new mysqli object with database connection parameters */
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
GLOBAL $mysqli;

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
}

//Direct to install directory, if it exists
if(is_dir("install/"))
{
	header("Location: install/");
	die();

}

?>