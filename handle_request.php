<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to perform this action.']);
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MamaJaba";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// $action = $_POST['action'];
// $request_id = $_POST['request_id'];
$request_id = isset($_POST['request_id']) ? intval($_POST['request_id']) : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';


if ($action == 'accept') {
    $stmt = $conn->prepare("UPDATE ride_requests SET status = 'accepted' WHERE id = ?");
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Ride request accepted.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to accept ride request.']);
    }
    $stmt->close();
} elseif ($action == 'decline') {
    $stmt = $conn->prepare("INSERT INTO ride_request_declines (ride_request_id, driver_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $request_id, $driver_id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Ride request declined.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to decline ride request.']);
    }
    $stmt->close();
}

$conn->close();
?>
