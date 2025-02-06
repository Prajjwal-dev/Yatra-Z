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

$cost = isset($_GET['cost']) ? $_GET['cost'] : 0; // Capture cost from URL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['user_email'];
    $start_date = $_POST['start_date'];
    $trip_duration = $_POST['trip_duration'];
    $return_date = $_POST['return_date'];
    $guide_name = $_POST['guide_name'];
    $food_preference = $_POST['food_preference'];
    $cost = $_POST['cost']; // Get cost from form input
    $activity = $_POST['activity']; // Get selected activity

    $stmt = $conn->prepare("INSERT INTO booked_user (email, start_date, trip_duration, return_date, guide_name, food_preference, cost, activity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssis", $email, $start_date, $trip_duration, $return_date, $guide_name, $food_preference, $cost, $activity);
    

    if ($stmt->execute()) {
        header("Location: payment.php?id=" . $stmt->insert_id);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatra-Z Booking</title>
    <link rel="stylesheet" href="booking.css">
</head>
<body>
    <header>
        <h1>Book Your Trip</h1>
        <div class="profile">
            <img src="img/profile_photo.jpeg" alt="Profile" class="profile-pic">
            <p><?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
            <a href="logout.php" class="logout-btn">Logout</a> <!-- Logout Link -->
        </div>
    </header>

    <div class="wrapper">
    <div class="container">
        <h2>Enter Your Trip Details</h2>
        <form action="booking.php" method="POST">
            <p><strong>Cost:</strong> <span class="price-tag" id="displayCost">$0</span></p>
            <input type="hidden" id="costInput" name="cost" value="">

            <input type="date" id="startDate" name="start_date" required>
            <input type="number" id="tripDuration" name="trip_duration" placeholder="Trip Duration (days)" required>
            <input type="date" id="returnDate" name="return_date" required>
            
            <button type="button" onclick="saveFormData(); window.location.href='guide.html'">Choose Guide</button>
            <input type="text" id="selectedGuide" name="guide_name" placeholder="Selected Guide" readonly required>

            <button type="button" onclick="saveFormData(); window.location.href='food_prefernce.html'">Select Food Preference</button>
            <input type="text" id="foodPreference" name="food_preference" placeholder="Selected Food" readonly required>
            <select name="activity" id="activity" required onchange="updateCost()">
    <optgroup label="Kathmandu">
        <option value="Boudhanath Stupa" data-price="50">Boudhanath Stupa - $50</option>
        <option value="Kathmandu Durbar Square" data-price="40">Kathmandu Durbar Square - $40</option>
        <option value="Pashupatinath Temple" data-price="60">Pashupatinath Temple - $60</option>
    </optgroup>
    <optgroup label="Pokhara">
        <option value="Phewa Lake" data-price="70">Phewa Lake - $70</option>
        <option value="Sarangkot" data-price="80">Sarangkot - $80</option>
        <option value="Davis Fall" data-price="90">Davis Fall - $90</option>
    </optgroup>
</select>


            <button type="submit">Confirm Booking</button>
        </form>
    </div>
</div>

    <footer>
        <div class="footer-container">
            <div class="footer">
                <div class="footer-div">
                    <div class="head"><p>Yatra-Z</p></div>
                    <h6>Product</h6>
                    <p>Landing Page</p>
                    <p>Exploration</p>
                    <p>Reservation</p>
                </div>
                <div class="footer-div">
                    <h6>Trip Services</h6>
                    <p>Trip Booking</p>
                    <p>Itinerary Planning</p>
                    <p>Tourist Guide</p>
                </div>
                <div class="footer-div">
                    <h6>Contact Info</h6>
                    <p>support@yatraz.com</p>
                    <p>+977 9876543210</p>
                    <p>Kamalpokhari, Kathmandu</p>
                </div>
            </div>
        </div>
    </footer>
    <script>
// Function to save form data in localStorage before navigating away
function saveFormData() {
    localStorage.setItem("startDate", document.getElementById("startDate").value);
    localStorage.setItem("tripDuration", document.getElementById("tripDuration").value);
    localStorage.setItem("returnDate", document.getElementById("returnDate").value);
    localStorage.setItem("foodPreference", document.getElementById("foodPreference").value);
    localStorage.setItem("selectedGuide", document.getElementById("selectedGuide").value);
    localStorage.setItem("tripCost", document.getElementById("costInput").value);
    localStorage.setItem("activity", document.getElementById("activity").value);
}

// Function to update cost dynamically based on selected activity
function updateCost() {
    const activityDropdown = document.getElementById("activity");
    const selectedOption = activityDropdown.options[activityDropdown.selectedIndex];
    const activityCost = selectedOption.getAttribute("data-price") || 0;

    localStorage.setItem("tripCost", activityCost);
    document.getElementById("costInput").value = activityCost;
    document.getElementById("displayCost").innerText = "$" + activityCost;
}

// Restore saved form data on page load
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("startDate").value = localStorage.getItem("startDate") || "";
    document.getElementById("tripDuration").value = localStorage.getItem("tripDuration") || "";
    document.getElementById("returnDate").value = localStorage.getItem("returnDate") || "";
    document.getElementById("foodPreference").value = localStorage.getItem("foodPreference") || "";
    document.getElementById("selectedGuide").value = localStorage.getItem("selectedGuide") || "";
    document.getElementById("activity").value = localStorage.getItem("activity") || "";

    // Restore and display cost
    const savedCost = localStorage.getItem("tripCost") || "0";
    document.getElementById("costInput").value = savedCost;
    document.getElementById("displayCost").innerText = "$" + savedCost;
});

// Prevent return date from being before start date
document.getElementById("returnDate").addEventListener("change", function () {
    if (this.value < document.getElementById("startDate").value) {
        alert("Return date cannot be before the start date!");
        this.value = "";
    }
});

// Update localStorage when activity changes
document.getElementById("activity").addEventListener("change", updateCost);
</script>

</body>
</html>
