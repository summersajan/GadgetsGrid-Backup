<?php
//$conn = new mysqli("localhost", "root", "", "gadget");

$conn = new mysqli("localhost", "u860864837_GadgetsGridU", "Wt9|1&Fj|!", "u860864837_Gadgets_GridDB");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>