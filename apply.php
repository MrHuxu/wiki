<?php

require("config.php");

$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

if($_POST['submit']){
	$sql = "INSERT INTO applications(username, password, entry_id, details, time) VALUES
		('" . $_POST['username'] . "', '" . $_POST['password'] . "', " . $_GET['id'] .
		", '" . $_POST['details'] . "', NOW()" . ");";
	mysql_query($sql);
	
	header("Location: " . $config_basedir . "viewentry.php?id=" . $_GET['id']);
}else{

	require("header.php");
?>

<form action="<?php echo $SCRIPT_NAME ?>" method="post">

<table>
<tr>
	<td>Username</td>
	<td><input type="text" name="username" /></td>
</td>
<tr>
	<td>Password</td>
	<td><input type="password" name="password" /></td>
</tr>
<tr>
	<td>Details</td>
	<td><textarea name="details" rows="10" cols="50"></textarea></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" name="submit" value="Apply!" /></td>
</tr>
</table>
</form>

<?php
}

require("footer.php");

?>
