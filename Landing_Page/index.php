<?php
// session_start();
// session_unset();
// session_destroy();
// header('Location: login.html');
// exit;
?>
<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // If user is logged in, you can either show different content or redirect to another page
    // For example, redirect to the dashboard or user profile page
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MamaJaba</title>
    <!-- For Browsers -->
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
    <!-- For High-Resolution Displays -->
    <link rel="icon" type="image/png" sizes="192x192" href="../favicon_io/android-chrome-192x192.png">
    <!-- For Apple Devices -->
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon" href="../favicon_io/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--     swiper link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <a href="../Landing_Page/index.php">
                <img src="../images/MamaJaba_logo1.gif" style="height: 50px; margin: 10px; cursor: pointer;">
            </a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse"></div>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a href="#" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#Ride" class="nav-link">Ride</a>
                    </li>
                    <li class="nav-item">
                        <a href="#Drive" class="nav-link">Drive</a>
                    </li>
                    <li class="nav-item">
                        <a href="#Review" class="nav-link">Review</a>
                    </li>
                    <li class="nav-item">
                        <a href="#page" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="../Blog_Pages/blog.html" class="nav-link">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a href="#Help" class="nav-link">Help</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <a href="../Login/login.html" class="btn menu-right-btn border-btn1" type="submit">
                        Login
                    </a>
                    <a class="btn menu-right-btn border-btn2" type="submit" id="popupsignup">
                        SignUp
                    </a>
                    <div class="popup" id="popup">
                        <div class="popup-content">
                            <div class="options">
                                <button>
                                    <a href="../Sign_Up/driver_signup.html" id="driverBtnpop">SignUp to Drive</a>
                                </button>
                                <button>
                                    <a href="../Sign_Up/rider_signup.html" id="riderBtnpop">Create a Rider account</a>
                                </button>
                            </div>
                            <button id="closePopup">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
    </header>


    <main>
        <div class="container-fluid p-0">
            <div class="site-content">
                <div class="d-flex justify-content-center">
                    <div class="d-flex flex-column">
                        <h1 class="site-title px-4 py-3">Go anywhere with <span>MamaJaba?</span></h1>
                    </div>
                </div>
            </div>
        </div>



        <!-- ride -->
        <section class="Ride" id="Ride">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="content">
                            <h3 class="highlight-text1">Exploring every corner, serving one neighborhood at a time.</h3>
                            <p>Request a ride, hop in and go!</p>
                            <div class="text-boxes">
                                <input type="text" class="form-control mb-3" placeholder="Enter your location">
                                <input type="text" class="form-control mb-3" placeholder="Enter your destination">
                                <a href="../Login/login.html" class="btn btn-primary ride_btn">Request a Ride</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="image">
                            <img src="../images/ride.jpg" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- drive -->
        <section class="Drive" id="Drive">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="image">
                            <img src="../images/drive.jpg" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="content">
                            <h3 class="highlight-text1">Drive when you want, make what you need</h3>
                            <p>Make money on your schedule with deliveries or rides—or both. You can use your own car or
                                choose a rental through Uber.</p>
                            <a href="../Sign_Up/driver_signup.html" class="btn btn-primary drive_btn ">Get Started</a>
                            <a href="../Login/login.html" class="btn btn-outline-secondary drive_btn">Already Have an account? Sign in</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>






