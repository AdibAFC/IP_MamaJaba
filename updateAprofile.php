<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.html');
    exit;
}

$email = $_SESSION['email'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'MamaJaba');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Get form data
$new_name = $_POST['name'];
$phone = $_POST['phone'];
$current_password = $_POST['current-password'];
$new_password = $_POST['new-password'];
$repeat_new_password = $_POST['repeat-password'];
$profile_image = isset($_FILES['profile-picture']) ? $_FILES['profile-picture'] : NULL;

// Update user information
if (!empty($new_name) || !empty($phone) || $profile_image) {
    $image_path = null;
    if ($profile_image && $profile_image['size'] > 0 && $profile_image['size'] <= 800000) {
        $image_path = 'images/' . basename($profile_image['name']);
        move_uploaded_file($profile_image['tmp_name'], $image_path);
    } else {
        $stmt = $conn->prepare("SELECT image FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($image_path);
        $stmt->fetch();
        $stmt->close();
        if (!$image_path || !file_exists($image_path)) {
            $image_path = 'images/default.jpg';
        }
    }

    $stmt = $conn->prepare("UPDATE admin SET name = ?, contact = ?, image = ? WHERE email = ?");
    $stmt->bind_param("ssss", $new_name, $phone, $image_path, $email);
    $stmt->execute();
    $stmt->close();

    // Re-fetch the updated user data from the database
    $stmt = $conn->prepare("SELECT name, contact, image FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($name, $contact, $profile_image);
    $stmt->fetch();
    $stmt->close();

    // Update session variables
    $_SESSION['name'] = $name;
    $_SESSION['phone'] = $contact;
    $_SESSION['profile_image'] = $profile_image;

    if (!empty($current_password) && !empty($new_password) && !empty($repeat_new_password)) {
        $stmt = $conn->prepare("SELECT password FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($password_hash);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($current_password, $password_hash) && $new_password === $repeat_new_password) {
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Update password in admin table
            $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE email = ?");
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

    header('Location: admin.php');
    exit;
} else {
    echo "No changes to update.";
}

$conn->close();
?>
