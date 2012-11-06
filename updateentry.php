<?php
session_start();

require("config.php");

if (isset($_SESSION['USERID']) == FALSE) {
    header("Location: " . $config_basedir);
}

$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

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

if ($validentry == 0) {
    header("Location: " . $config_basedir . "viewchp.php");
} else if ($_SESSION['USERID'] != $config_admin_id) {
    $sql = "SELECT entry_id FROM work_for WHERE user_id = " . $_SESSION['USERID'] . ";";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);

    if ($row['entry_id'] != $validentry) {
        header("Location: " . $config_basedir . "viewentry.php?id=" . $row['entry_id']);
    }
}
if ($_POST['submit']) {
    $sql = "UPDATE entries SET dateposted = NOW(), chapter_id = " . $_POST['chapter'] . ",
	subject = '" . $_POST['subject'] . "', body = '" . $_POST['body'] .
            "', donePercent = '" . $_POST['donePercent'] . "' WHERE id = " . $validentry . ";";
    mysql_query($sql);

    header("Location: " . $config_basedir . "viewentry.php?id=" . $validentry);
} else {

    require("header.php");

    $fillsql = "SELECT * FROM entries WHERE id = " . $validentry . ";";
    $fillres = mysql_query($fillsql);
    $fillrow = mysql_fetch_assoc($fillres);
    ?>

    <h1>Update Entry</h1>
    <?php
    $percentage = $fillrow['donePercent'];
    $done = $percentage * 2;
    $notdone = 200 - $done;
    $pimg1 = "pb1.jpg";
    $pimg2 = "pb2.jpg";
    $pimg3 = "pb3.jpg";
    echo "<img src = $pimg1>";
    for ($i = "1"; $i <= $done; $i++) {
        echo"<img src= $pimg2>";
    }
    for ($i = "1"; $i <= $notdone; $i++) {
        echo"<img src= $pimg3>";
    }
    echo"<img src=$pimg1>";
    if ($percentage != "100")
        echo '<span style = "color:red">You have completed ', $percentage, '%, get hard!</span>';
    else
        echo '<span style = "color:red">You have completed the work, congratulations!</span>';
    ?>
    <form action="<?php echo $SCRIPT_NAME . '?id=' . $validentry; ?>" method="post">

        <table>
            <tr>
                <td>Chapter</td>
                <td>
                    <select name="chapter">
                        <?php
                        $chpsql = "SELECT * FROM chapters;";
                        $chpres = mysql_query($chpsql);

                        while ($chprow = mysql_fetch_assoc($chpres)) {
                            echo "<option value='" . $chprow['id'] . "'";

                            if ($chprow['id'] == $fillrow['chapter_id']) {
                                echo "selected";
                            }

                            echo ">" . $chprow['chapter'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Subject</td>
                <td><input type="text" name="subject" value="<?php echo $fillrow['subject']; ?>"></td>
            </tr>
            <tr>
                <td>Body</td>
                <td><textarea name="body" rows="10" cols="50"><?php echo $fillrow['body']; ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2">After this time, you will complete <input type ="int" size ="1" name ="donePercent">%.</td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Update Entry!"></td>
            </tr>
        </table>
    </form>

    <?php
}

require("footer.php");
?>

