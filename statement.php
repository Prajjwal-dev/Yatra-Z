<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "booking";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['user_email'];

$sql = "SELECT * FROM booked_user WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL error: " . $conn->error);
}

$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="statement.css">
    <title>Booking Statement</title>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="header-left">
            <img src="img/logo.png" alt="Logo" class="logo">
            <span class="brand-name">Yatra-Z</span>
        </div>
        <div class="header-center">
            <h1>Booking Statement</h1>
        </div>
        <div class="header-right">
            <img src="img/profile_photo.jpeg" alt="Profile" class="profile-img">
            <span class="user-email"><?php echo htmlspecialchars($user_email); ?></span>
        </div>
    </header>
    
    <!-- Main Content -->
    <div class="container">
    <h2 class="section-title">Your Booked Trips</h2>
        <table>
            <thead>
                <tr>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
                    <th>Food Preferences</th>
                    <th>Guide</th>
                    <th>Activity</th>
                    <th>Total Cost</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['return_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['food_preference']); ?></td>
                        <td><?php echo htmlspecialchars($row['guide_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['activity']); ?></td>
                        <td>$<?php echo htmlspecialchars($row['cost']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <p class="footer-title">Yatra-Z</p>
                <p>Landing Page</p>
                <p>Exploration</p>
                <p>Reservation</p>
            </div>
            <div class="footer-column">
                <p class="footer-title">Trip Services</p>
                <p>Trip Booking</p>
                <p>Itinerary Planning</p>
                <p>Tourist Guide</p>
            </div>
            <div class="footer-column">
                <p class="footer-title">Contact Info</p>
                <p>support@yatraz.com</p>
                <p>+977 9876543210</p>
                <p>Kamalpokhari, Kathmandu</p>
            </div>
        </div>
    </footer>
</body>
</html>
