<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../signup/signup.css">
  <link rel="stylesheet" href="../main/main.css">

  <title>Sign up - Newbies Gamers</title>
</head>

<body>
  <!-- started popup message account created -->
  <div class="popup" id="account-created-confirmation">
    <img src="../images/tick.png" alt="">
    <h2>Account Created Successfully</h2>
    <p>Your account was created successfully. Welcome to Newbies Gamers</p>
    <button type="button" onclick="RemoveAccountCreatedPopUp()">OK</button>
  </div>

  <div id="id01" class="modal">
    <a href="../home-page/home-page.php">
      <span class="close" title="Return to log in">&times;</span>
    </a>
    <form class="modal-content" action="../php/signup.php" method="POST" enctype="multipart/form-data">
      <div class="container">
        <h1 class="title">Sign Up</h1>
        <p class="title">Please fill in this form to create an account.</p>
        <hr>
        <p class="error" id="first_name_error">
          <?php
          session_start();
          if (isset($_SESSION['first_name_error'])) {
            echo "<script>document.getElementById('first_name_error').style.display='block';</script>";
            echo $_SESSION['first_name_error'];
            unset($_SESSION['first_name_error']);
          } ?>
        </p>
        <label for="first_name"><b>First Name</b></label>
        <input type="text" placeholder="Enter your first name" name="first_name" id="first_name" value="<?php if (isset($_SESSION['first_name'])) {
                                                                                                          echo $_SESSION['first_name'];
                                                                                                        } ?>" required />

        <p class="error" id="last_name_error">
          <?php
          if (isset($_SESSION['last_name_error'])) {
            echo "<script>document.getElementById('last_name_error').style.display='block';</script>";
            echo $_SESSION['last_name_error'];
            unset($_SESSION['last_name_error']);
          } ?>
        </p>
        <label for="last_name"><b>Last Name</b></label>
        <input type="text" placeholder="Enter your last name" name="last_name" id="last_name" value="<?php if (isset($_SESSION['last_name'])) {
                                                                                                        echo $_SESSION['last_name'];
                                                                                                      } ?>" required>

        <p class="error" id="email_error">
          <?php
          if (isset($_SESSION['email_error'])) {
            echo "<script>document.getElementById('email_error').style.display='block';</script>";
            echo $_SESSION['email_error'];
            unset($_SESSION['email_error']);
          } ?>
        </p>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" value="<?php if (isset($_SESSION['email'])) {
                                                                                      echo $_SESSION['email'];
                                                                                    } ?>" required>

        <label for="date_of_birth"><b>Date Of Birth</b></label>
        <input type="date" placeholder="Enter your date of birth" name="date_of_birth" id="date_of_birth" value="<?php if (isset($_SESSION['date_of_birth'])) {
                                                                                                                    echo $_SESSION['date_of_birth'];
                                                                                                                  } ?>" required> <br> <br>


        <p class="error" id="phone_number_error">
          <?php
          if (isset($_SESSION['phone_number_error'])) {
            echo "<script>document.getElementById('phone_number_error').style.display='block';</script>";
            echo $_SESSION['phone_number_error'];
            unset($_SESSION['phone_number_error']);
          } ?>
        </p>
        <label for="phone_number"><b>Phone Number</b></label>
        <input type="text" placeholder="Enter your phone number" name="phone_number" id="phone_number" value="<?php if (isset($_SESSION['phone_number'])) {
                                                                                                                echo $_SESSION['phone_number'];
                                                                                                              } ?>" required> <br> <br>

        <p class="error" id="address_error">
          <?php
          if (isset($_SESSION['address_error'])) {
            echo "<script>document.getElementById('address_error').style.display='block';</script>";
            echo $_SESSION['address_error'];
            unset($_SESSION['address_error']);
          } ?>
        </p>
        <label for="address"><b>Address</b></label>
        <input type="text" placeholder="Enter address" name="address" id="address" value="<?php if (isset($_SESSION['address'])) {
                                                                                            echo $_SESSION['address'];
                                                                                          } ?>" required>

        <p class="error" id="city_error">
          <?php
          if (isset($_SESSION['city_error'])) {
            echo "<script>document.getElementById('city_error').style.display='block';</script>";
            echo $_SESSION['city_error'];
            unset($_SESSION['city_error']);
          } ?>
        </p>
        <label for="city"><b>City</b></label>
        <input type="text" placeholder="Enter city" name="city" id="city" value="<?php if (isset($_SESSION['city'])) {
                                                                                    echo $_SESSION['city'];
                                                                                  } ?>" required>

        <p class="error" id="username_error">
          <?php
          if (isset($_SESSION['username_error'])) {
            echo "<script>document.getElementById('username_error').style.display='block';</script>";
            echo $_SESSION['username_error'];
            unset($_SESSION['username_error']);
          } ?>
        </p>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter username of your own" name="username" id="username" value="<?php if (isset($_SESSION['username'])) {
                                                                                                            echo $_SESSION['username'];
                                                                                                          } ?>" required>

        <label><b>Upload Profile Image:</b></label>
        <br>
        <input type="file" title="Choose from your files an image for your profile" name="customer_image" id="customer_image" value="" required>
        <br>

        <p class="error" id="password_error">
          <?php
          if (isset($_SESSION['password_error'])) {
            echo "<script>document.getElementById('password_error').style.display='block';</script>";
            echo $_SESSION['password_error'];
            unset($_SESSION['password_error']);
          } ?>
        </p>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password" value="<?php if (isset($_SESSION['password'])) {
                                                                                                    echo $_SESSION['password'];
                                                                                                  } ?>" required>


        <div class="clearfix">
          <a href="../home-page/home-page.php">
            <button type="button" class="cancelbtn" title="Return to Home Page">Back to
              Home</button>
          </a>
          <button type="submit" class="signupbtn" title="Sign Up"><strong>Sign Up</strong></button>
        </div>
      </div>
    </form>

  </div>

</body>

<script src="../signup/signup.js"></script>


</html>