<!--         new about -->
        
        <div id="page" class="site">
            <div class="contain">
                <div class="testi">
                    <div class="head">
                        <h1>About Us</h1>
                        <p>See what we bring to the table..</p>
                    </div>
                    <div class="body swiper">

                        <div class="swiper-wrapper">
                            <li class="swiper-slide">
                                <div class="wrapper">
                                    <div class="thumbnail">
                                        <img src="../images/con8.jpg" alt="">
                                    </div>
                                    <div class="aside">
                                        <div class="name">
                                            <h1>Sustainability</h1>

                                        </div>
                                        <p>At MamaJaba, sustainability is at the core of everything we do. We're
                                            committed
                                            to reducing our carbon footprint by implementing eco-friendly practices
                                            throughout our operations.</p>

                                    </div>
                                </div>
                            </li>
                            <li class="swiper-slide">
                                <div class="wrapper">
                                    <div class="thumbnail">
                                        <img src="../images/con5.jpg" alt="">
                                    </div>
                                    <div class="aside">
                                        <div class="name">
                                            <h1>Your Safety Drives Us</h1>

                                        </div>
                                        <p>Your safety is our top priority. That's why we've implemented
                                            rigorous safety measures to ensure you feel secure every time you ride with
                                            MamaJaba.</p>

                                    </div>
                                </div>
                            </li>
                            <li class="swiper-slide">
                                <div class="wrapper">
                                    <div class="thumbnail">
                                        <img src="../images/con6.jpg" alt="">
                                    </div>
                                    <div class="aside">
                                        <div class="name">
                                            <h1>Rides and Beyond</h1>

                                        </div>
                                        <p>Our commitment to excellence extends beyond providing rides. We're constantly
                                            innovating to enhance your overall experience with MamaJaba.</p>

                                    </div>
                                </div>
                            </li>
                            <li class="swiper-slide">
                                <div class="wrapper">
                                    <div class="thumbnail">
                                        <img src="../images/con4.jpg" alt="">
                                    </div>
                                    <div class="aside">
                                        <div class="name">
                                            <h1>Company Info</h1>

                                        </div>
                                        <p> MamaJaba is more than just a transportation company; we're a community.
                                        <div class="aboutus">
                                            <a href="../About_Us/about1.html">
                                                
                                                <button type="button">Read More</button>
                                            </a>
                                        </div>
                                        </p>

                                    </div>
                                </div>
                            </li>
                            <!-- Add more slides as needed -->
                        </div>
                        <div class="swiper-pagination"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="section-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex flex-row">
                            <i class="fas fa-headset fa-3x m-2"></i>
                            <div class="d-flex flex-column">
                                <h3 class="m-2">24/7 Support</h3>
                                <p class="m-2">Get help anytime, anywhere. Our dedicated support team is available
                                    round-the-clock to assist you with any queries or concerns you might have.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-row">
                            <i class="fas fa-bullhorn fa-3x m-2"></i>
                            <div class="d-flex flex-column">
                                <h3 class="m-2">Marketing</h3>
                                <p class="m-2">We help drivers and riders connect efficiently through targeted marketing
                                    strategies, ensuring a seamless experience for both parties.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-row">
                            <i class="fas fa-bolt fa-3x m-2"></i>
                            <div class="d-flex flex-column">
                                <h3 class="m-2">Speed</h3>
                                <p class="m-2">Experience lightning-fast pickups and drop-offs with our optimized
                                    routing algorithms and efficient driver network.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4">
                        <div class="d-flex flex-row">
                            <i class="fas fa-tachometer-alt fa-3x m-2"></i>
                            <div class="d-flex flex-column">
                                <h3 class="m-2">Efficiency</h3>
                                <p class="m-2">Ride with confidence knowing that our service prioritizes speed without
                                    compromising on safety or quality.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-row">
                            <i class="fas fa-clock fa-3x m-2"></i>
                            <div class="d-flex flex-column">
                                <h3 class="m-2">Timeliness</h3>
                                <p class="m-2">Our platform is designed for maximum efficiency, ensuring prompt arrivals
                                    and timely departures for every journey.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-row">
                            <i class="fas fa-rocket fa-3x m-2"></i>
                            <div class="d-flex flex-column">
                                <h3 class="m-2">Acceleration</h3>
                                <p class="m-2">Accelerate your travel plans with our high-speed transportation
                                    solutions, delivering you to your destination swiftly and securely.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

