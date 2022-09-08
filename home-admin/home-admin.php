<?php

session_start();
include("../php/connection.php");

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    </meta>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../home-admin/home-admin.css">
    <link rel="stylesheet" href="../home-page/home-page.css">
    <link rel="stylesheet" href="../main/main.css">
    <title>Home Admin - Newbies Gamers</title>
</head>

<body onunload="myFunction()">
    <!-- started with the menu bar -->
    <!-- <header>
        <nav class="nav-bar" id="hhh">
            <a href="" class="nav-branding">Newbie Gamers.</a>
        </nav>
    </header> -->
    <!-- ended with the menu bar -->

    <!-- started popup message login successful -->
    <div class="popup" id="login-confirmation">
        <img src="../images/tick.png" alt="successfully logged in">
        <h2>Login Successful</h2>
        <p>Welcome to Newbies Gamers</p>
        <button type="button" onclick="RemoveLogInPopUp()">OK</button>
    </div>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>
                <span class="lab la-newbiesgamers"></span> <span>Newbies Gamers</span>
            </h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="">
                        <span class="las la-igloo" class="active"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="las la-users"></span>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="las la-clipboard-list"></span>
                        <span>Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="las la-shipping-bag"></span>
                        <span>Checkouts</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="las la-receipt"></span>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="las la-user-circle"></span>
                        <span>Accounts</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h2>
                <label for="nav-toggle">
                    <span><i class="fa fa-bars"></i></span>
                </label>

                Dashboard
            </h2>



            <div class="user-wrapper">
                <img src="../images/info.png" width="40px" height="40px" alt="">
                <div>
                    <h4>John Doe</h4>
                    <small>Admin</small>
                </div>
            </div>
        </div>

        <main>
            <div class="dashboard-cards">
                <div class="card-single">
                    <div>
                        <h1>54</h1>
                        <span>Customers</span>
                    </div>
                    <div>
                        <span><i class="fa fa-user"></i></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>79</h1>
                        <span>Appointments</span>
                    </div>
                    <div>
                        <span><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>124</h1>
                        <span>Chekouts</span>
                    </div>
                    <div>
                        <span><i class="fa fa-shopping-bag" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>$6000</h1>
                        <span>Income</span>
                    </div>
                    <div>
                        <span><i class="fa fa-google-wallet"></i></span>
                    </div>
                </div>
            </div>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Recent Projects</h3>
                            <button>See all <span><i class="fa fa-arrow-right"></i></span></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Project Titles</td>
                                            <td>Department</td>
                                            <td>Status</td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>UI/Ux Design</td>
                                            <td>ui Team</td>
                                            <td>
                                                <span class="status purple"></span>
                                                review
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Web Developement</td>
                                            <td>Frontend Team</td>
                                            <td>
                                                <span class="status pink"></span>
                                                in progress
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ushop app</td>
                                            <td>Mobile Team</td>
                                            <td>
                                                <span class="status orange"></span>
                                                pending
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>UI/Ux Design</td>
                                            <td>ui Team</td>
                                            <td>
                                                <span class="status purple"></span>
                                                review
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Web Developement</td>
                                            <td>Frontend Team</td>
                                            <td>
                                                <span class="status pink"></span>
                                                in progress
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ushop app</td>
                                            <td>Mobile Team</td>
                                            <td>
                                                <span class="status orange"></span>
                                                pending
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>UI/Ux Design</td>
                                            <td>ui Team</td>
                                            <td>
                                                <span class="status purple"></span>
                                                review
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Web Developement</td>
                                            <td>Frontend Team</td>
                                            <td>
                                                <span class="status pink"></span>
                                                in progress
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ushop app</td>
                                            <td>Mobile Team</td>
                                            <td>
                                                <span class="status orange"></span>
                                                pending
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="customers">
                    <div class="card">
                        <div class="card-header">
                            <h3>New Customer</h3>
                            <button>See all <span><i class="fa fa-arrow-right"></i></span></button>
                        </div>
                        <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="../images/console.png" alt="" width="40px" height="40px">
                                    <div>
                                        <h4>Lewis hhhh</h4>
                                        <small>CEO expert</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span><i class="fa fa-circle-user"></i></span>
                                    <span><i class="fa fa-comment-alt"></i></span>
                                    <span><i class="fa fa-phone"></i></span>
                                </div>
                            </div>
                            <div class="customer">
                                <div class="info">
                                    <img src="../images/console.png" alt="" width="40px" height="40px">
                                    <div>
                                        <h4>Lewis hhhh</h4>
                                        <small>CEO expert</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span><i class="fa fa-circle-user"></i></span>
                                    <span><i class="fa fa-comment-alt"></i></span>
                                    <span><i class="fa fa-phone"></i></span>
                                </div>
                            </div>
                            <div class="customer">
                                <div class="info">
                                    <img src="../images/console.png" alt="" width="40px" height="40px">
                                    <div>
                                        <h4>Lewis hhhh</h4>
                                        <small>CEO expert</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span><i class="fa fa-circle-user"></i></span>
                                    <span><i class="fa fa-comment-alt"></i></span>
                                    <span><i class="fa fa-phone"></i></span>
                                </div>
                            </div>
                            <div class="customer">
                                <div class="info">
                                    <img src="../images/console.png" alt="" width="40px" height="40px">
                                    <div>
                                        <h4>Lewis hhhh</h4>
                                        <small>CEO expert</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span><i class="fa fa-circle-user"></i></span>
                                    <span><i class="fa fa-comment-alt"></i></span>
                                    <span><i class="fa fa-phone"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>




    <!-- started return to top button -->
    <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
    <!-- ended return to top button -->


<!-- 
    <script src="../home-page/home-page.js"></script>
    <script src="../main/main.js"></script> -->

</body>

</html>
</php>