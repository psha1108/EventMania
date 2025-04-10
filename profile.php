<?php
// C:\xampp\htdocs\event-management\profile.php
require 'auth.php';

if(!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

require 'db.php';
$user_id = $_SESSION['user_id'];

// Get user details
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Get user bookings
$bookings = $conn->query("
    SELECT p.*, pk.name as package_name 
    FROM payments p
    JOIN packages pk ON p.package_id = pk.id
    WHERE p.user_id = $user_id
    ORDER BY p.payment_date DESC
")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">EventMania</div>
            <ul>
                <li><a href="index.php#home">Home</a></li>
                <li><a href="index.php#services">Services</a></li>
                <li><a href="index.php#packages">Packages</a></li>
                <li><a href="index.php#about">About</a></li>
                <li><a href="index.php#contact">Contact</a></li>
                <li id="auth-link"><a href="profile.php"><?php echo $_SESSION['username']; ?></a></li>
            </ul>
        </nav>
    </header>

    <main class="profile-container">
        <h1>My Profile</h1>
        
        <div class="profile-section">
            <div class="profile-info">
                <h2>Account Details</h2>
                <p><strong>Username</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Member since</strong> <?php echo date('M j, Y', strtotime($user['created_at'])); ?></p>
            </div>
            
            <div class="profile-bookings">
                <h2>My Bookings</h2>
                <?php if(count($bookings) > 0): ?>
                    <div class="bookings-list">
                        <?php foreach($bookings as $booking): ?>
                        <div class="booking-card">
                            <h3><?php echo htmlspecialchars($booking['package_name']); ?></h3>
                            <p><strong>Amount:</strong> $<?php echo number_format($booking['amount'], 2); ?></p>
                            <p><strong>Date:</strong> <?php echo date('M j, Y H:i', strtotime($booking['payment_date'])); ?></p>
                            <p><strong>Status:</strong> <?php echo $booking['status']; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>You haven't made any bookings yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>