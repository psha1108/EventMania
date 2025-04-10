<?php

require 'auth.php';

if (!isLoggedIn()) {
    header("Location: login.php?redirect=payment.php");
    exit();
}

$package_id = $_GET['package'] ?? 0;
$package = null;

// Fetch package from database
if ($package_id) {
    require 'db.php';
    $stmt = $conn->prepare("SELECT * FROM packages WHERE id = ?");
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $package = $result->fetch_assoc();
}


/*if(!$package) {
    header("Location: index.php");
    exit();
}*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guard against invalid packages
    if(!$package) {
        header("Location: index.php");
        exit();
    }

    // Process payment
    $user_id = $_SESSION['user_id'];
    $amount = $package['price'];

    require 'db.php';
    $stmt = $conn->prepare("INSERT INTO payments (user_id, package_id, amount, status) VALUES (?, ?, ?, 'completed')");
    $stmt->bind_param("iid", $user_id, $package_id, $amount);

    if ($stmt->execute()) {
        $payment_success = true;
    } else {
        $payment_error = "Payment failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Event Management</title>
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
                <li id="auth-link"><a href="logout.php"><?php echo $_SESSION['username']; ?> (Logout)</a></li>
            </ul>
        </nav>
    </header>

    <main class="payment-container">
        <?php if(isset($payment_success)): ?>
            <div class="payment-success">
                <h1>Payment Successful!</h1>
                <p>Thank you for booking our <?php echo htmlspecialchars($package['name']); ?> package.</p>
                <a href="index.php" class="btn">Back to Home</a>
            </div>
        <?php else: ?>
            <h1>Complete Your Booking</h1>
            
            <?php if(isset($payment_error)): ?>
                <div class="error"><?php echo $payment_error; ?></div>
            <?php endif; ?>
            
            <div class="payment-details">
                <div class="package-info">
                    <h2><?php echo htmlspecialchars($package['name']); ?></h2>
                    <p><?php echo htmlspecialchars($package['description']); ?></p>
                    <div class="price">$<?php echo number_format($package['price'], 2); ?></div>
                </div>
                
                <form method="POST" class="payment-form">
                    <h3>Payment Information</h3>
                    
                    <div class="form-group">
                        <label for="card-number">Card Number</label>
                        <input type="text" id="card-number" placeholder="1234 5678 9012 3456" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="expiry">Expiry Date</label>
                            <input type="text" id="expiry" placeholder="MM/YY" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="cvc">CVC</label>
                            <input type="text" id="cvc" placeholder="123" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Name on Card</label>
                        <input type="text" id="name" required>
                    </div>
                    <button type="submit" class="btn-pay">Pay $<?php echo number_format($package['price'], 2); ?></button>
                </form>
            </div>
        <?php endif; ?>
    </main>

    <script src="script.js"></script>
</body>
</html>