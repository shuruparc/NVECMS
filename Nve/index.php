<?php
include 'templates/admin3/conn.php';
//header("location:".ADMIN_URL."index.php");
$redirectUrl=ADMIN_URL.'index.php';
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
?> 

