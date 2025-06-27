<?php
session_start();
session_destroy();
header("Location: ../admin_login.php"); // Or wherever your login form is
exit;
?>