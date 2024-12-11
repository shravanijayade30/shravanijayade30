<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}
$user = $_SESSION['user'];

// Determine the current page
$currentPage = basename($_SERVER['PHP_SELF']); // This will give you the current page's filename
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - CheckMyBus</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Navbar options */
        .navbar {
            display: flex;
            justify-content: space-between;
            width: 100%;
            background: rgba(0, 0, 0, 0.7);
            padding: 10px;
            position: fixed;
            top: 0;
            z-index: 1000;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            padding: 0 15px;
            transition: color 0.3s;
        }

        .navbar a.active {
            font-weight: bold;
            color: #add8e6; /* Optional: Change color for active link */
        }

        .navbar a:hover {
            color: #add8e6;
        }

        /* Logo and Title */
        .logo-title {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            color: white;
            font-size: 1.5em;
        }

        .logo-title img {
            height: 40px;
            margin-right: 10px;
        }

        /* Hamburger menu styling */
        .menu-icon {
            display: none;
            font-size: 2em;
            cursor: pointer;
            color: white;
        }

        /* Background and Box Styling */
        body {
            margin: 0;
            background-image: url('busbg2.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* MSRTC Contact Information Box */
        .contact-info-box {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            text-align: center;
            font-size: 1em;
            line-height: 1.6;
        }

        .contact-info-box h3 {
            font-size: 1.3em;
            margin-bottom: 10px;
        }

        .contact-info-box p {
            margin: 5px 0;
        }

        /* Mobile styles */
        @media (max-width: 768px) {
            .navbar-links {
                display: none;
                width: 100%;
                flex-direction: column;
                text-align: center;
                margin-top: 20px;
            }

            .navbar-links a {
                padding: 10px;
                font-size: 1.5em;
                border-bottom: 1px solid #ddd;
            }

            .menu-icon {
                display: block;
            }

            /* Adjust contact-info-box for mobile */
            .contact-info-box {
                max-width: 90%;
                font-size: 0.9em;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="home.php" class="<?php echo ($currentPage == 'home.php') ? 'active' : ''; ?>">Home</a>

        <!-- Centered Title and Logo -->
        <div class="logo-title">
            <img src="time1.png" alt="CheckMyBus Logo"> <!-- Replace with your logo file path -->
            CheckMyBus
        </div>

        <div class="navbar-links">
            <a href="about.php" class="<?php echo ($currentPage == 'about.php') ? 'active' : ''; ?>">About</a>
            <a href="Contact_us.php" class="<?php echo ($currentPage == 'Contact_us.php') ? 'active' : ''; ?>">Contact Us</a>
            <a href="feedback.php" class="<?php echo ($currentPage == 'feedback.php') ? 'active' : ''; ?>">Feedback</a>
        </div>

        <!-- Hamburger icon -->
        <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
    </div>

    <!-- Contact Information Box -->
    <div class="contact-info-box">
        <h3>Maharashtra State Road Transport Corporation</h3>
        <p>Maharashtra Transport Building, Dr. ANANDRAO NAIR MARG, MUMBAI CENTRAL, MUMBAI, 400 008</p>
        <p>EPABX No.: 22-23023900</p>
        <p>Website: <a href="http://www.msrtc.maharashtra.gov.in" target="_blank" style="color: #add8e6;">www.msrtc.maharashtra.gov.in</a></p>
    </div>

    <script>
        // Function to toggle the navbar menu on and off
        function toggleMenu() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('active');
        }
    </script>
</body>

</html>
