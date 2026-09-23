<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Borrow and Trust</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <style>
        body {
            background: #0d1b2a;
            font-family: 'Orbitron', sans-serif;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.06);
            padding: 30px;
            border-radius: 10px;
            width: 350px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
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
        .error {
            background-color: #ff4d4d;
            padding: 8px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 10px;
        }
        .bottom-link {
            text-align: center;
            margin-top: 10px;
        }
        .bottom-link a {
            color: #00ffff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter password" required>
            <button type="submit">Login</button>
        </form>
        <div class="bottom-link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
