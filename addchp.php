<?php

session_start();

require("config.php");

if($_SESSION['USERID'] != $config_admin_id){
	header("Location: " . $config_basedir);
}

$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

if($_POST['submit']){
	$sql = "INSERT INTO chapters(chapter) VALUES('" . $_POST['chapter'] . "');";
	mysql_query($sql);
	header("Location: " . $config_basedir . "viewchp.php");
}else{
	
	require("header.php");
?>

<h1>Add New Chapter</h1>
<form action="<?php echo $SCRIPT_NAME ?>" method="post">

<table>
<tr>
	<td>Chapter</td>
	<td><input type="text" name="chapter" /></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" name="submit" value="Add Chapter!" /></td>
</tr>
</table>
</form>

<?php
}

require("footer.php");

?>

