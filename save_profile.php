<?php
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$nid = $_POST['nid'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$conn->query("UPDATE users SET name='$name', nid='$nid', phone='$phone', address='$address' WHERE user_id=$user_id");

$_SESSION['user_name'] = $name;

header("Location: index.php");
?>
