<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.html'); // Redirect to login page if not logged in
    exit;
}

$email = $_SESSION['email'];
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
$phone = isset($_SESSION['contact']) ? $_SESSION['contact'] : '';
$default = "images/default.jpg";
$profile_image = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : $default;

if (!file_exists($profile_image)) {
    $profile_image = $default;
}

$conn = new mysqli('localhost', 'root', '', 'mamajaba');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Query to get count of reviews by rating
$query_reviews_count = "SELECT rating, COUNT(*) AS count_reviews FROM reviews GROUP BY rating ORDER BY rating DESC";
$result_reviews_count = $conn->query($query_reviews_count);
$reviews_count = array_fill(1, 5, 0); // Initialize all ratings from 1 to 5 with 0 count

if ($result_reviews_count) {
    while ($row = $result_reviews_count->fetch_assoc()) {
        $reviews_count[$row['rating']] = $row['count_reviews'];
    }
}

// Query to get average rating and total reviews
$query_avg_rating = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews FROM reviews";
$result_avg_rating = $conn->query($query_avg_rating);
if ($result_avg_rating) {
    $row_avg_rating = $result_avg_rating->fetch_assoc();
    $avg_rating = $row_avg_rating['avg_rating'];
    $total_reviews = $row_avg_rating['total_reviews'];
} else {
    $avg_rating = 0;
    $total_reviews = 0;
}

// Fetch the number of drivers
$query_drivers = "SELECT COUNT(*) AS num_drivers FROM driver";
$result_drivers = $conn->query($query_drivers);
if ($result_drivers) {
    $row_drivers = $result_drivers->fetch_assoc();
    $num_drivers = $row_drivers['num_drivers'];
} else {
    $num_drivers = 0;
}

// Fetch the number of riders
$query_riders = "SELECT COUNT(*) AS num_riders FROM rider";
$result_riders = $conn->query($query_riders);
if ($result_riders) {
    $row_riders = $result_riders->fetch_assoc();
    $num_riders = $row_riders['num_riders'];
} else {
    $num_riders = 0;
}

// Licensed rickshaws are equal to the number of drivers
$num_rickshaws = $num_drivers;

