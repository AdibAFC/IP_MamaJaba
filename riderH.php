<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.html'); // Redirect to login page if not logged in
    exit;
}
$name = $_SESSION['name'];
$rider_id=$_SESSION['rider_id'];
$phone=$_SESSION['contact'];
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
    <title>Rider's-Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="riderH.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <nav>
        <div class="logo">
            <img src="images/MamaJaba_logo1.gif" class="" style="height: 50px; margin: 10px;">
            <!-- <h3 class="highlight-text"><span class="comic-sans">MamaJaba?</span></h3> -->
        </div>

        <ul>
            <li>
                <button id="notification-btn" class="notification-btn">
                    <i class="fa-solid fa-bell fa-xl" style="color: #FFF;"></i>
                    <span id="notification-count" class="badge">0</span>
                </button>
                <div id="notifications" class="notifications hidden"></div>
                <p id="rid" value="<?php echo json_encode($rider_id); ?>" style="display:none;"></p>
            </li>
            <li><a href="#">HOME</a></li>
            <li><a href="#">ABOUT</a></li>
            <li><a href="#">CONTACTS</a></li>
            <li>
                    <a href="#" class="review-btn" onclick="openPopup()">RATE US

                </a>
                <!-- <button class="review-btn" onclick="openPopup()">Rate Us</button> -->
                <div class="overlay" onclick="closePopup()"></div>
                <div class="review" id="popup">
                    <div class="post">
                        <div class="text">Thanks for rating us!</div>
                        <div class="edit">EDIT</div>
                        <button type="button" onclick="closePopup()">OK</button>
                    </div>
                    <div class="star-widget">
                        <input type="radio" name="rate" id="rate-5" value=5>
                        <label for="rate-5" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-4" value=4>
                        <label for="rate-4" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-3" value=3>
                        <label for="rate-3" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-2" value=2>
                        <label for="rate-2" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-1" value=1>
                        <label for="rate-1" class="fas fa-star"></label>
                        <form id="reviewForm" method="POST" action="submit_review.php">
                            <input type="hidden" name="rating" id="rating" value="">
                            <header></header>
                            <div class="textarea">
                                <textarea name="review_text" cols="30"
                                    placeholder="Describe your experience.."></textarea>
                            </div>
                            <input type="hidden" name="rider_id" value="<?php echo $rider_id; ?>">
                            <div class="btn">
                                <button type="submit">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
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

                <a href="riderProfile.php" class="sub-menu-link">
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
                <a href="logout.php" class="sub-menu-link"> <!-- Add a logout script -->
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Log Out</p>
                    <span>></span>
                </a>
            </div>
        </div>
    </nav>
    <div class="location-box">
        <h2>Get a <span>Ride </span></h2>
        <form action="">
            <div class="user-box">
                <input type="text" id="pickUpLocation" required>
                <label for="">&nbsp; Location</label>
            </div>
            <div class="user-box">
                <input type="text" id="dropOffLocation" required>
                <label for="">&nbsp; Destination</label>
            </div>
            <a href="" id="requestRide">
                <span></span>
                <span></span>
                <span></span>
                <span></span>Send Request
            </a>

        </form>
        <div class="message">
            <div class="success" id="success">Request Sent Successfully!</div>
            <div class="danger" id="danger">Fields Can't Be Empty!</div>
        </div>
    </div>


    <footer>
        <div class="row">
            <div class="col">
                <div class="logo">
                    <h3 class="h-text"><span class="comic-sans">MamaJaba?</span></h3>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="riderH.js"></script>
</body>

</html>
