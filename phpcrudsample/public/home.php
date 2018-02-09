<?php
session_start();
include 'includes/security.php';
include 'includes/header.php';
session_regenerate_id(TRUE);
?>
<br><br>
<h1 style="text-align:center;">This is your Community Portal Home Page</h1>
<!-- !PAGE CONTENT! -->


<?php
include 'includes/footer.php';
?>
