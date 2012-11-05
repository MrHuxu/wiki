<?php

session_start();

require("config.php");

if($_SESSION['USERID'] != $config_admin_id){
	header("Location: " . $config_basedir);
}

require("header.php");

$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

$sql = "SELECT applications.*, subject FROM entries, applications 
	WHERE id = entry_id ORDER BY time;";
$result = mysql_query($sql);
$numrows_entries = mysql_num_rows($result);

echo "<h1>Applications From Volunteers</h1>";
if($numrows_entries == 0)
	echo "<p><i><strong>No Applications!</strong></i></p>";

$count = 1;
while ($row = mysql_fetch_assoc($result)) {
echo "<i><h2>>>>Application #$count:</h2></i>";
echo "<i>On entry <a href='viewentry.php?id=" . $row['entry_id'] . "'>\"" . $row['subject'] . 
	"\"</a><br /> - Applied by <strong>" . $row['username'] . "</strong> On " . 
	date("D jS F Y g.iA", strtotime($row['time'])) . "</i>";

echo "<p>";
echo "<i>He/She said:</i><br /><strong>";
echo nl2br($row['details']);
echo "</strong></p>";

echo "<p>";
echo "[<a href='agree.php?id=" . $row['entry_id'] . "'>Agree</a>]";
echo "[<a href='disagree.php?id=" . $row['entry_id'] . "'>Disagree</a>]";
echo "</p>";

$count++;
}

require("footer.php");

?>
