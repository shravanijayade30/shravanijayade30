<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Schedule - CheckMyBus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('colourbg1.jpg');
            background-size: cover;
            color: white;
            margin: 0;
            padding: 0;
        }
        .navbar, .footer {
            background: rgba(0, 0, 0, 0.7);
            padding: 10px;
            text-align: center;
        }
        .footer a {
            color: #005b99;
            text-decoration: none;
        }
        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            padding: 15px;
            margin-top: 50px;
        }
        .Bus-card {
            background-color: #fff;
            margin: 10px;
            padding: 15px;
            border-radius: 8px;
            color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-left: 5px solid #005b99;
        }
        .Bus-info {
            display: flex;
            justify-content: space-between;
        }
        .Bus-number, .days, .including, .timing {
            font-size: 18px;
        }
 /* Hide navbar */
 .navbar {
            display: none;
        }
        
    </style>
</head>

<body>

<div class="navbar">
    <a href="home.php">Home</a> | 
    <a href="about.php">About</a> | 
    <a href="Contact_us.php">Contact Us</a> | 
    <a href="feedback.php">Feedback</a>
</div>

<div class="header" id="route-header"></div>
<div id="Bus-schedule"></div>

<script>
    const source = localStorage.getItem('source');
    const destination = localStorage.getItem('destination');

    document.getElementById('route-header').innerText = `${source} ➔ ${destination}`;

    const BusData = {
        "Amravati to Yavatmal": [
            { number: "1", name: "Amravati to Yavatmal", departure: "2:30 PM", arrival: "4:30 PM", including: "Ner, Nandgaon", days: "Runs Daily" },
            { number: "2", name: "Amravati to Yavatmal", departure: "7:15 PM", arrival: "9:15 PM", including: "Ner, Nandgaon", days: "Runs Daily" }
        ],
        "Amravati to Anjangaon Surji": [
            { number: "11", name: "Amravati to Anjangaon Surji", departure: "2:30 PM", arrival: "5:00 PM", including: "Walgaon, Kholapur, Shingnapur, Khallara", days: "Runs Daily" },
            { number: "12", name: "Amravati to Anjangaon Surji", departure: "2:30 PM", arrival: "4:30 PM", including: "Aasegaon, Asadanpur", days: "Runs Daily" },
            { number: "13", name: "Amravati to Anjangaon Surji", departure: "6:30 PM", arrival: "8:45 PM", including: "Songaon, Khallar, Chandikapoor, Shignapur, Khartadegaon", days: "Runs Daily" },
            { number: "14", name: "Amravati to Anjangaon Surji", departure: "8:00 AM", arrival: "10:30 AM", including: "Wal, Shingna, Khallara", days: "Runs Daily" }
        ],
        "Amravati to Nagpur": [
            { number: "1", name: "Amravati to Nagpur", departure: "2:00 PM", arrival: "5:15 PM", including: "Tivsa, Karanja, Kodhali", days: "Runs Daily" },
            { number: "2", name: "Amravati to Nagpur", departure: "6:00 AM", arrival: "9:15 AM", including: "Tivsa, Karanja, Kodhali", days: "Runs Daily" },
            { number: "3", name: "Amravati to Nagpur", departure: "2:30 PM", arrival: "5:45 PM", including: "Tivsa, Karanja, Kodhali", days: "Runs Daily" },
            { number: "4", name: "Amravati to Nagpur", departure: "7:30 AM", arrival: "10:45 AM", including: "Tivsa, Karanja, Kodhali", days: "Runs Daily" }
        ],
        "Amravati to Paratwada": [
            { number: "5", name: "Amravati to Paratwada", departure: "2:30 PM", arrival: "3:45 PM", including: "Walgaon, Aasegaon, Bhogaon", days: "Runs Daily" },
            { number: "6", name: "Amravati to Paratwada", departure: "6:30 PM", arrival: "7:45 PM", including: "Walgaon, Aasegaon, Bhogaon", days: "Runs Daily" },
            { number: "7", name: "Amravati to Paratwada", departure: "1:00 PM", arrival: "2:15 PM", including: "Walgaon, Aasegaon, Bhogaon", days: "Runs Daily" },
            { number: "8", name: "Amravati to Paratwada", departure: "4:00 PM", arrival: "5:15 PM", including: "Walgaon, Aasegaon, Bhogaon", days: "Runs Daily" },
            { number: "9", name: "Amravati to Paratwada", departure: "8:00 AM", arrival: "9:15 AM", including: "Walgaon, Aasegaon, Bhogaon", days: "Runs Daily" },
            { number: "10", name: "Amravati to Paratwada", departure: "10:15 AM", arrival: "11:25 AM", including: "Walgaon, Aasegaon, Bhogaon", days: "Runs Daily" }
        ],
        "Amravati to Akot": [
            { number: "11", name: "Amravati to Akot", departure: "9:30 AM", arrival: "11:45 AM", including: "Daryapur", days: "Runs Daily" },
            { number: "12", name: "Amravati to Akot", departure: "6:00 AM", arrival: "8:15 AM", including: "Daryapur, Akot", days: "Runs Daily" },
            { number: "13", name: "Amravati to Akot", departure: "3:00 PM", arrival: "5:15 PM", including: "Daryapur", days: "Runs Daily" },
            { number: "14", name: "Amravati to Akot", departure: "2:15 PM", arrival: "4:30 PM", including: "Daryapur, Akot", days: "Runs Daily" }
        ],
        "Amravati to Akola": [
            { number: "3", name: "Amravati to Akola", departure: "9:30 AM", arrival: "11:30 AM", including: "Pathrot, Chandur", days: "Runs Daily" },
            { number: "4", name: "Amravati to Akola", departure: "2:15 PM", arrival: "4:15 PM", including: "Pathrot, Chandur", days: "Runs Daily" }
        ],
        "Nagpur to Amravati": [
            { number: "5", name: "Nagpur to Amravati", departure: "10:00 AM", arrival: "1:00 PM", including: "Karanja, Morshi", days: "Runs Daily" },
            { number: "6", name: "Nagpur to Amravati", departure: "5:00 PM", arrival: "8:00 PM", including: "Karanja, Morshi", days: "Runs Daily" }
        ],
        "Amravati to Murtijapur": [
            { number: "7", name: "Amravati to Murtijapur", departure: "8:00 AM", arrival: "9:30 AM", including: "Tivasa, Ner", days: "Runs Daily" },
            { number: "8", name: "Amravati to Murtijapur", departure: "1:30 PM", arrival: "3:00 PM", including: "Tivasa, Ner", days: "Runs Daily" }
        ],
        // Additional routes from the images
        "Amravati to Chandrapur": [
            { number: "9", name: "Amravati to Chandrapur", departure: "5:00 AM", arrival: "9:30 AM", including: "Warud, Katol", days: "Runs Daily" },
            { number: "10", name: "Amravati to Chandrapur", departure: "12:00 PM", arrival: "4:30 PM", including: "Warud, Katol", days: "Runs Daily" }
        ],
        "Akola to Yavatmal": [
            { number: "11", name: "Akola to Yavatmal", departure: "6:00 AM", arrival: "8:00 AM", including: "Washim, Pusad", days: "Runs Daily" },
            { number: "12", name: "Akola to Yavatmal", departure: "3:00 PM", arrival: "5:00 PM", including: "Washim, Pusad", days: "Runs Daily" }
        ],
        "Amravati to Wardha": [
            { number: "13", name: "Amravati to Wardha", departure: "9:00 AM", arrival: "11:00 AM", including: "Dhamangaon, Pulgaon", days: "Runs Daily" },
            { number: "14", name: "Amravati to Wardha", departure: "4:00 PM", arrival: "6:00 PM", including: "Dhamangaon, Pulgaon", days: "Runs Daily" }
        ],
        "Amravati to Buldhana": [
            { number: "15", name: "Amravati to Buldhana", departure: "7:30 AM", arrival: "10:00 AM", including: "Khamgaon, Shegaon", days: "Runs Daily" },
            { number: "16", name: "Amravati to Buldhana", departure: "1:30 PM", arrival: "4:00 PM", including: "Khamgaon, Shegaon", days: "Runs Daily" }
        ],
        "Nagpur to Wardha": [
            { number: "17", name: "Nagpur to Wardha", departure: "6:30 AM", arrival: "8:00 AM", including: "Seloo, Hinganghat", days: "Runs Daily" },
            { number: "18", name: "Nagpur to Wardha", departure: "3:30 PM", arrival: "5:00 PM", including: "Seloo, Hinganghat", days: "Runs Daily" }
        ]
    };

    function displayBusSchedule() {
        const routeKey = `${source} to ${destination}`;
        const scheduleContainer = document.getElementById('Bus-schedule');
        scheduleContainer.innerHTML = '';

        if (BusData[routeKey]) {
            BusData[routeKey].forEach(bus => {
                const busCard = document.createElement('div');
                busCard.className = 'Bus-card';

                busCard.innerHTML = `
                    <div class="Bus-info">
                        <div class="Bus-number">Bus ${bus.number}</div>
                        <div class="timing">${bus.departure} ➔ ${bus.arrival}</div>
                    </div>
                    <div class="including">Including Stops: ${bus.including}</div>
                    <div class="days">Days: ${bus.days}</div>
                `;
                scheduleContainer.appendChild(busCard);
            });
        } else {
            scheduleContainer.innerHTML = `<div class="Bus-card">No available buses for the selected route.</div>`;
        }
    }

    displayBusSchedule();
</script>
