<?php

session_start();
include("../php/connection.php");

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}
$customerid = $_SESSION['logged_id'];
$query = "SELECT first_name, last_name  from customers WHERE customer_id = $customerid";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();


//sum of all customers
$query_total_customers = "SELECT COUNT(customer_id) as count FROM customers";
$stmt_total_customers = $connection->prepare($query_total_customers);
$stmt_total_customers->execute();
$results_total_customers = $stmt_total_customers->get_result();
$row_total_customers = $results_total_customers->fetch_assoc();


//sum of all appointments
$query_total_appointments = "SELECT COUNT(appointment_id) as total_appointments FROM appointments";
$stmt_total_appointments = $connection->prepare($query_total_appointments);
$stmt_total_appointments->execute();
$results_total_appointments = $stmt_total_appointments->get_result();
$row_total_appointments = $results_total_appointments->fetch_assoc();

//sum of all appointments
$query_total_profit = "SELECT SUM(total_price_including_tax) as total_profit FROM checkouts";
$stmt_total_profit = $connection->prepare($query_total_profit);
$stmt_total_profit->execute();
$results_total_profit = $stmt_total_profit->get_result();
$row_total_profit = $results_total_profit->fetch_assoc();

//getting appointments
$query_get_appointments = "SELECT customer_id,appointment_name,date,status FROM appointments";
$stmt_get_appointments= $connection->prepare($query_get_appointments);
$stmt_get_appointments->execute();
$results_get_appointments = $stmt_get_appointments->get_result();

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
    <!-- <link rel="stylesheet" href="../home-page/home-page.css"> -->
    <!-- <link rel="stylesheet" href="../main/main.css"> -->
    <title>Home Admin - Newbies Gamers</title>
</head>

<body onunload="myFunction()">

    <!-- started popup message login successful -->
    <!-- <div class="popup" id="login-confirmation">
        <img src="../images/tick.png" alt="successfully logged in">
        <h2>Login Successful</h2>
        <p>Welcome to Newbies Gamers</p>
        <button type="button" onclick="RemoveLogInPopUp()">OK</button>
    </div> -->

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
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
                        <span class="las la-receipt"></span>
                        <span>Checkouts</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="la la-product-hunt"></span>
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
        <header>
            <h2>
                <label for="nav-toggle">
                    <span><i class="las la-bars"></i></span>
                </label>

                Dashboard
            </h2>

            <div class="user-wrapper">
                <img src="../images/info.png" width="40px" height="40px" alt="">
                <div>
                    <h4> <?php echo $row["first_name"]," ",$row['last_name']; ?></h4>
                    <small>Admin</small>
                </div>
            </div>
        </header>

        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1><?php echo  $row_total_customers['count'];?></h1>
                        <span>Customers</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php echo $row_total_appointments['total_appointments']?></h1>
                        <span>Appointments</span>
                    </div>
                    <div>
                        <span class="las la-clipboard"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>124</h1>
                        <span>Chekouts</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>$<?php echo $row_total_profit['total_profit']?></h1>
                        <span>Profit</span>
                    </div>
                    <div>
                        <span class="las la-google-wallet"></span>
                    </div>
                </div>
            </div>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Recent Projects</h3>
                            <button>See all <span class="las la-arrow-right"></span></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Project Titles</td>
                                            <td>Customer Name</td>
                                            <td>Date</td>
                                            <td>Status</td>
                                            <td>working status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>UI/Ux Design</td>
                                            <td>ui Team</td>
                                            <td>12/12/2021</td>
                                            <td>
                                                <span class="status red"></span>
                                                in progress
                                            </td>
                                            <td>
                                                <button>Done Work</button>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <button>hello</button>
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
                            <button>See all <span class="las la-arrow-right"></span></button>
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
                                    <span><i class="las la-circle-user"></i></span>
                                    <span><i class="las la-comment"></i></span>
                                    <span><i class="las la-phone"></i></span>
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
                                    <span><i class="las la-circle-user"></i></span>
                                    <span><i class="las la-comment"></i></span>
                                    <span><i class="las la-phone"></i></span>
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
                                    <span><i class="las la-circle-user"></i></span>
                                    <span><i class="las la-comment"></i></span>
                                    <span><i class="las la-phone"></i></span>
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
                                    <span><i class="las la-circle-user"></i></span>
                                    <span><i class="las la-comment"></i></span>
                                    <span><i class="las la-phone"></i></span>
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

</body>

</html>
</php>