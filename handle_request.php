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

$request_id = isset($_POST['request_id']) ? intval($_POST['request_id']) : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';
$driver_id = isset($_SESSION['driver_id']) ? intval($_SESSION['driver_id']) : 0; // Assuming driver_id is stored in session

if ($request_id == 0 || empty($action)) {
    echo json_encode(['success' => false, 'message' => 'Invalid request parameters.']);
    exit;
}

if ($action == 'accept') {
    $stmt = $conn->prepare("UPDATE ride_requests SET status = 'accepted' WHERE id = ?");
    $stmt->bind_param("i", $request_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Fetch the driver's name
        $driver_stmt = $conn->prepare("SELECT name FROM driver WHERE driverid = ?");
        $driver_stmt->bind_param("i", $driver_id);
        $driver_stmt->execute();
        $driver_stmt->bind_result($driver_name);
        $driver_stmt->fetch();
        $driver_stmt->close();

        // Notify the rider about the acceptance
        $ride_stmt = $conn->prepare("SELECT rider_id, pick_up_location FROM ride_requests WHERE id = ?");
        $ride_stmt->bind_param("i", $request_id);
        $ride_stmt->execute();
        $ride_stmt->bind_result($rider_id, $location);
        $ride_stmt->fetch();
        $ride_stmt->close();

        // Get the max notification ID
        $result = $conn->query("SELECT MAX(id) AS max_id FROM notifications");
        $row = $result->fetch_assoc();
        $max_id = $row['max_id'];
        $new_id = $max_id + 1;

        $notification_msg = "$driver_name has accepted your ride request, please wait at the $location.";
        $notify_stmt = $conn->prepare("INSERT INTO notifications (id, rider_id, driver_id, msg, is_read) VALUES (?, ?, ?, ?, 0)");
        $notify_stmt->bind_param("iiis", $new_id, $rider_id, $driver_id, $notification_msg);
        $notify_stmt->execute();
        $notify_stmt->close();

        echo json_encode(['success' => true, 'message' => '<i class="fa-solid fa-circle-check"></i> Ride Request Accepted']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to accept ride request.']);
    }
    $stmt->close();
} elseif ($action == 'decline') {
    $stmt = $conn->prepare("INSERT INTO ride_request_declines (ride_request_id, driver_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $request_id, $driver_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => '<i class="fa-solid fa-circle-xmark"></i> Ride Request Declined']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to decline ride request.']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}

$conn->close();
?>
