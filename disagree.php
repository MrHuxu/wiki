<?php
session_start();

require("config.php");

if($_SESSION['USERID'] != $config_admin_id){
	header("Location: " . $config_basedir);
}

require("header.php");

$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

$sql = "DELETE FROM applications WHERE entry_id='" . $_GET['id'] . "';";
mysql_query($sql);

header("Location: " . $config_basedir. "viewapp.php");
?>
