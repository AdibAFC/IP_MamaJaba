<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'MamaJaba');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch driver data
$sql = "SELECT RiderID, Picture, Name, Phone, Email FROM rider";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        // Check if the picture field is null or empty
        $picture = !empty($row['Picture']) ? $row['Picture'] : 'images/default.jpg';
        echo '<tr>';
        echo '<td>' . $row['RiderID'] . '</td>';
        echo '<td><img src="' . $picture . '" alt="Rider Picture" width="40" height="40"></td>';
        echo '<td>' . $row['Name'] . '</td>';
        echo '<td>' . $row['Phone'] . '</td>';
        echo '<td>' . $row['Email'] . '</td>';
        echo '<td>';
        echo '<button class="view-btnr"><i class="fa-regular fa-eye"></i></button>';
        echo '<button class="delete-btnr" data-id="' . $row['RiderID'] . '"><i class="fa-solid fa-trash"></i></button>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="8">No data available</td></tr>';
}

$conn->close();
?>
