<?php

require("header.php");

?>

<i>
<h1>Hi! Welcome to our wiki site!</h1>
<h2><i>>>>Tips:</i></h2>

<ul>
<li>Click <strong>"Home"</strong> to back to this page</li>
<li>Click <strong>"Chapters"</strong> to view chapters and entries</li>
<li>Click <strong>"Login"</strong> to login if you already have an entry to edit, <strong>"Logout"</strong> is the same</li>
<li>Click <strong>"Apply for authority"</strong> blow every entry to apply for the authority of editing</li>
<li>The entry which has a "&copy;" symbol followed already has an editor</li>
<li>One entry can only have one editor, one person can only edit one entry</li>
</ul>
</i>

&copy; <strong><i><?php echo $config_admin_name;?></i></strong>
<?php

require("footer.php");

?>
