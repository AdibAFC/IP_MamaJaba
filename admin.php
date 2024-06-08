<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
                        <img src="images/peep1.jpg" alt="" />
                    </div>
                    <div class="user-details">
                        <p class="title">Admin Panel</p>
                        <p class="name">John Doe</p>
                    </div>
                </div>
                <div class="navv">
                    <div class="menu">
                        <p class="title">Main</p>
                        <ul>
                            <li>
                                <a href="#home">
                                    <i class="fa-solid fa-desktop"></i>
                                    <span class="text">Dashboard</span>
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
                                            <span class="text">Riders</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#sec2">
                                            <span class="text">Drivers</span>
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
                                <a href="#">
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
        <div class="wrapper">
            <div class="container">
                <img src="images/rickshaw_icon.png">
                <span class="num" dat-val="37">000</span>
                <span class="text">Licensed Rickshaws</span>
            </div>

            <div class="container">
                <i class="fa-solid fa-person-circle-check"></i>
                <span class="num" dat-val="40">000</span>
                <span class="text">Recruited Drivers</span>
            </div>

            <div class="container">
                <i class="fa-solid fa-chart-simple"></i>
                <span class="num" dat-val="800">000</span>
                <span class="text">No of Riders</span>
            </div>
            <div class="container">
                <i class="fa-solid fa-user"></i>
                <span class="num" dat-val="3">000</span>
                <span class="text">Admins</span>
            </div>
        </div>
    </div>
    <div class="review">
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
        <div class="slide-container">
            <div class="slide">
                <div class="icon">
                    <i class="fa-solid fa-quote-right"></i>
                </div>
                <div class="user"><img src="images/peep3.jpg">
                    <div class="user-info">
                        <h3>Sofia Delgado</h3>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi ipsam sunt cumque rem
                    nihil quaerat quis! Recusandae repellat inventore quasi.</p>
            </div>
        </div>
        <div class="slide-container">
            <div class="slide">
                <div class="icon">
                    <i class="fa-solid fa-quote-right"></i>
                </div>
                <div class="user">
                    <img src="images/peep4.jpg">
                    <div class="user-info">
                        <h3>Alex Dunphy</h3>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, praesentium
                    exercitationem. Molestiae cupiditate beatae necessitatibus natus itaque, optio, expedita excepturi
                    atque ipsum adipisci possimus illum ut dolorum maxime iure voluptates autem eum non! Distinctio,
                    natus.</p>
            </div>
        </div>
        <div id="next" class="fas fa-chevron-right" onclick="next()"></div>
        <div id="prev" class="fas fa-chevron-left" onclick="prev()"></div>
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
                        <label for="search">Search: <input type="search" id="search" placeholder="Enter name" onkeyup="filterTable()"></label>
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
    </div>
    <script src="admin.js"></script>
</body>

</html>