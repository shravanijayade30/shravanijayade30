<?php
require_once 'dbConnect.php';
session_start();
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $name=$_POST['name'];
    $birthdate = $_POST['birthdate'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $created_at = date('Y-m-d H:i:s');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
      
    }
    if(empty($name)){
        $errors['name']='Name is required';
    }
    if (strlen($password) < 8 ) {
        $errors['password'] = 'Password must be at least 8 characters long.';
    }
    if ($password !== $confirmPassword) {
        $errors['confirm_password'] = 'Passwords do not match';
    }
    if (empty($birthdate)) {
        $errors['birthdate'] = 'Birthdate is required';
    }

    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
        $errors['user_exist'] = 'Email is already registered';
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: register.php');
        exit();
    }
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("INSERT INTO user (email, password,name,birthdate,created_at) VALUES (:email, :password, :name, :birthdate, :created_at)");
    $stmt->execute(['email' => $email, 'password' => $hashedPassword, 'name'=>$name,'birthdate' => $birthdate,'created_at'=>$created_at]);
    header('Location: index.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }
    if (empty($password)) {
        $errors['password'] = 'Password cannot be empty';
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: index.php');
        exit();
    }
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'name'=>$user['name'],
            'birthdate' =>$user['birthdate'],
            'created_at' => $user['created_at']
        ];
        header('Location: home.php');
        exit();
    } else {
        $errors['login'] = 'Invalid email or password';
        $_SESSION['errors'] = $errors;
        header('Location: index.php');
        exit();
    }
}