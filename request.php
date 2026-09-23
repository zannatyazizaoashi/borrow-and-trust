<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$item_id = $_POST['item_id'];

// Get user's trust score
$res = $conn->query("SELECT trust_score FROM users WHERE user_id = $user_id");
$user = $res->fetch_assoc();

if ($user['trust_score'] < 30) {
    echo "<script>alert('Your trust score is too low to borrow items.'); window.location.href='index.php';</script>";
    exit();
}

$due_date = date('Y-m-d', strtotime('+7 days'));

$conn->query("INSERT INTO borrow_requests (user_id, item_id, due_date, status)
              VALUES ($user_id, $item_id, '$due_date', 'approved')");

$conn->query("UPDATE items SET available = 0 WHERE item_id = $item_id");

header("Location: index.php");
?>
