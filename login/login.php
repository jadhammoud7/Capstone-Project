<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </meta>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../main/main.css">
    <link rel="stylesheet" href="../login/login.css">
    <title>Welcome To Newbies Gamers</title>
</head>

<body>
    <div class="center">
        <h1>Login</h1>
        <form action="../php/login.php" method="post">
            <p class="error" id="username_error">
            <?php
               session_start();
               if(isset($_SESSION['username_error'])){
                   echo "<script>document.getElementById('username_error').style.display='block';</script>";
                   echo $_SESSION['username_error'];
                   unset($_SESSION['username_error']);
               }
             ?>
            </p>
            <div class="txt_field">
                <input name="username" type="text" value="<?php if (isset($_SESSION['username'])) {
                                                                   echo $_SESSION['username'];
                                                                } ?>"required>
                <label>Username</label>
            </div>
            <p class="error" id="password_error">
                <?php
                 session_start();
                 if(isset($_SESSION['password_error'])){
                   echo "<script>document.getElementById('password_error').style.display='block';</script>";
                   echo $_SESSION['password_error'];
                   unset($_SESSION['password_error']);
                 }
                ?>
            </p>
            <div class="txt_field">
                <input name="password" type="password" value="<?php if (isset($_SESSION['password'])) {
                                                                   echo $_SESSION['password'];
                                                                } ?>"required>
                <label>Password</label>
            </div>
            <a>
                <input name="login" type="submit" value="Log In" />
            </a>
        </form>

        <div class="" style="margin:20px 20px 20px 60px;"> Don't have an account? <a href="../signup/signup.php">Signup</a> </div>

    </div>
</body>

</html>
