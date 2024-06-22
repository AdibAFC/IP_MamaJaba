<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate input
    if (empty($fname) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        die('Please fill all required fields.');
    }

    if ($password !== $confirm_password) {
        die('Passwords do not match.');
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Create a database connection
    $conn = new mysqli('localhost', 'root', '', 'MamaJaba');

    // Check the connection
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Get the max riderid from the rider table
        $result = $conn->query("SELECT MAX(riderid) AS max_riderid FROM rider");
        $row = $result->fetch_assoc();
        $max_riderid = $row['max_riderid'];
        $new_riderid = $max_riderid + 1;

        // Prepare and bind for the rider table
        $stmt = $conn->prepare("INSERT INTO rider (riderid, Name, Email, Phone, Password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $new_riderid, $fname, $email, $phone, $hashed_password);

        // Prepare and bind for the users table
        $stmt1 = $conn->prepare("INSERT INTO user (Email, Password, Role) VALUES (?, ?, ?)");
        $role = "rider";
        $stmt1->bind_param("sss", $email, $hashed_password, $role);

        // Begin transaction
        $conn->begin_transaction();

        try {
            // Execute the statements
            if ($stmt->execute() && $stmt1->execute()) {
                // Commit the transaction
                $conn->commit();
                echo "<script>
                alert('Registration Successful!');
                window.location.href = 'login.html';
              </script>";
                exit();
            } else {
                // Rollback the transaction if any statement fails
                $conn->rollback();
                echo "Error: " . $stmt->error . " / " . $stmt1->error;
            }
        } catch (Exception $e) {
            // Rollback the transaction in case of exception
            $conn->rollback();
            echo "Exception: " . $e->getMessage();
        }

        // Close the statements and connection
        $stmt->close();
        $stmt1->close();
        $conn->close();
    }
} else {
    echo "Invalid request method.";
}
?>
