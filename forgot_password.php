<?php
session_start();
$conn = new mysqli("localhost", "root", "", "registration_details");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;

        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP in the database
        $conn->query("INSERT INTO OTP (email, otp) VALUES ('$email', '$otp') ON DUPLICATE KEY UPDATE otp='$otp'");

        // Redirect to check_otp.php (email sending removed)
        header("Location: verify_otp.php");
        exit();
    } else {
        $error_message = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
            <form action="forgot_password.php" method="POST">
                <div class="input-box">
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <button type="submit" class="btn">Continue</button>
                <?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>
            </form>
        </div>
    </main>
</body>
</html>
