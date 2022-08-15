<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../signup/signup.css">

  <title>Sign up - Newbies Gamers</title>
</head>

<body>
  <div id="id01" class="modal">
    <a href="../home-page/home-page.php">
      <span class="close" title="Return to log in">&times;</span>
    </a>
    <form class="modal-content" action="../php/signup.php" method="post">
      <div class="container">
        <h1 class="title">Sign Up</h1>
        <p class="title">Please fill in this form to create an account.</p>
        <hr>
        <p class="error" id="first_name_error"><?php
                                                session_start();
                                                if (isset($_SESSION['first_name_error'])) {
                                                  echo "<script>document.getElementById('first_name_error').style.display='block';</script>";
                                                  echo $_SESSION['first_name_error'];
                                                  unset($_SESSION['first_name_error']);
                                                } ?></p>
        <label for="first_name"><b>First Name</b></label>
        <input type="text" placeholder="Enter your first name" name="first_name" id="first_name" value="<?php if(isset($_SESSION['first_name'])){ echo $_SESSION['first_name']; } ?>" required>

        <label for="last_name"><b>Last Name</b></label>
        <input type="text" placeholder="Enter your last name" name="last_name" id="last_name" required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="date_of_birth"><b>Date Of Birth</b></label>
        <input type="date" placeholder="Enter your date of birth" name="date_of_birth" id="date_of_birth" required> <br> <br>

        <label for="phone_number"><b>Phone Number</b></label>
        <input type="text" placeholder="Enter your phone number" name="phone_number" id="phone_number" required> <br> <br>

        <label for="address"><b>Address</b></label>
        <input type="text" placeholder="Enter address" name="address" id="address" required>

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter username of your own" name="username" id="username" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password" required>


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


</html>