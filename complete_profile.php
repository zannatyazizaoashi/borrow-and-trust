<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Complete Your Profile</title>
</head>
<body>
    <h2>Enter Your Details</h2>
    <form method="POST" action="save_profile.php">
        Full Name: <input type="text" name="name" required><br><br>
        National ID: <input type="text" name="nid" required><br><br>
        Phone: <input type="text" name="phone"><br><br>
        Address: <input type="text" name="address"><br><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
