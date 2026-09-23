<?php
$servername = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$dbname = getenv('DB_NAME') ?: 'Borrow_and_Trust';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Database connection failed. Check your local configuration.');
}