<!-- contact section -->
        <div class="section-4" id="Contact">
            <div class="container-fluid d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="content">
                        <h1 class="text-white typing-effect">Have Questions?</h1>
                        <p class="para-1">
                            Need assistance or have inquiries about our services? We're here to help! Feel free to reach
                            out to us anytime.
                        </p>
                        <a href="../Contact_Us/contactUs.html" class="btn btn-primary btn-lg">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>



        <!-- Reviews -->
        <div class="section-1" id="Review">
            <div class="container text-center">
                <h1 class="heading-1 reveal reveal-1" >Reviews</h1><br>

                <h1 class="heading-2 reveal reveal-2">& Real Customer Testimonials</h1>
                <p class="para-1">Read what our customers have to say about us!</p>
                <div class="row justify-content-center text-center">
                    <div class="col-md-4">
                        <img src="../images/quote.png" alt="" class="quote">
                        <div class="card">
                            <img src="../images/stu1.jpg" alt="Customer 1" class="card-img-top equal-img">
                            <div class="card-body">
                                <h4 class="card-title">Maisha Chowdhury, EEE Department</h4>
                                <p class="card-text">Great Service! I've been using this service for a few months now
                                    and I'm extremely satisfied with it. The drivers are always courteous and punctual.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="../images/quote.png" alt="" class="quote">
                        <div class="card">
                            <img src="../images/stu2.jpg" alt="Customer 2" class="card-img-top equal-img">
                            <div class="card-body">
                                <h4 class="card-title">Yamin Iqbal, CSE Department</h4>
                                <p class="card-text">Fantastic Experience! I had a wonderful experience using this
                                    service. The app is user-friendly, and the drivers are professional. Highly
                                    recommended!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="../images/quote.png" alt="" class="quote">
                        <div class="card">
                            <img src="../images/stu3.jpg" alt="Customer 3" class="card-img-top equal-img">
                            <div class="card-body">
                                <h4 class="card-title">Tahsina, ME Department</h4>
                                <p class="card-text">Excellent Service! The service provided by this company is
                                    outstanding. The drivers are friendly and the cars are always clean and comfortable.
                                    Will definitely use it again!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Support Pop-up -->
    <div class="support-popup" id="supportPopup">
        <div class="popup-header">
            <img src="../images/flower.png" alt="">
            <span class="close-popup" id="closeSupportPopup">&times;</span>
        </div>
        <div class="popup-content-support">
            <p style="color: rgb(225, 229, 232);">If you find MamaJaba useful, please consider supporting.</p>
            <p style="color: rgb(167, 169, 169);">Your contribution helps support continued development of MamaJaba. MamaJaba is free, thanks to your support.</p>
            <button class="btn-donate" onclick="window.location.href='../Donation/donate.html'">❤ Donate</button>
        </div>
    </div>


    </main>

<!--     footer -->
    <footer>
        <div class="row" id="Help">
            <div class="col">
                <div class="logo">
                    <h3 class="h_text"><span class="comic-sans">MamaJaba?</span></h3>
                </div>
                <p>"MamaJaba" is a website designed for CUET students and faculty to conveniently request rickshaw rides
                    within the campus. With easy booking, real-time tracking, and reliable service, MamaJaba simplifies
                    transportation for CUET residents.</p>
            </div>
            <div class="col">
                <h3 style="margin-left: 30px;">Links <div class="underline"><span></span></div>
                </h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col">
                <h3 style="margin-left: 30px;">Products <div class="underline" ><span></span></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" integrity="sha512-onMTRKJBKz8M1TnqqDuGBlowlH0ohFzMXYRNebz+yOcc5TQr/zAKsthzhuv0hiyUKEiQEQXEynnXCvNTOk50dg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script type="text/javascript">
        const reveal = gsap.utils.toArray('.reveal');
        reveal.forEach((text,i)=>{
            ScrollTrigger.create({
                trigger: text,
                toggleClass: 'active',
                start: "top 90%",
                end: "top 20%",
                // markers: true
            })
        })
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const sr = ScrollReveal({
                duration: 1000,
                reset: true,
                mobile: false,
            });

            sr.reveal('.Ride', {
                origin: 'bottom',
                distance: '50px',
            });
            sr.reveal('.Drive', {
                origin: 'bottom',
                distance: '50px',
            });

            sr.reveal('footer', {
                origin: 'bottom',
                distance: '20px',
                delay: 200,
            });
        });
        const openPopupBtn = document.getElementById("popupsignup");
        const closePopupBtn = document.getElementById("closePopup");
        const popup = document.getElementById("popup");
        const riderBtn = document.getElementById("riderBtnpop");
        const driverBtn = document.getElementById("driverBtnpop");

        openPopupBtn.addEventListener("click", () => {
            popup.style.display = "block";
        });

        closePopupBtn.addEventListener("click", () => {
            popup.style.display = "none";
        });

        document.getElementById('closeSupportPopup').addEventListener('click', function () {
            document.getElementById('supportPopup').style.display = 'none';
        });

        // Show the support popup after a delay
        setTimeout(function () {
            document.getElementById('supportPopup').style.display = 'block';
        }, 15000); // 15 seconds delay
    </script>
    <!-- swiper js -->
     <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
       
        document.addEventListener('DOMContentLoaded', () => {
            const swiper = new Swiper('.swiper', {
                // Optional parameters
                direction: 'horizontal',
                loop: true,
                speed: 400,
                // autoplay: true,
                autoplay: {
                    delay: 3000, // 3 seconds
                },
                parallax: true,


                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                }
            });
        });

    </script>
</body>

</html>
