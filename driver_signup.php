<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['first-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $licence = $_POST['Licence'];
    $experience = $_POST['Experience'];
    $rickshaw_model = $_POST['rickshaw_model'];
    $password = $_POST['new-password'];
    $confirm_password = $_POST['cnew-password'];

    // Validate input
    if (empty($name) || empty($phone) || empty($password) || empty($confirm_password)) {
        die('Please fill all required fields.');
    }

    if ($password !== $confirm_password) {
        die('Passwords do not match.');
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Handle file upload
    if (isset($_FILES['profile-picture']) && $_FILES['profile-picture']['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['profile-picture']['tmp_name'];
        $file_name = $_FILES['profile-picture']['name'];
        $file_path = 'images/' . $file_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file_tmp, $file_path)) {
            $profile_picture = $file_path;
        } else {
            die('Failed to upload file.');
        }
    } else {
        $profile_picture = NULL;
    }

    // Create a database connection
    $conn = new mysqli('localhost', 'root', '', 'MamaJaba');

    // Check the connection
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Prepare and bind for the driver table
        $stmt = $conn->prepare("INSERT INTO driver (Name, Email, Phone, Licence, Experience, Rickshaw_Model, Password, Picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $name, $email, $phone, $licence, $experience, $rickshaw_model, $hashed_password, $profile_picture);

        // Prepare and bind for the users table
        $stmt1 = $conn->prepare("INSERT INTO user (Email, Password, Role) VALUES (?, ?, ?)");
        $role = "Driver";
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
