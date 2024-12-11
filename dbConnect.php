<?php
$host = "localhost";   // Database host
$dbname = 'auth';      // Database name
$username = 'root';    // Database username
$password = '';        // Database password

try {
    // Create a new PDO instance for the database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Handle any errors that occur during the connection attempt
    echo "Connection failed: " . $e->getMessage();
}
?>
