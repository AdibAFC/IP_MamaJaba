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

            // Fetch profile image and additional data based on role
            if ($role == 'driver') {
                $stmt = $conn->prepare("SELECT DriverID, Picture, Name FROM driver WHERE Email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($driver_id, $profile_image, $name);
                $stmt->fetch();
                $_SESSION['driver_id'] = $driver_id;
                $_SESSION['profile_image'] = $profile_image;
                $_SESSION['name'] = $name;
            } elseif ($role == 'rider') {
                $stmt = $conn->prepare("SELECT RiderID, Picture, Name, Phone FROM rider WHERE Email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($rider_id, $profile_image, $name, $phone);
                $stmt->fetch();
                $_SESSION['rider_id'] = $rider_id;
                $_SESSION['profile_image'] = $profile_image;
                $_SESSION['name'] = $name;
                $_SESSION['contact'] = $phone;
            } elseif ($role == 'admin') {
                $stmt = $conn->prepare("SELECT id, image, name, email, contact FROM admin WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($admin_id, $profile_image, $name, $email, $phone);
                $stmt->fetch();
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['profile_image'] = $profile_image;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['contact'] = $phone;
            }


            // Redirect based on user role
            if ($role == 'driver') {
                header('Location: ../Drivers/driver.php');
            } elseif ($role == 'rider') {
                header('Location: ../Riders/riderH.php'); // Ensure this points to the correct page
            } elseif ($role == 'admin') {
                echo 'admin';
                header('Location: ../Admin/admin.php');
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
