<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $redirect_to = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : "booking.php"; // Default to booking.php

    // Dummy authentication (Replace with actual DB verification)
    if (!empty($email)) {
        $_SESSION['user_email'] = $email; // Store user email in session
        header("Location: " . $redirect_to); // Redirect based on login type
        exit();
    } else {
        $error_message = "Invalid email or password!";
    }
}

// Destroy session if the user is not logged in
if (!isset($_SESSION['user_email'])) {
    session_destroy();
}
?>
