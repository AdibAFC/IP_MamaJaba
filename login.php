<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (empty($email) || empty($password)) {
        die('Please fill all required fields.');
    }

    // Create a database connection
    $conn = new mysqli('localhost', 'root', '', 'MamaJaba');

    // Check the connection
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT Password, Role FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password, $role);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Set session variables
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $profile_image = '';

            // Fetch profile image and additional data based on role
            if ($role == 'Driver') {
                $stmt = $conn->prepare("SELECT Picture, Name FROM driver WHERE Email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($profile_image, $name);
                $stmt->fetch();
                $_SESSION['profile_image'] = $profile_image;
                $_SESSION['name'] = $name;
            } elseif ($role == 'Rider') {
                $stmt = $conn->prepare("SELECT RiderID, Picture, Name, Phone FROM rider WHERE Email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($rider_id, $profile_image, $name, $phone);
                $stmt->fetch();
                $_SESSION['rider_id'] = $rider_id;
                $_SESSION['profile_image'] = $profile_image;
                $_SESSION['name'] = $name;
                $_SESSION['contact'] = $phone;
            }

            // Store profile image in session
            $_SESSION['profile_image'] = $profile_image;

            // Redirect based on user role
            if ($role == 'Driver') {
                header('Location: driver.php');
            } elseif ($role == 'Rider') {
                header('Location: riderH.php'); // Ensure this points to the correct page
            } elseif ($role == 'Admin') {
                header('Location: admin.php');
            }
            exit;
        } else {
            echo 'Invalid email or password.';
        }
    } else {
        echo 'Invalid email or password.';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request method.';
}
?>
