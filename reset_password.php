<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];

    // Validate input
    if (empty($email) || empty($new_password)) {
        die('Please fill all required fields.');
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Create a database connection
    $conn = new mysqli('localhost', 'root', '', 'MamaJaba');

    // Check the connection
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Check the role of the user based on the email
    $stmt = $conn->prepare("SELECT role FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($role);
        $stmt->fetch();

        // Update the password in the user table
        $update_user_stmt = $conn->prepare("UPDATE user SET Password = ? WHERE Email = ?");
        $update_user_stmt->bind_param("ss", $hashed_password, $email);

        if ($update_user_stmt->execute()) {
            // Determine the table to update based on the role
            if ($role == 'driver') {
                $update_role_stmt = $conn->prepare("UPDATE driver SET Password = ? WHERE Email = ?");
            } elseif ($role == 'rider') {
                $update_role_stmt = $conn->prepare("UPDATE rider SET Password = ? WHERE Email = ?");
            } elseif ($role == 'admin') {
                $update_role_stmt = $conn->prepare("UPDATE admin SET password = ? WHERE email = ?");
            } else {
                die('Invalid role.');
            }

            // Bind the new password and email, and execute the update for the role-specific table
            $update_role_stmt->bind_param("ss", $hashed_password, $email);

            if ($update_role_stmt->execute()) {
                // Password update was successful
                header('Location: login.html');
                exit(); // Always use exit() after a redirect to ensure no further code is executed
            } else {
                // Password update failed
                echo 'Error updating password in the role-specific table.';
            }

            // Close the role update statement
            $update_role_stmt->close();
        } else {
            echo 'Error updating password in the user table.';
        }

        // Close the user update statement
        $update_user_stmt->close();
    } else {
        echo 'No user found with this email.';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request method.';
}
?>
