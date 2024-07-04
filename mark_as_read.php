<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false]);
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MamaJaba";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false]);
    exit;
}

$notification_id = $_GET['notification_id'];

$query = "UPDATE notifications SET is_read = 1 WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $notification_id);
$stmt->execute();
$stmt->close();

echo json_encode(['success' => true]);
$conn->close();
?>
