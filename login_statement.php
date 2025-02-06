<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-content">
            <img src="img/logo.png" alt="Yatra-Z Logo" class="logo">
            <h1>Login</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="wrapper">
            <form action="login_process.php" method="POST">
                <input type="hidden" name="redirect_to" value="statement.php"> <!-- Hidden field for redirection -->
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="remember">Remember Me</label>
                    <a href="#">Forgot Password</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="register-link">
                    <p>Don't have an account? <a href="signup.php">Register</a></p>
                </div>
                <?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer">
                <div class="footer-div">
                    <div class="head">
                        <p>Yatra-Z</p>
                    </div>
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
</body>
</html>
