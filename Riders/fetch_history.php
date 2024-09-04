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

$query = "SELECT * FROM ride_requests WHERE rider_id = ? AND status = 'accepted'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $rider_id);
$stmt->execute();
$result = $stmt->get_result();

$rides = [];
while ($row = $result->fetch_assoc()) {
    $rides[] = $row;
}

echo json_encode($rides);
?>
