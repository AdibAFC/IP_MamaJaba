<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $driverID = $_POST['DriverID'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'MamaJaba');

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Delete driver data
    $sql = "DELETE FROM driver WHERE DriverID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $driverID);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 'Success';
    } else {
        echo 'Failed';
    }

    $stmt->close();
    $conn->close();
}
?>
