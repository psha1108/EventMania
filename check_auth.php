<?php
// C:\xampp\htdocs\event-management\check_auth.php
require 'auth.php';

header('Content-Type: application/json');

echo json_encode([
    'loggedIn' => isLoggedIn(),
    'username' => $_SESSION['username'] ?? null
]);
?>