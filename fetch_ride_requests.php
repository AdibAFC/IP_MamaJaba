<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.html');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MamaJaba";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$driver_id = $_SESSION['driver_id']; // Assuming driver_id is stored in the session

// Modified SQL query to exclude ride requests declined by the current driver
$sql = "
    SELECT rr.*
    FROM ride_requests rr
    LEFT JOIN ride_request_declines rrd ON rr.id = rrd.ride_request_id AND rrd.driver_id = ?
    WHERE rr.status = 'pending' AND rrd.ride_request_id IS NULL
    ORDER BY rr.request_time DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $driver_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="ride-request" style="width: 700px;">';
        echo '<div class="ride-request-info">';
        echo '<img src="images/notification.png" alt="Rider\'s Image">';
        echo '<div class="ride-request-details">';
        echo '<h2>' . htmlspecialchars($row['pick_up_location']) . ' to ' . htmlspecialchars($row['drop_off_location']) . '</h2>';
        echo '<p style="margin-bottom: 20px;">A rider requested a ride</p>';
        echo '<p style="color: #515357;">' . htmlspecialchars($row['request_time']) . '</p>';
        echo '</div>';
        echo '</div>';
        // Update button to link to rider_details.php with the ride request ID
        echo '<button><a href="rider_details.php?id=' . htmlspecialchars($row['id']) . '" class="see-more">See More</a></button>';
        echo '</div>';
    }
} else {
    echo '<img src="images/driver_cartoon.gif" alt="Lonely Driver" class="lonely-driver">';
    echo '<p class="no-requests-message">No Ride Requests Available</p>';
}
echo '</main>';
$conn->close();
?>
