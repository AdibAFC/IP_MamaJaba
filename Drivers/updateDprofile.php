<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../Login/login.html');
    exit;
}

$email = $_SESSION['email'];

// Get form data
$new_name = $_POST['name'];
$new_email = $email; // Ensure email is not changed
$phone = $_POST['phone'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$repeat_new_password = $_POST['repeat_new_password'];
$profile_image = isset($_FILES['profile-picture']) ? $_FILES['profile-picture'] : NULL;
$experience = $_POST['experience'];
$licence = $_POST['licence'];
$rickshaw_model = $_POST['rickshaw_model'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'MamaJaba');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Update user information
if (!empty($new_name) || !empty($new_email) || !empty($phone) || $profile_image || !empty($experience) || !empty($licence) || !empty($rickshaw_model)) {
    $image_path = null;
    if ($profile_image && $profile_image['size'] > 0 && $profile_image['size'] <= 800000) {
        $image_path = 'images/' . basename($profile_image['name']);
        move_uploaded_file($profile_image['tmp_name'], $image_path);
    } else {
        $stmt = $conn->prepare("SELECT Picture FROM driver WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($image_path);
        $stmt->fetch();
        $stmt->close();
        if (!$image_path || !file_exists($image_path)) {
            $image_path = 'images/default.jpg'; // Ensure the default image path is used if no image exists
        }
    }

    $stmt = $conn->prepare("UPDATE driver SET Name = ?, Phone = ?, Picture = ?, Licence = ?, Experience = ?, Rickshaw_model = ? WHERE Email = ?");
    $stmt->bind_param("sssssss", $new_name, $phone, $image_path, $licence, $experience, $rickshaw_model, $email);
    $stmt->execute();
    $stmt->close();

    $_SESSION['profile_image'] = $image_path; // Update session profile image

    if (!empty($current_password) && !empty($new_password) && !empty($repeat_new_password)) {
        $stmt = $conn->prepare("SELECT Password FROM driver WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($password_hash);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($current_password, $password_hash) && $new_password === $repeat_new_password) {
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE driver SET Password = ? WHERE Email = ?");
            $stmt->bind_param("ss", $new_password_hash, $email);
            $stmt->execute();
            $stmt->close();

            // Update password in user table
            $stmt = $conn->prepare("UPDATE user SET Password = ? WHERE Email = ?");
            $stmt->bind_param("ss", $new_password_hash, $email);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Password update failed.";
        }
    }

    header('Location: driverProfile.php');
} else {
    echo "No changes to update.";
}

$conn->close();
?>
