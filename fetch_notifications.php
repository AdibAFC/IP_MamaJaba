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

$stmt = $conn->prepare("SELECT id, driver_id, msg, time FROM notifications WHERE rider_id = ? AND is_read = 0 ORDER BY time DESC");
$stmt->bind_param("i", $rider_id);
$stmt->execute();
$stmt->bind_result($id, $driver_id, $msg, $time);

$notifications = [];
while ($stmt->fetch()) {
    $notifications[] = [
        'id' => $id,
        'driver_id' => $driver_id,
        'msg' => $msg,
        'time' => $time
    ];
}

$stmt->close();
echo json_encode($notifications);
$conn->close();
?>
