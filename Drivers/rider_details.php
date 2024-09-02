<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../Login/login.html'); // Redirect to login page if not logged in
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MamaJaba";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$driver_id = $_SESSION['driver_id'];
$ride_request_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT rr.pick_up_location, rr.drop_off_location, rr.request_time, r.Name AS rider_name, r.Phone AS rider_contact
        FROM ride_requests rr
        JOIN rider r ON rr.rider_id = r.RiderID
        WHERE rr.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $ride_request_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $ride_request = $result->fetch_assoc();
    $pick_up_location = $ride_request['pick_up_location'];
    $drop_off_location = $ride_request['drop_off_location'];
    $request_time = $ride_request['request_time'];
    $rider_name = $ride_request['rider_name'];
    $rider_contact = $ride_request['rider_contact'];
} else {
    // Handle the case where the ride request is not found
    die('Ride request not found.');
}

$name = $_SESSION['name'];
$default = "images/default.jpg";
$profile_image = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : NULL;
if (!file_exists($profile_image)) $profile_image = $default;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- For Browsers -->
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
    <!-- For High-Resolution Displays -->
    <link rel="icon" type="image/png" sizes="192x192" href="../favicon_io/android-chrome-192x192.png">
    <!-- For Apple Devices -->
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon" href="../favicon_io/favicon.ico">
    <title>Riders-Details</title>
    <link rel="stylesheet" href="rider_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav>
    <a href="../Landing_Page/index.php">
                <img src="../images/MamaJaba_logo1.gif" style="height: 50px; margin: 10px; cursor: pointer;">
            </a>

        <ul>
            <li><a href="../Landing_Page/index.php">Home</a></li>
            <li><a href="../About_Us/about1.html">About</a></li>
            <li><a href="../Contact_Us/contactUs.html">Contact Us</a></li>
            <li><a href="../Blog_Pages/blog.html">Blog</a></li>
        </ul>
        <img src="<?php echo htmlspecialchars($profile_image); ?>" class="user-pic" onclick="toggleMenu()">
        <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info">
                    <img src="<?php echo htmlspecialchars($profile_image); ?>">
                    <h3>
                        <?php echo htmlspecialchars($name); ?>
                    </h3>
                </div>
                <hr>

                <a href="driverProfile.php" class="sub-menu-link">
                    <i class="fa-solid fa-user"></i>
                    <p>Edit Profile</p>
                    <span>></span>
                </a>
                <a href="../Terms_&_Conditions/terms.html" class="sub-menu-link">
                    <i class="fa-solid fa-gear"></i>
                    <p>Settings & Privacy</p>
                    <span>></span>
                </a>
                <a href="../Contact_Us/contact.html" class="sub-menu-link">
                    <i class="fa-solid fa-circle-question"></i>
                    <p>Help & Support</p>
                    <span>></span>
                </a>
                <a href="../logout.php" class="sub-menu-link">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Log Out</p>
                    <span>></span>
                </a>
            </div>
        </div>
    </nav>
    <div class="hero">
        <!-- <div class="title"> -->
        <h2>Detail of Rider</h2>
        <!-- </div> -->
        <div class="ride-request" data-id="<?php echo htmlspecialchars($ride_request_id); ?>">
            <div class="container">
                <div class="detail">
                    <div class="div1">
                        <div class="det">
                            <div class="topic">LOCATION</div>
                            <div class="txt">
                                <?php echo htmlspecialchars($pick_up_location); ?>
                            </div>
                        </div>

                        <div class="det">
                            <div class="topic">CONTACT</div>
                            <div class="txt">
                                <?php echo htmlspecialchars($rider_contact); ?>
                            </div>
                        </div>
                    </div>
                    <div class="div2">
                        <div class="det">
                            <div class="topic">DESTINATION</div>
                            <div class="txt">
                                <?php echo htmlspecialchars($drop_off_location); ?>
                            </div>
                        </div>
                        <div class="dett">
                            <div class="topic">TIME</div>
                            <div class="txtt">
                                <?php echo htmlspecialchars($request_time); ?>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="btn">
                    <button class="ac" data-id="<?php echo htmlspecialchars($ride_request_id); ?>"
                        onclick="handleRequest('accept', this)">Accept</button>
                    <button class="dc" data-id="<?php echo htmlspecialchars($ride_request_id); ?>"
                        onclick="handleRequest('decline', this)">Decline</button>
                </div>
            </div>
        </div>
        <div class="history">
            <a href="#">View Rider's Past History</a>
        </div>
        <div id="toastbox">

        </div>
    </div>
    <script src="rider_details.js"></script>
</body>

</html>
<?php
$stmt->close();
$conn->close();
?>