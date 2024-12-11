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
    <title>Home - CheckMyBus</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Fullscreen background image */
        .home-background {
            background-image: url('busbg2.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Align content to the left */
            justify-content: flex-start; /* Align content to the top */
            color: white;
            text-align: left; /* Align text to the left */
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

        /* Active link style */
        .navbar a.active {
            font-weight: bold;
            color: #add8e6;
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
            height: 40px; /* Adjust the size of the logo */
            margin-right: 10px;
        }

        /* Scrolling Notification */
        .notification {
            width: 100%;
            background-color: #333;
            color: white;
            text-align: center;
            font-size: 1.5em;
            padding: 10px 0;
            position: absolute;
            top: 80px; /* Adjust this to position the notification just below the logo */
            white-space: nowrap;
            overflow: hidden;
            box-sizing: border-box;
        }

        .notification p {
            display: inline-block;
            padding-left: 100%;
            animation: scroll-left 20s linear infinite;
        }

        /* Scroll animation */
        @keyframes scroll-left {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
        

        /* Hamburger menu styling */
        .menu-icon {
            display: none;
            font-size: 2em;
            cursor: pointer;
            color: white;
        }

        /* Travel quote styling */
        .quote {
            font-size: 2em;
            font-weight: bold;
            max-width: 80%;
            margin-top: 110px; /* Adjusted margin to make space for the notification */
        }

        /* Search bus button styling */
        .search-bus-btn {
            background-color: #7d7d7d;
            border: none;
            padding: 15px 40px;
            font-size: 1.2em;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s;
            margin-top: 30px;
        }

        .search-bus-btn:hover {
            background-color: #07001f;
        }

        /* To push content below navbar */
        .content {
            margin-top: 70px; /* Adjust this based on navbar height */
            width: 100%;
            text-align: center;
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

    <!-- Scrolling Notification -->
    <div class="notification">
        <p>🚨 Don't miss out on our latest bus routes! Check out new travel offers now! 🚨</p>
    </div>

    <!-- Home Background Section -->
    <div class="home-background">
        <div class="quote">EXPLORE YOUR BUSES...</div>
        <div class="quote">From city streets to scenic routes your ride is ready.</div>

        <!-- Welcome Text -->
        <p>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</p>

        <!-- Search Bus Button -->
        <a href="search_buses.php">
            <button class="search-bus-btn">Search Buses</button>
        </a>
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
