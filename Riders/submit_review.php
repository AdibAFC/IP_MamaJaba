<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['rider_id'])) {
        die('Rider not logged in.');
    }

    $rider_id = $_POST['rider_id'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    // Validate input
    if (empty($rating) || empty($review_text)) {
        die('Please fill all required fields.');
    }

    // Create a database connection
    $conn = new mysqli('localhost', 'root', '', 'MamaJaba');

    // Check the connection
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Check if the rider has already submitted a review
    $stmt = $conn->prepare("SELECT * FROM reviews WHERE rider_id = ?");
    $stmt->bind_param("i", $rider_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Update the existing review
        $stmt = $conn->prepare("UPDATE reviews SET rating = ?, review_text = ? WHERE rider_id = ?");
        $stmt->bind_param("isi", $rating, $review_text, $rider_id);
    } else {
        // Insert a new review
        $stmt = $conn->prepare("INSERT INTO reviews (rider_id, rating, review_text) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $rider_id, $rating, $review_text);
    }

    if ($stmt->execute()) {
        echo 'Review submitted successfully.';
    } else {
        echo 'Failed to submit review: ' . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
