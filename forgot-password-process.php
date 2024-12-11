<?php
require_once 'dbConnect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $birthdate = $_POST['birthdate'];
    
    // Check if email and birthdate match in database
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email AND birthdate = :birthdate");
    $stmt->execute(['email' => $email, 'birthdate' => $birthdate]);
    $user = $stmt->fetch();
    
    if ($user) {
        // Store email in session and redirect to create new password page
        $_SESSION['reset_email'] = $email;
        header('Location: reset-password.php');
        exit();
    } else {
        echo "No account found with that email and birthdate.";
    }
}
?>
