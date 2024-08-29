<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../Login/login.html');
    exit;
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'MamaJaba');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Retrieve rider information from the session
$rider_id = $_SESSION['rider_id'];
$rider_name = $_SESSION['name'];
$rider_contact = $_SESSION['contact'];

// Retrieve ride request details from POST request
$pick_up_location = $_POST['pick_up_location'] ?? '';
$drop_off_location = $_POST['drop_off_location'] ?? '';

if (empty($pick_up_location) || empty($drop_off_location)) {
    die('Please fill all required fields.');
}

// Insert ride request into database
$sql = "INSERT INTO ride_requests (rider_id, rider_name, rider_contact, pick_up_location, drop_off_location)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('issss', $rider_id, $rider_name, $rider_contact, $pick_up_location, $drop_off_location);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
