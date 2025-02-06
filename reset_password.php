<?php
session_start();
$conn = new mysqli("localhost", "root", "", "registration_details");

if (!isset($_SESSION['email'])) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $new_password = $_POST['password'];

    // Update the password in plain text (not recommended for security)
    if ($conn->query("UPDATE users SET password='$new_password' WHERE email='$email'") === TRUE) {
        session_destroy();
        echo "<script>alert('Password reset successful!'); window.location='login.php';</script>";
    } else {
        $error_message = "Error updating password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            <form action="reset_password.php" method="POST">
                <div class="input-box">
                    <input type="password" name="password" placeholder="Enter new password" required>
                    <i class='bx bxs-lock'></i>
                </div>
                <button type="submit" class="btn">Reset Password</button>
                <?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>
            </form>
        </div>
    </main>
</body>
</html>
