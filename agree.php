<?php

session_start();

require("config.php");

if($_SESSION['USERID'] != $config_admin_id){
	header("Location: " . $config_basedir);
}

require("header.php");

$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

$sql = "SELECT username, password FROM applications WHERE entry_id=" . $_GET['id'] . ";";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);

$sql = "INSERT INTO logins(username, password) VALUES('" . $row['username'] .
	"', '" . $row['password'] . "');";
mysql_query($sql);

$sql = "SELECT * FROM logins WHERE username='" . $row['username'] . "';";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);

$sql = "INSERT INTO work_for(user_id, entry_id) VALUES(" . $row['id'] .
	", " . $_GET['id'] . ");";
mysql_query($sql);

$sql = "DELETE FROM applications WHERE username='" . $row['username'] . "';";
mysql_query($sql);

header("Location: " . $config_basedir. "viewapp.php");
?>
