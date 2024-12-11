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
    <title>About - CheckMyBus</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Fullscreen background image */
        .about-background {
            background-image: url('busbg2.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            color: white;
            text-align: left;
            padding: 20px;
        }

        .content {
            margin-top: 80px;
            width: 100%;
            text-align: center;
            color: white;
        }

        .about-text {
            font-size: 1.0em;
            max-width: 70%;
            margin: 20px auto;
        }

        .about-title {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .board-section {
            background: rgba(0, 0, 0, 0.7); /* Slightly transparent background */
            padding: 20px;
            border-radius: 10px;
            max-width: 70%;
            margin: 20px auto;
            color: white;
            text-align: left;
        }

        .board-title {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .board-member {
            margin-bottom: 10px;
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

        /* Mobile-specific styling */
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

            .navbar.active .navbar-links {
                display: flex;
            }

            /* Adjust board-section for mobile */
            .board-section {
                max-width: 140%; /* Wider on mobile */
                font-size: 0.6em; /* Slightly smaller text */
                padding: 15px; /* Less padding */
                background: rgba(0, 0, 0, 0.8); /* Darker background for readability */
            }

            /* Responsive alignment and font for about-text */
            .about-text {
                font-size: 0.9em;
                max-width: 90%;
                margin: 10px auto;
                text-align: center; /* Center-align on mobile */
            }

            /* About title font-size on mobile */
            .about-title {
                font-size: 1.8em;
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

    <!-- About Section -->
    <div class="about-background">
        <div class="content">
            <div class="about-title">Your Trusted Travel Companion</div>
            <div class="about-text">
                Check My Bus is a revolutionary bus scheduling web application located in Wani. Designed for MSRTC, it offers a seamless experience for travelers and drivers alike. With features such as registration, password recovery, and a comprehensive backend data storage, we ensure that every journey is smooth and hassle-free. Our user-friendly interface allows you to easily plan your trips and stay updated on bus schedules. Experience the future of travel with Check My Bus!
            </div>

            <!-- Board of Directors Section -->
            <div class="board-section">
                <div class="board-title">Board of Directors</div>
                <div class="board-member">1. Dr. Madhav Kusekar, IAS - Vice Chairman and Managing Director, MSRT Corporation</div>
                <div class="board-member">2. Shri. Sanjay Sethi, IAS - Government Director, Principal Secretary, Additional Chief Secretary of MSRT Corporation (Representative of State Government)</div>
                <div class="board-member">3. Shri Vivek Bhimanwar, IAS - Director of Government, Transport Commissioner, Maharashtra State, Mumbai. (State Government Representative)</div>
                <div class="board-member">4. Mr. H. P. Tummod, IAS - Government Director, Labor Commissioner, Maharashtra State, Mumbai. (State Government Representative)</div>
                <div class="board-member">5. Dr. Seema Sharma, IRTS - Government Director, Chief Commercial Manager (PS), Central Railway, Chhatrapati Shivaji Maharaj Terminus, Mumbai. (Representative of Central Government)</div>
                <div class="board-member">6. Mr. Paresh Kumar Goyal, Indian Defense Service - Director of Government, Director (Transport) New Delhi-11001 (Representative of Central Government)</div>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            c
