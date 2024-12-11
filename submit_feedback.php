<?php
// Start session and check if the user is logged in
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

require 'dbConnect.php'; // Include database connection

// Check if form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data
    $name = trim($_POST['name']);
    $number = trim($_POST['number']);
    $address = trim($_POST['address']);
    $message = trim($_POST['message']);

    // Validate form data
    if (empty($name) || empty($number) || empty($address) || empty($message)) {
        echo "All fields are required.";
        exit();
    }

    // Sanitize the input to prevent XSS or other attacks
    $name = htmlspecialchars($name);
    $number = htmlspecialchars($number);
    $address = htmlspecialchars($address);
    $message = htmlspecialchars($message);

    try {
        // Prepare SQL statement to insert data into the database
        $sql = "INSERT INTO feedbacks (name, number, address, message) VALUES (:name, :number, :address, :message)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters and execute the query
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            echo "Thank you for your feedback! It has been recorded.";
        } else {
            echo "There was an issue submitting your feedback. Please try again later.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
