<?php
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: admin.php");
    exit();
}

$request_id = $_GET['id'];

// Get item_id and user_id from the borrow record
$res = $conn->query("SELECT item_id, user_id FROM borrow_requests WHERE request_id=$request_id");
$data = $res->fetch_assoc();

$item_id = $data['item_id'];
$user_id = $data['user_id'];

// Update the borrow record as returned
$conn->query("UPDATE borrow_requests SET status='returned', return_date=NOW() WHERE request_id=$request_id");

// Set item as available again
$conn->query("UPDATE items SET available=1 WHERE item_id=$item_id");

// Increase trust score
$conn->query("UPDATE users SET trust_score = trust_score + 5 WHERE user_id=$user_id");

header("Location: admin.php");
?>
