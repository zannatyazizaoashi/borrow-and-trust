<?php
session_start();
include 'config.php';

// Automatically mark overdue requests
$today = date('Y-m-d');
$conn->query("UPDATE borrow_requests
              SET status = 'overdue'
              WHERE status = 'approved' AND due_date < '$today'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <style>
        body {
            background: #0d1b2a;
            color: white;
            font-family: 'Orbitron', sans-serif;
            padding: 30px;
        }
        h2 {
            color: #00ffff;
        }
        a {
            color: #00ffff;
            text-decoration: none;
        }
        table {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #1b263b;
            text-align: left;
        }
        th {
            background-color: #1b263b;
            color: #00ffff;
        }
        tr:hover {
            background-color: rgba(255,255,255,0.08);
        }
        .approved {
            color: #00ff99;
        }
        .returned {
            color: #9999ff;
        }
        .overdue {
            color: #ff4444;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Admin Panel - Borrow Activity</h2>
    <a href="index.php">← Back to Dashboard</a>
    <table>
        <tr>
            <th>User</th>
            <th>Email</th>
            <th>NID</th>
            <th>Item</th>
            <th>Status</th>
            <th>Due Date</th>
            <th>Action</th>
        </tr>
        <?php
        $sql = "SELECT r.*, u.name, u.email, u.nid, i.item_name
                FROM borrow_requests r
                JOIN users u ON r.user_id = u.user_id
                JOIN items i ON r.item_id = i.item_id
                ORDER BY r.request_date DESC";

        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
            $statusClass = strtolower($row['status']);
            echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['nid']}</td>
                <td>{$row['item_name']}</td>
                <td class='{$statusClass}'>{$row['status']}</td>
                <td>{$row['due_date']}</td>";
            if ($row['status'] === 'approved' || $row['status'] === 'overdue') {
                echo "<td><a href='return.php?id={$row['request_id']}'>Mark Returned</a></td>";
            } else {
                echo "<td>Returned</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
