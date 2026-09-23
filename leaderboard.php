<?php
include 'config.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <style>
        body {
            background: #0d1b2a;
            font-family: 'Orbitron', sans-serif;
            color: #fff;
            padding: 40px;
        }
        h2 {
            color: #00ffff;
            margin-bottom: 20px;
        }
        a {
            color: #00ffff;
            text-decoration: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #1b263b;
        }
        th {
            background-color: #1b263b;
            color: #00ffff;
        }
        tr:hover {
            background-color: rgba(255, 255, 255, 0.07);
        }
    </style>
</head>
<body>
    <a href="index.php">← Back to Dashboard</a>
    <h2>Top Trusted Users</h2>
    <table>
        <tr><th>Name</th><th>Email</th><th>Trust Score</th></tr>
        <?php
        $res = $conn->query("SELECT name, email, trust_score FROM users WHERE name IS NOT NULL ORDER BY trust_score DESC LIMIT 10");
        while ($row = $res->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['trust_score']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
