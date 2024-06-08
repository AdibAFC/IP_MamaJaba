<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.html'); // Redirect to login page if not logged in
    exit;
}
$name = $_SESSION['name'];
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
    <title>Driver's-Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
                    <h3><?php echo htmlspecialchars($name); ?></h3>
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
    <section class="ridereq" id="ridereq">
    </section>


    <footer>
        <div class="row">
            <div class="col">
                <div class="logo"><h3 class="highlight-text"><span class="comic-sans">MamaJaba?</span></h3></div>
                <p>"MamaJaba" is a website designed for CUET students and faculty to conveniently request rickshaw rides within the campus. With easy booking, real-time tracking, and reliable service, MamaJaba simplifies transportation for CUET residents.</p>
            </div>
            <div class="col">
                <h3>Links <div class="underline"><span></span></div></h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Products  <div class="underline"><span></span></div></h3>
                <ul>
                    <li><a href="#">Ride</a></li>
                    <li><a href="#">Drive</a></li>
                    <li><a href="#">Manage</a></li>
                    <li><a href="#">MamaJaba? for Business</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Newsletter  <div class="underline"><span></span></div></h3>
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
