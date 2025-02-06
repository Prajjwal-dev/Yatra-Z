<?php
// Start the session if needed
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<header>
    <div class="header-content">
        <img src="img/logo.png" alt="Yatra-Z Logo" class="logo">
        <h1>Signup</h1>
    </div>
</header>

    <!-- Main Content -->
    <main>
        <div class="wrapper">
            <form action="signup_process.php" method="POST">
                <div class="input-box">
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="last_name" placeholder="Last Name" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn">Sign Up</button>
                <div class="register-link">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
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
                    <address>Kamalpokhari, Kathmandu</address>
                </div>
                <div class="footer-div">
                    <h6>Social Media Links</h6>
                    <div class="links">
                        <img src="img/icons8-instagram-50.png" alt="Instagram" class="image">
                        <a href="#">instagram.com</a>
                    </div>
                    <div class="links">
                        <img src="img/facebook icon.png" alt="Facebook" class="image">
                        <a href="#">facebook.com</a>
                    </div>
                    <div class="links">
                        <img src="img/icons8-twitter-50.png" alt="Twitter" class="image">
                        <a href="#">Twitter.com</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
