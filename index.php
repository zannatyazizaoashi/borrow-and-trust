<?php
session_start();
include 'config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get trust score
$user_id = $_SESSION['user_id'];
$res = $conn->query("SELECT trust_score FROM users WHERE user_id = $user_id");
$row = $res->fetch_assoc();
$trust = $row['trust_score'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <style>
        body {
            background: #0d1b2a;
            font-family: 'Orbitron', sans-serif;
            color: #fff;
            padding: 30px;
        }
        a {
            color: #00ffff;
            text-decoration: none;
            font-weight: bold;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar div a {
            margin-left: 15px;
        }
        .search-box {
            margin: 25px 0;
        }
        input[type="text"] {
            padding: 8px;
            border-radius: 6px;
            border: none;
            margin-right: 10px;
            width: 250px;
        }
        button[type="submit"] {
            padding: 8px 12px;
            background-color: #00ffff;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            color: #000;
            cursor: pointer;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .item {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,255,255,0.05);
        }
        .item h3 {
            color: #00ffff;
            margin-bottom: 10px;
        }
        .item p {
            font-size: 14px;
            margin-bottom: 15px;
        }
        .item form button {
            padding: 8px 16px;
            background-color: #00ffff;
            color: #000;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .item form button:hover {
            background-color: #00b7cc;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <h2>Welcome, <?php echo $_SESSION['user_name']; ?> (Trust Score: <?php echo $trust; ?>)</h2>
        <div>
            <a href="logout.php">Logout</a>
            <a href="leaderboard.php">Leaderboard</a>
        </div>
    </div>

    <div class="search-box">
        <form method="GET">
            <input type="text" name="q" placeholder="Search items...">
            <button type="submit">Search</button>
        </form>
    </div>

    <h3 style="margin-top: 30px;">Available Items:</h3>

    <div class="grid">
    <?php
    $q = $_GET['q'] ?? '';
    $sql = "SELECT * FROM items WHERE available=1 AND item_name LIKE '%$q%'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<div class='item'>
                <h3>{$row['item_name']}</h3>
                <p>{$row['description']}</p>
                <form method='POST' action='request.php'>
                    <input type='hidden' name='item_id' value='{$row['item_id']}'>
                    <button type='submit'>Request</button>
                </form>
              </div>";
    }
    ?>
    </div>
</body>
</html>
