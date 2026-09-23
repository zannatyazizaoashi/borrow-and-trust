<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $nid = $_POST['nid'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo "<script>alert('Email already registered. Please log in.'); window.location='login.php';</script>";
        exit();
    }

    $sql = "INSERT INTO users (name, email, password, nid, phone, address, trust_score)
            VALUES ('$name', '$email', '$password', '$nid', '$phone', '$address', 50)";

    if ($conn->query($sql)) {
        echo "<script>alert('Registration successful! Please log in.'); window.location='login.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Borrow and Trust</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <style>
        body {
            background: #0d1b2a;
            color: white;
            font-family: 'Orbitron', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: rgba(255,255,255,0.06);
            padding: 30px;
            border-radius: 10px;
            width: 400px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: none;
        }
        button {
            background-color: #00ffff;
            color: black;
            font-weight: bold;
        }
        button:hover {
            background-color: #00cccc;
        }
        h2 {
            text-align: center;
            color: #00ffff;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Create New Account</h2>
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="nid" placeholder="National ID" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <input type="text" name="address" placeholder="Address" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>
