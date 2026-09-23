<?php
session_start();
include 'config.php';

if ($_POST['otp'] == $_SESSION['otp']) {
    $email = $_SESSION['email'];
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        $conn->query("INSERT INTO users (email) VALUES ('$email')");
        $user = $conn->query("SELECT * FROM users WHERE email='$email'")->fetch_assoc();
    }

    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_name'] = $user['name'] ?? $email;

    if (!$user['nid']) {
        header("Location: complete_profile.php");
    } else {
        header("Location: index.php");
    }
} else {
    echo "Invalid OTP.";
}
?>
