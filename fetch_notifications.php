<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo json_encode([]);
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MamaJaba";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$rider_id = $_SESSION['rider_id'];

$stmt = $conn->prepare("SELECT msg FROM notifications WHERE rider_id = ? AND is_read = 0");
$stmt->bind_param("i", $rider_id);
$stmt->execute();
$stmt->bind_result($message);

$notifications = [];
while ($stmt->fetch()) {
    $notifications[] = ['message' => $message];
}

$stmt->close();

if (!empty($notifications)) {
    // Mark notifications as viewed
    $update_stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE rider_id = ?");
    $update_stmt->bind_param("i", $rider_id);
    $update_stmt->execute();
    $update_stmt->close();
}

echo json_encode($notifications);
$conn->close();
?>
