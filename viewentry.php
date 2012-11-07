<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <script language="javaScript">
            function doEcho(i){
                document.getElementById("a").innerHTML = i;
            }
        </script>
        <?php
        session_start();

        require("config.php");

        if (isset($_GET['id']) == TRUE) {
            if (is_numeric($_GET['id']) == FALSE) {
                $error = 1;
            }
            if ($error == 1) {
                header("Location: " . $config_basedir . "viewchp.php");
            } else {
                $validentry = $_GET['id'];
            }
        } else {
            $validentry = 0;
        }

        require("header.php");

        if ($validentry == 0) {
            header("Location: " . $config_basedir . "viewchp.php");
        } else {

            $sql = "SELECT entries.*, chapter FROM entries, chapters
			WHERE entries.chapter_id = chapters.id AND entries.id = " .
                    $validentry . ";";
        }

        $result = mysql_query($sql);
        $row = mysql_fetch_assoc($result);

        echo "<h2>" . $row['subject'] . "</h2><br />";
        echo "<i>In <a href='viewchp.php?id=" . $row['chapter_id'] . "'>
	Chapter " . $row['chapter_id'] . "</a> - Last modified on " .
        date("D jS F Y g.iA", strtotime($row['dateposted'])) . "</i>";

        $sql = "SELECT * FROM work_for WHERE user_id = " . $_SESSION['USERID'] .
                " AND entry_id = " . $validentry . ";";
        $result = mysql_query($sql);
        $numrows = mysql_num_rows($result);
        echo "<br /><br />";
        echo "HISTORY : ";
        echo '<a href ="javaScript:doEcho(\'' . $row['body'] . '\')" >1</a>'; 
        ?>
        <div id="a"></div>
        <?php
        if ($_SESSION['USERID'] == $config_admin_id || $numrows == 1) {
            echo " [<a href='updateentry.php?id=" . $row['id'] . "'>Edit</a>]";
        }

        $sql = "SELECT username FROM work_for, logins WHERE user_id = logins.id" .
                " AND entry_id = " . $validentry . ";";
        $result = mysql_query($sql);

        echo "<p>";
        if ($row = mysql_fetch_assoc($result)) {
            echo "&copy; " . $row['username'];
        } else {
            echo "[<a href='apply.php?id=" . $validentry . "'>Apply for authority</a>]";
        }
        echo "</p>";

        require("footer.php");
        ?>

    </body>
</html>