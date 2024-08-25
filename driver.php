<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.html'); // Redirect to login page if not logged in
    exit;
}
$name = $_SESSION['name'];
$driver_id = $_SESSION['driver_id'];
$default="images/default.jpg";
// $profile_image = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : 'images/default.png';
$profile_image = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : NULL;
if(!file_exists($profile_image))$profile_image=$default;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- For Browsers -->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <!-- For High-Resolution Displays -->
    <link rel="icon" type="image/png" sizes="192x192" href="favicon_io/android-chrome-192x192.png">
    <!-- For Apple Devices -->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
    <title>Driver's-Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="driver.css">
</head>

<body>

    <nav>
        <div class="logo">
            <img src="images/MamaJaba_logo1.gif" class="" style="height: 50px; margin: 10px;">
            <!-- <h3 class="highlight-text"><span class="comic-sans">MamaJaba?</span></h3> -->
        </div>

        <ul>
            <li><a href="#">HOME</a></li>
            <li><a href="#">ABOUT</a></li>
            <li><a href="#">CONTACTS</a></li>
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
                <a href="#" class="sub-menu-link">
                    <i class="fa-solid fa-gear"></i>
                    <p>Settings & Privacy</p>
                    <span>></span>
                </a>
                <a href="#" class="sub-menu-link">
                    <i class="fa-solid fa-circle-question"></i>
                    <p>Help & Support</p>
                    <span>></span>
                </a>
                <a href="logout.php" class="sub-menu-link">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Log Out</p>
                    <span>></span>
                </a>
            </div>
        </div>
    </nav>
    <div class="mapbtn">
        <button class="beating-button" onclick="openmap()"><i class="fa-solid fa-location-dot fa-2xl"
                style="color: #07c035;"></i><button>
    </div>
    <div class="overlay" onclick="closemap()"></div>
    <div class="map-container" id="popup">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3674.368374615738!2d91.9684936290414!3d22.461942319091374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ad2fca34ae5549%3A0x35c88a37b3e90e97!2sChittagong%20University%20of%20Engineering%20and%20Technology%20(CUET)!5e0!3m2!1sen!2sbd!4v1720165415651!5m2!1sen!2sbd"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>


    <section class="ridereq" id="ridereq">
    </section>
  <footer>
        <div class="row">
            <div class="col">
                <div class="logo">
                    <h3 class="highlight-text"><span class="comic-sans">MamaJaba?</span></h3>
                </div>
                <p>"MamaJaba" is a website designed for CUET students and faculty to conveniently request rickshaw rides
                    within the campus. With easy booking, real-time tracking, and reliable service, MamaJaba simplifies
                    transportation for CUET residents.</p>
            </div>
            <div class="col">
                <h3>Links <div class="underline"><span></span></div>
                </h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Products <div class="underline"><span></span></div>
                </h3>
                <ul>
                    <li><a href="#">Ride</a></li>
                    <li><a href="#">Drive</a></li>
                    <li><a href="#">Manage</a></li>
                    <li><a href="#">MamaJaba? for Business</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Newsletter <div class="underline"><span></span></div>
                </h3>
                <form>
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" placeholder="Enter Your Email Id">
                    <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                </form>
                <div class="social-icons">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-pinterest-p"></i>
                </div>
            </div>
        </div>
        <hr>
        <p class="copyright">AdiPriShi © 2024 - All Rights Reserved</p>
    </footer>

  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="driver.js"></script>
</body>

</html>
