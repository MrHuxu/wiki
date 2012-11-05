<?php
session_start();

require("config.php");

$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

?>

<html>
<head>
    
<title><?php echo $config_sitename; ?></title>
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
</head>
<body>
<div id="header">
<h1><?php echo $config_sitename; ?></h1>
</div>

<div id="menu">
<a href="index.php">Home</a>
&bull;
<a href="viewchp.php">Chapters</a>
&bull;
<?php

if(isset($_SESSION['USERID']) == TRUE){
	echo "<a href='logout.php'>Logout</a>";
}else{

	echo "<a href='login.php'>Login</a>";
}

if(@$_SESSION['USERID'] == $config_admin_id){
	echo " - ";
	echo "[<a href='addchp.php'>Add Chapter</a>]";
	echo "[<a href='addentry.php'>Add Entry</a>]";
	echo "[<a href='viewapp.php'>View Applications</a>]";
}

?>

</div>

<div id="container">
<div id="main">
