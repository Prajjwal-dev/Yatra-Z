<?php
session_start();
$conn = new mysqli("localhost", "root", "", "registration_details");

if (!isset($_SESSION['email'])) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $otp = $conn->real_escape_string($_POST['otp']);

    $result = $conn->query("SELECT * FROM OTP WHERE email='$email' AND otp='$otp'");

    if ($result->num_rows > 0) {
        $conn->query("DELETE FROM OTP WHERE email='$email'");  // OTP used, remove it
        header("Location: reset_password.php");
        exit();
    } else {
        $error_message = "Invalid OTP!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="header-content">
            <img src="assets/logo.png" alt="Yatra-Z Logo" class="logo">
            <h1>Yatra-Z</h1>
        </div>
    </header>

    <main>
        <div class="wrapper">
            <form action="verify_otp.php" method="POST">
                <div class="input-box">
                    <input type="text" name="otp" placeholder="Enter OTP" required>
                    <i class='bx bxs-lock'></i>
                </div>
                <button type="submit" class="btn">Verify OTP</button>
                <?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>
            </form>
        </div>
    </main>
</body>
</html>
