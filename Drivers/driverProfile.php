<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../Login/login.html'); // Redirect to login page if not logged in
    exit;
}

$email = $_SESSION['email'];
$default_image = 'images/default.jpg';
$profile_image = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : $default_image;
if (!file_exists($profile_image)) $profile_image = $default_image;

// Fetch additional user data if needed
$conn = new mysqli('localhost', 'root', '', 'MamaJaba');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT Name, Picture, Email, Phone, Licence, Experience,Rickshaw_Model FROM driver WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($name, $profile_image, $email, $phone, $licence, $experience, $rickshaw_model);
$stmt->fetch();
$stmt->close();
$conn->close();

if (!file_exists($profile_image)) {
    $profile_image = $default_image; // Ensure the default image path is used if no image exists
}
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
    <title>Driver's Profile</title>
    <link rel="stylesheet" href="../Riders/riderProfile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4" style="margin-top:100px; font-weight:bold;">
            Account settings
        </h4>
        <form action="updateDProfile.php" method="POST" enctype="multipart/form-data">
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-0">
                        <div class="list-group list-group-flush account-settings-links">
                            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#update-rickshaw">Update Rickshaw</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-connections">Connections</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-notifications">Notifications</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-general">
                                <div class="card-body media align-items-center">
                                    <img src="<?php echo htmlspecialchars($profile_image); ?>" class="d-block ui-w-80" id="preview-image" alt="Preview">
                                    <div class="media-body ml-4">
                                        <label class="btn btn-outline-primary">
                                            Upload new photo
                                            <input id="profile-picture" name="profile-picture" type="file" class="account-settings-fileinput">
                                        </label> &nbsp;
                                        <button type="button" class="btn btn-default md-btn-flat" id="reset-button">Reset</button>
                                        <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control mb-1" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-change-password">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Current password</label>
                                        <input type="password" class="form-control" name="current_password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">New password</label>
                                        <input type="password" class="form-control" name="new_password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Repeat new password</label>
                                        <input type="password" class="form-control" name="repeat_new_password">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="update-rickshaw">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Licence</label>
                                        <input type="text" class="form-control" name="licence" value="<?php echo htmlspecialchars($licence); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Experience</label>
                                        <input type="text" class="form-control" name="experience" value="<?php echo htmlspecialchars($experience); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Rickshaw Model</label>
                                        <input type="text" class="form-control" name="rickshaw_model" value="<?php echo htmlspecialchars($rickshaw_model); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-connections">
                                <div class="card-body">
                                    <button type="button" class="btn btn-twitter">Connect to <strong>Twitter</strong></button>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <h5 class="mb-2">
                                        <a href="javascript:void(0)" class="float-right text-muted text-tiny"><i class="ion ion-md-close"></i> Remove</a>
                                        <i class="ion ion-logo-google text-google"></i>
                                        You are connected to Google:
                                    </h5>
                                    <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f9979498818e9c9595b994989095d79a9694">[email&#160;protected]</a>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <button type="button" class="btn btn-facebook">Connect to <strong>Facebook</strong></button>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <button type="button" class="btn btn-instagram">Connect to <strong>Instagram</strong></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-notifications">
                                <div class="card-body pb-2">
                                    <h6 class="mb-4">Activity</h6>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input" checked>
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Email me when Driver accept my request</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input">
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Email me when I get a message from Administration</span>
                                        </label>
                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body pb-2">
                                    <h6 class="mb-4">Application</h6>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input">
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">News and announcements</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input" checked>
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Login from another Device</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right mt-3">
                
                <!-- <button class="ac" onclick="showToast(acceptMsg)">Accept</button>
                <button class="dc" onclick="showToast(declineMsg)">Decline</button> -->
                <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                <a href="driver.php">
                    <button type="button" class="btn btn-default">Cancel</button>
                </a>
            </div>
            
        </form>
        <!-- <div id="toastbox"></div> -->
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        
        // let toastbox = document.getElementById("toastbox");
        // let acceptMsg = '<i class="fa-solid fa-circle-check"></i> Call Accepted';
        // let declineMsg = '<i class="fa-solid fa-circle-xmark"></i> Call Declined';
        
        // function showToast(msg) {
        //     let toast = document.createElement("div");
        //     toast.classList.add("toast");
        //     toast.innerHTML = msg;
        //     toastbox.appendChild(toast);

        //     if (msg.includes('Declined')) {
        //         toast.classList.add('decline');
        //     }
        //     setTimeout(() => {
        //         toast.remove();
        //     }, 5000);
        // }



        const fileInput = document.getElementById('profile-picture');
        const previewImage = document.getElementById('preview-image');

        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.src = '#';
                previewImage.style.display = 'none';
            }
        });

        document.getElementById('reset-button').addEventListener('click', function () {
            previewImage.src = '<?php echo htmlspecialchars($default_image); ?>';
            document.getElementById('profile-picture').value = '';
        });
    </script>
</body>
</html>