$conn->close();
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
    <title>Admin</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin_style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <div class="hero">
        <div class="nav">
            <div class="sidebar active">
                <div class="menu-btn">
                    <i class="fa-solid fa-caret-left"></i>
                </div>
                <div class="head">
                    <div class="user-img">
                        <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="" />
                    </div>
                    <div class="user-details">
                        <p class="title">Admin Panel</p>
                        <p class="name">
                            <?php echo htmlspecialchars($name); ?>
                        </p>
                    </div>
                </div>
                <div class="navv">
                    <div class="menu">
                        <p class="title">Main</p>
                        <ul>
                            <li>
                                <a href="#main">
                                    <i class="fa-solid fa-desktop"></i>
                                    <span class="text">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="#rev">
                                    <i class="fa-solid fa-quote-right"></i>
                                    <span class="text"> Reviews</span>
                                </a>
                            </li>
                            <li>
                                <a href="#dat">
                                    <i class="fa-solid fa-chart-pie"></i>
                                    <span class="text">Dataset</span>
                                </a>
                            </li>
                            <li>
                                <a href="#rate">
                                    <i class="fa-solid fa-star"></i>
                                    <span class="text">Rating</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-solid fa-table"></i>
                                    <span class="text">Tables</span>
                                    <i class="fa-solid fa-caret-down"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="#sec1">
                                            <span class="text">Drivers</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#sec2">
                                            <span class="text">Riders</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#sec3">
                                            <span class="text">Admins</span>
                                        </a>
                                    </li>
                                </ul>

                            </li>
                            <li class="active">
                                <a href="#settings">
                                    <i class="fa-solid fa-gear"></i>
                                    <span class="text">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="menu">
                    <p class="title">Account</p>
                    <ul>
                        <li>
                            <a href="#">
                                <i class="fa-solid fa-circle-info"></i>
                                <span class="text">Help</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span class="text">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="wrapper" id="main">
            <div class="container">
                <img src="images/rickshaw_icon.png" alt="Rickshaw Icon">
                <span class="num" dat-val="<?php echo $num_rickshaws; ?>">0</span>
                <span class="text">Licensed Rickshaws</span>
            </div>

            <div class="container">
                <i class="fa-solid fa-person-circle-check"></i>
                <span class="num" dat-val="<?php echo $num_drivers; ?>">0</span>
                <span class="text">Recruited Drivers</span>
            </div>

            <div class="container">
                <i class="fa-solid fa-chart-simple"></i>
                <span class="num" dat-val="<?php echo $num_riders; ?>">0</span>
                <span class="text">No of Riders</span>
            </div>
            <div class="container">
                <i class="fa-solid fa-user"></i>
                <span class="num" dat-val="3">000</span>
                <span class="text">Admins</span>
            </div>
        </div>
    </div>
    <div id="rev">
    <div class="review" >
        <div class="title">
            <h2>Customer Reviews</h2>
        </div>
        <div class="slide-container active">
            <div class="slide">
                <div class="icon">
                    <i class="fa-solid fa-quote-right"></i>
                </div>
                <div class="user">
                    <img src="images/peep1.jpg">
                    <div class="user-info">
                        <h3>Joe Biden</h3>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur veritatis
                    explicabo ab, excepturi sed illum alias perspiciatis similique consequuntur deserunt. Quaerat
                    sapiente fugit veritatis ad! Laudantium illo aliquam molestias voluptatibus!</p>
            </div>
        </div>
        <div class="slide-container">
            <div class="slide">
                <div class="icon">
                    <i class="fa-solid fa-quote-right"></i>
                </div>
                <div class="user">
                    <img src="images/peep2.jpg">
                    <div class="user-info">
                        <h3>Ella Bella</h3>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi amet facere
                    repudiandae quidem ratione accusamus!</p>
            </div>
        </div>
        <div id="next" class="fas fa-chevron-right" onclick="next()"></div>
        <div id="prev" class="fas fa-chevron-left" onclick="prev()"></div>
    </div>
    </div>
    
    <div id="chartContainer" id="dat">
        <canvas id="myChart"></canvas>
        <div class="chart">
            <button onclick="changeChartType('bar')">Bar</button>
            <button onclick="changeChartType('line')">Line</button>
            <button onclick="changeChartType('pie')">Pie</button>
        </div>
    </div>
    <div id="rate">
    <div class="revstat-box" >
        <div class="avg-rating" >
            <h2><?php echo number_format($avg_rating, 1); ?> / 5.0</h2>
            <div class="stars">
                <?php
                $full_stars = floor($avg_rating);
                $half_star = $avg_rating - $full_stars >= 0.5 ? 1 : 0;
                for ($i = 0; $i < $full_stars; $i++) {
                    echo '<i class="fas fa-star"></i>';
                }
                if ($half_star) {
                    echo '<i class="fas fa-star-half-alt"></i>';
                }
                for ($i = $full_stars + $half_star; $i < 5; $i++) {
                    echo '<i class="far fa-star"></i>';
                }
                ?>
            </div>
            <p><?php echo $total_reviews; ?> Reviews</p>
        </div>

        
        <div class="ratings-breakdown">
            <ul>
                <?php
                for ($rating = 5; $rating >= 1; $rating--) {
                    $count_reviews = isset($reviews_count[$rating]) ? $reviews_count[$rating] : 0;
                    $percentage = $total_reviews > 0 ? ($count_reviews / $total_reviews) * 100 : 0;
                    echo "<li>
                            {$rating}<span> <i class='fas fa-star'></i></span>
                            <div class='bar'>
                                <div class='bar-filled' style='width: {$percentage}%;'></div>
                            </div>
                            ({$count_reviews})
                          </li>";
                }
                ?>
            </ul>
        </div>
    </div>
    </div>

    
    <div class="main-content">
        <section id="sec1">
            <div class="filterEntries">
                <div class="entries">
                    Show Entries
                    <select name="table_size" id="table_size">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="filter">
                    <label for="search">Search: <input type="search" id="search" placeholder="Enter name"
                            onkeyup="filterTable()"></label>
                </div>
            </div>
        </section>
        <table id="driverTable">
            <thead>
                <tr class="heading">
                    <th>DriverID No</th>
                    <th>Picture</th>
                    <th>Full Name</th>
                    <th>Contact</th>
                    <th>Rickshaw-Model</th>
                    <th>Licence Plate</th>
                    <th>Experience</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="userInfo">
                <?php include 'fetch_driver.php'; ?>
            </tbody>
        </table>

        <!-- Popup Modal Structure -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <button class="close-button">&times;</button>
                <h2>Driver Details</h2>
                <img id="modal-image" src="" alt="Driver Picture">
                <p id="modal-name"></p>
                <p id="modal-contact"></p>
                <p id="modal-rickshaw-model"></p>
                <p id="modal-licence-plate"></p>
                <p id="modal-experience"></p>
            </div>
        </div>


        <footer>
            <span class="showEntries">Showing 1 to 10 of 50 entries</span>
            <div class="pagination">
                <div><i class="fa-solid fa-angles-left"></i></div>
                <div><i class="fa-solid fa-chevron-left"></i></div>
                <div>1</div>
                <div>2</div>
                <div><i class="fa-solid fa-chevron-right"></i></div>
                <div><i class="fa-solid fa-angles-right"></i></div>
            </div>
        </footer>
    </div>


    <div class="main-content">
        <section id="sec2">
            <div class="filterEntries">
                <div class="entries">
                    Show Entries
                    <select name="table_size" id="rider_table_size">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="filter">
                    <label for="rider_search">Search: <input type="search" id="rider_search" placeholder="Enter name"
                            onkeyup="filterRiderTable()"></label>
                </div>
            </div>
        </section>
        <table id="riderTable">
            <thead>
                <tr class="heading">
                    <th>RiderID No</th>
                    <th>Picture</th>
                    <th>Full Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="userInfo">
                <?php include 'fetch_rider.php'; ?>
            </tbody>
        </table>

        <!-- Popup Modal Structure -->
        <div id="rider_modal" class="modal">
            <div class="modal-content">
                <button class="close-buttonr">&times;</button>
                <h2>Rider Details</h2>
                <img id="rider-modal-image" src="" alt="Rider Picture">
                <p id="rider-modal-name"></p>
                <p id="rider-modal-contact"></p>
                <p id="rider-modal-email"></p>
            </div>
        </div>

        <footer>
            <span class="showEntries">Showing 1 to 10 of 50 entries</span>
            <div class="pagination">
                <div><i class="fa-solid fa-angles-left"></i></div>
                <div><i class="fa-solid fa-chevron-left"></i></div>
                <div>1</div>
                <div>2</div>
                <div><i class="fa-solid fa-chevron-right"></i></div>
                <div><i class="fa-solid fa-angles-right"></i></div>
            </div>
        </footer>
    </div>

   
 <div class="main-content">
        <div class="card-cont" id="sec3">
            <h1>Our Admins</h1>
            <div class="card-container">
                <article class="card-article">
                    <img src="images/pritha.jpg" alt="" srcset="" class="card-img">
                    <div class="card-data">
                        <span class="card-desc">MamaJaba Admin #1</span>
                        <h2 class="card-title">Pritha Saha</h2>
                        <h4 class="card-btn">ID: 2004013 <br> CSE Department</h4>
                    </div>
                </article>
                <article class="card-article">
                    <img src="images/adiba.jpg" alt="" srcset="" class="card-img">
                    <div class="card-data">
                        <span class="card-desc">MamaJaba Admin #2</span>
                        <h2 class="card-title">Adiba Fairooz Chowdhury</h2>
                        <h4 class="card-btn">ID: 2004014 <br> CSE Department</h4>
                    </div>
                </article>
                <article class="card-article">
                    <img src="images/shiti.jpg" alt="" srcset="" class="card-img">
                    <div class="card-data">
                        <span class="card-desc">MamaJaba Admin #3</span>
                        <h2 class="card-title">Shiti Chowdhury</h2>
                        <h4 class="card-btn">ID: 2004027 <br> CSE Department</h4>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="section-4" id="settings">
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="form" style='margin-left:600px'>
                    <h1 class="heading1">Edit Your Info</h1>
                    <form action="updateAprofile.php" method="POST" enctype="multipart/form-data">
                        <div class="card-body media align-items-center">
                            <img src="<?php echo htmlspecialchars($profile_image); ?>" class="d-block ui-w-80" id="preview-image" alt="Preview">
                            <div class="media-body ml-4">
                                <label class="btn btn-outline-primary">
                                    Upload
                                    <input id="profile-picture" name="profile-picture" type="file" class="account-settings-fileinput" accept="image/*">
                                </label> &nbsp;
                                <button type="button" class="btn btn-default md-btn-flat" id="reset-button">Reset</button>
                                <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                            </div>
                        </div>
                        <input type="text" value="<?php echo htmlspecialchars($email); ?>" autocomplete="off" class="email" readonly required>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" autocomplete="off" class="name" required>
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" autocomplete="off" class="contact" required>
                        <input type="password" name="current-password" placeholder="current-password" autocomplete="off" class="current-password" required>
                        <input type="password" name="new-password" placeholder="new-password" autocomplete="off" class="new-password" required>
                        <input type="password" name="repeat-password" placeholder="repeat-password" autocomplete="off" class="repeat-password" required>
                        <button type="submit" class="submit-btn">submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="admin.js"></script>


    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const fileInput = document.getElementById('profile-picture');
        const previewImage = document.getElementById('preview-image');
        const resetButton = document.getElementById('reset-button');

        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file && file.size <= 800 * 1024) { // 800KB max size
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                alert('File is too large or not a supported format.');
                fileInput.value = ''; // Reset the input
            }
        });

        resetButton.addEventListener('click', function () {
            previewImage.src = '<?php echo htmlspecialchars($default); ?>';
            fileInput.value = '';
        });
    </script>
    
</body>

</html>
