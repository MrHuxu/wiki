<head>
    <meta charset="utf-8" />
    <title>jQuery UI Datepicker - Default functionality</title>
    <link rel="stylesheet" href="jquery-ui.css" />
    <script src="jquery-1.8.2.js"></script>
    <script src="jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css" />
    <script>
        $(function() {
        $( "#datepicker" ).datepicker();
        });
    </script>
</head>
<?php
session_start();

require("config.php");

if ($_SESSION['USERID'] != $config_admin_id) {
    header("Location: " . $config_basedir);
}

$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

if ($_POST['submit']) {
    $_POST['eDeadline'] = date("Y-m-d", strtotime($_POST['eDeadline']));
    $sql = "INSERT INTO entries(chapter_id, dateposted, subject,  eDeadline) VALUES
		(" . $_POST['chapter'] . ", NOW(), '" . $_POST['subject'] . "','" . $_POST['eDeadline'] . "');";
    mysql_query($sql);

    $sql = "SELECT * FROM entries ORDER BY dateposted DESC LIMIT 1;";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    
    $sql = "INSERT INTO version_ctrl(content, entry_id, version_id, dateposted, donePercent) VALUES
        ('" . $_POST['body'] . "','".$row['id']."',1,NOW(), 0);";
    mysql_query($sql);

    header("Location: " . $config_basedir . "viewentry.php?id=" . $row['id']);
} else {

    require("header.php");
    ?>

    <h1>Add New Entry</h1>
    <form action="<?php echo $SCRIPT_NAME ?>" method="post">

        <table>
            <tr>
                <td>Chapter</td>
                <td>
                    <select name="chapter">
                        <?php
                        $chpsql = "SELECT * FROM chapters;";
                        $chpres = mysql_query($chpsql);
                        while ($chprow = mysql_fetch_assoc($chpres)) {
                            echo "<option value='" . $chprow['id'] . "'>" . $chprow['chapter'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Subject</td>
                <td><input type="text" name="subject"></td>
            </tr>
            <tr>
                <td>Body</td>
                <td><textarea name="body" rows="10" cols="50"></textarea></td>
            </tr>
            <tr>
                <td>Deadline</td>
                <td><input type ="date" name ="eDeadline"  id="datepicker"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Add Entry!"></td>
            </tr>
        </table>
    </form>

    <?php
}

require("footer.php");
?>
