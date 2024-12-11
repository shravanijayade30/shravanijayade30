<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}
$user = $_SESSION['user'];

// List of available cities
$cities = [
    'Mumbai', 'Pune', 'Nagpur', 'Nashik', 'Amravati', 'Kolhapur', 'Yavatmal',
    'Paratwada', 'Asegaon', 'Wardha', 'Bhugaon', 'Walgaon', 'Kondhali', 'Karanja',
    'Tivsa', 'Parbhani', 'Washim', 'Hingoli', 'Mahur', 'Arni', 'Nanded',
    'KalamNuri', 'Daryapur', 'Akot', 'Takarkheda', 'Saur', 
    'Krishnapur', 'Lasnapur', 'Anjangaon Surji', 'Shingana', 'Shegaon', 
    'Murtijapur', 'Shingnapur', 'Khallar', 'Vathoda', 'Akola', 'Jalna', 
    'Chikhli', 'Khamgaon', 'jalgaon-Khandesh', 'Nandura', 'Bhusawal', 
    'Ner', 'Pandharpur', 'Morshi', 'Varud', 'Betul', 'Multai', 'Nandgaon', 
    'Pandharkawada', 'Hyderabad', 'Kamareddi', 'Bhopal', 'Chhatrapati Sambhaji Nagar (Aurangabad)', 
    'Mozari', 'Tapovaneshwar', 'Indla', 'Shirajgaon', 'Nibhari', 'Shindi', 
    'Rama', 'Katsur', 'Tapal', 'Yawali', 'Aashti', 'Mahuli', 'Algaon', 
    'Andgaon', 'Shendola', 'Dhamori', 'Arvi', 'Usada', 'Kapustalani', 
    'Malegaon', 'Shevati', 'Borgaon-Dharmale', 'Pandharkawda', 'Mardi', 
    'Hirapur', 'Chandur Bazar', 'HatKheda','Kholapur', 'Salora', 'Jawara', 'Fattepur', 
    'Pusad', 'Borala', 'Vaigaon', 'Virrshi', 'Donadfata', 'Savardi', 
    'Maurud', 'Jadka', 'Dhule', 'Parola', 'Malkapur', 'Dadhi', 'Dhamangaon', 
    'Bhatkuli', 'Belora', 'Adgaon', 'Ahmednagar', 'Bhankhedi', 'Sakholi', 
    'Hinganghat', 'Gondiya', 'Chandrapur', 'Tumsar', 'Ramtek', 'Telhara', 
    'Bhandara', 'Warud', 'Tiroda', 'Katol', 'Badnera', 'Vani'
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Buses - CheckMyBus</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Fullscreen background image */
        body {
            background-image: url('colourbg1.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            color: white;
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
            height: 40px;
            margin-right: 10px;
        }

        /* Search form styling */
        .search-form {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            margin: 100px auto;
            text-align: center;
        }

        .search-form select, .search-form input, .search-form button {
            padding: 10px;
            font-size: 1.1em;
            margin: 10px 0;
            width: 80%;
            border-radius: 5px;
        }

        .search-form button {
            background-color: #7d7d7d;
            color: white;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #07001f;
        }

        /* Show additional input fields conditionally */
        .additional-input {
            display: none;
        }
    
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="home.php">Home</a>
        <div class="logo-title">
            <img src="time1.png" alt="CheckMyBus Logo"> 
            CheckMyBus
        </div>
        <div class="navbar-links">
            <a href="about.php">About</a>
            <a href="Contact_us.php">Contact Us</a>
            <a href="feedback.php">Feedback</a>
        </div>
    </div>

    <!-- Search Form for Source and Destination -->
    <div class="search-form">
        <h2>Find Your Bus</h2>

        <!-- Form for source and destination selection -->
        <form action="search_results.php" method="POST" onsubmit="storeRoute()">
            <select id="source" name="source" required onchange="toggleInputField('source')">
                <option value="" disabled selected>Select Source</option>
                <?php foreach ($cities as $city) : ?>
                    <option value="<?php echo $city; ?>"><?php echo $city; ?></option>
                <?php endforeach; ?>
                <option value="other">Other</option>
            </select>
            <input type="text" id="sourceInput" name="sourceInput" class="additional-input" placeholder="Enter custom source">

            <select id="destination" name="destination" required onchange="toggleInputField('destination')">
                <option value="" disabled selected>Select Destination</option>
                <?php foreach ($cities as $city) : ?>
                    <option value="<?php echo $city; ?>"><?php echo $city; ?></option>
                <?php endforeach; ?>
                <option value="other">Other</option>
            </select>
            <input type="text" id="destinationInput" name="destinationInput" class="additional-input" placeholder="Enter custom destination">

            <button type="submit">Search</button>
        </form>
    </div>

    <script>
        // Toggle display of additional input fields based on dropdown selection
        function toggleInputField(type) {
            const selectElement = document.getElementById(type);
            const inputElement = document.getElementById(type + "Input");
            if (selectElement.value === "other") {
                inputElement.style.display = "block";
                inputElement.required = true;
            } else {
                inputElement.style.display = "none";
                inputElement.required = false;
            }
        }

        // Store source and destination in localStorage
        function storeRoute() {
            const source = document.getElementById('source').value === 'other' ? document.getElementById('sourceInput').value : document.getElementById('source').value;
            const destination = document.getElementById('destination').value === 'other' ? document.getElementById('destinationInput').value : document.getElementById('destination').value;
            localStorage.setItem('source', source);
            localStorage.setItem('destination', destination);
        }
    </script>
</body>

</html>
