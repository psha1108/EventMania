

<?php
$servername = "localhost"; // or 127.0.0.1
$username = "root"; // default for XAMPP
$password = ""; // default for XAMPP
$database = "event_management"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
