<?php

require("config.php");

if (isset($_GET['id']) == TRUE) {
    if (is_numeric($_GET['id']) == FALSE) {
        $error = 1;
    }
    if ($error == 1) {
        header("Location: " . $config_basedir . "viewchp.php");
    } else {
        $validchp = $_GET['id'];
    }
} else {
    $validchp = 0;
}

require("header.php");

$sql = "SELECT * FROM chapters;";
$result = mysql_query($sql);
$numrows_entries = mysql_num_rows($result);

echo "<h1>Chapters Of The Book</h1>";

if ($numrows_entries == 0)
    echo "<p><i><strong>No Chapters!</strong></i></p>";

for ($i = 1; $row = mysql_fetch_assoc($result); $i++) {
    if ($validchp == $row['id']) {
        echo "<strong>" . "Chapter #$i . " . $row['chapter'] . "</strong><br />";

        $entriessql = "SELECT * FROM entries WHERE chapter_id = " . $validchp . ";";
        $entriesres = mysql_query($entriessql);
        $numrows_entries = mysql_num_rows($entriesres);

        echo "<ul>";

        if ($numrows_entries == 0) {
            echo "<li><i>No entries!</i></li>";
        } else {
            for ($j = 1; $entriesrow = mysql_fetch_assoc($entriesres); $j++) {
                $autsql = "SELECT username FROM work_for, logins WHERE user_id = logins.id" .
                        " AND entry_id = " . $entriesrow['id'] . ";";
                $autresult = mysql_query($autsql);
                $author = "";
                if ($autrow = mysql_fetch_assoc($autresult)) {
                    $author = " -- " . "&copy; " . $autrow['username'];
                }
                $deadline = $entriesrow['eDeadline'];
                $nowDate = date("Y-m-d");
                $startdate = strtotime($nowDate);
                $enddate = strtotime($deadline);
                $days = round(($enddate - $startdate) / 3600 / 24);
                echo "<li><i>$i.$j <a href='viewentry.php?id=" . $entriesrow['id'] .
                "'>" . $entriesrow['subject'] . "</a>$author     ($days days before the deadline)</i></li>";
            }
        }

        echo "</ul>";
    } else {

        echo "<a href='viewchp.php?id=" . $row['id'] . "'>" . "Chapter #$i . " .
        $row['chapter'] . "</a><br />";
    }
}

require("footer.php");
?>
