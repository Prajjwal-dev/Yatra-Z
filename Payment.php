<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Booking";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT email, start_date, trip_duration, return_date, guide_name, food_preference, activity, cost FROM booked_user WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($email, $start_date, $trip_duration, $return_date, $guide_name, $food_preference, $activity, $cost);
$stmt->fetch();
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="payment_style.css">
    <title>Payment Receipt</title>
</head>
<body>
    <div class="payment-success-container">
        <img src="img/check.png" alt="Payment Success Image">
        <h2>Payment Successful!</h2>
        <p>Thank you for your booking.</p>

        <h3>Booking Details</h3>
<p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
<p><strong>Start Date:</strong> <?php echo htmlspecialchars($start_date); ?></p>
<p><strong>Duration:</strong> <?php echo htmlspecialchars($trip_duration); ?> days</p>
<p><strong>Return Date:</strong> <?php echo htmlspecialchars($return_date); ?></p>
<p><strong>Guide:</strong> <?php echo htmlspecialchars($guide_name); ?></p>
<p><strong>Food Preference:</strong> <?php echo htmlspecialchars($food_preference); ?></p>
<p><strong>Activity:</strong> <?php echo htmlspecialchars($activity); ?></p>
<p><strong>Total Cost:</strong> <span class="price-tag">$<?php echo htmlspecialchars($cost); ?></span></p>


        <button class="go-to-fine-portal-button" onclick="window.location.href='index.html'">Go to Home</button>
    </div>
</body>
</html>
