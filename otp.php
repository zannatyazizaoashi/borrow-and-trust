<?php
session_start();
$email = $_POST['email'];
$otp = rand(1000, 9999);  // Simulated OTP

$_SESSION['otp'] = $otp;
$_SESSION['email'] = $email;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enter OTP</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #0d1b2a, #1b263b);
            font-family: 'Orbitron', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }
        .otp-box {
            background: rgba(255, 255, 255, 0.06);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.2);
            text-align: center;
            width: 350px;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 6px;
            background: rgba(255,255,255,0.1);
            color: white;
        }
        button {
            padding: 10px 20px;
            background-color: #00ffff;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #00b7cc;
        }
    </style>
</head>
<body>
    <div class="otp-box">
        <h3>OTP sent to <?php echo $email; ?> (Simulated)</h3>
        <p><strong>OTP:</strong> <?php echo $otp; ?></p>
        <form method="POST" action="verify.php">
            <input type="text" name="otp" placeholder="Enter OTP" required><br>
            <button type="submit">Verify</button>
        </form>
    </div>
</body>
</html>
