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

        <?php if (isset($_GET['first_name_error'])) { ?>
          <p class="error"><?php echo $_GET['first_name_error']; ?></p>
        <?php } ?>
        <label for="first_name"><b>First Name</b></label>
        <input type="text" placeholder="Enter your first name" name="first_name" id="first_name" required>

        <?php if (isset($_GET['last_name_error'])) { ?>
          <p class="error"><?php echo $_GET['last_name_error']; ?></p>
        <?php } ?>
        <label for="last_name"><b>Last Name</b></label>
        <input type="text" placeholder="Enter your last name" name="last_name" id="last_name" required>

        <?php if (isset($_GET['email_error'])) { ?>
          <p class="error"><?php echo $_GET['email_error']; ?></p>
        <?php } ?>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="date_of_birth"><b>Date Of Birth</b></label>
        <input type="date" placeholder="Enter your date of birth" name="date_of_birth" id="date_of_birth" required> <br> <br>

        <label for="phone_number"><b>Phone Number</b></label>
        <input type="text" placeholder="Enter your phone number" name="phone_number" id="phone_number" required> <br> <br>

        <?php if (isset($_GET['address_error'])) { ?>
          <p class="error"><?php echo $_GET['address_error']; ?></p>
        <?php } ?>
        <label for="address"><b>Address</b></label>
        <input type="text" placeholder="Enter address" name="address" id="address" required>

        <?php if (isset($_GET['username_error'])) { ?>
          <p class="error"><?php echo $_GET['username_error']; ?></p>
        <?php } ?>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter username of your own" name="username" id="username" required>

        <?php if (isset($_GET['password_error'])) { ?>
          <p class="error"><?php echo $_GET['password_error']; ?></p>
        <?php } ?>
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

</php>