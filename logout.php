<?php
// C:\xampp\htdocs\event-management\logout.php
require 'auth.php';
logout();
header("Location: index.php");
exit();
?>