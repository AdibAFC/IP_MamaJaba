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
$sql = "SELECT DriverID, Picture, Name, Phone, Rickshaw_Model, Licence, Experience FROM driver";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['DriverID'] . '</td>';
        echo '<td><img src="' . $row['Picture'] . '" alt="" width="40" height="40"></td>';
        echo '<td>' . $row['Name'] . '</td>';
        echo '<td>' . $row['Phone'] . '</td>';
        echo '<td>' . $row['Rickshaw_Model'] . '</td>';
        echo '<td>' . $row['Licence'] . '</td>';
        echo '<td>' . $row['Experience'] . '</td>';
        echo '<td>';
        echo '<button><i class="fa-regular fa-eye"></i></button>';
        echo '<button class="delete-btn"><i class="fa-solid fa-trash"></i></button>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="8">No data available</td></tr>';
}

$conn->close();
?>
