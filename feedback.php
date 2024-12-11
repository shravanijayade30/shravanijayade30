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
    <title>Feedback - CheckMyBus</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Fullscreen background image */
        .feedback-background {
            background-image: url('busbg2.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 20px;
        }

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

        /* Feedback Form Styling */
        .feedback-form {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            width: 100%;
        }

        .feedback-form h3 {
            margin-bottom: 15px;
            font-size: 1.5em;
            text-align: center;
        }

        .feedback-form label {
            font-size: 1em;
            margin-top: 10px;
            display: block;
        }

        .feedback-form input,
        .feedback-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: none;
            font-size: 1em;
        }

        .feedback-form textarea {
            resize: vertical;
            height: 100px;
        }

        .feedback-form button {
            background-color: #7d7d7d;
            border: none;
            padding: 10px;
            font-size: 1.2em;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
            transition: background-color 0.3s;
        }

        .feedback-form button:hover {
            background-color: #07001f;
        }

        /* Mobile menu styles */
        .navbar-links {
            display: flex;
            gap: 20px;
        }

        .navbar-links a {
            display: block;
        }

        @media (max-width: 768px) {
            /* Hide the regular navbar links on mobile */
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

            /* Show the hamburger icon */
            .menu-icon {
                display: block;
            }

            /* Show the navbar links when the menu is active */
            .navbar.active .navbar-links {
                display: flex;
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

    <!-- Feedback Form Section -->
    <div class="feedback-background">
        <div class="feedback-form">
            <h3>We Value Your Feedback And Queries</h3>

            <form action="submit_feedback.php" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="number">Phone Number</label>
                <input type="tel" id="number" name="number" required>

                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>

                <label for="message">Feedback / Queries</label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit">Send</button>
            </form>
        </div>
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
