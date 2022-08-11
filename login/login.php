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
            <div class="txt_field">
                <input name="username" type="text" required>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input name="password" type="password" required>
                <label>Password</label>
            </div>
            <a>
                <input name="login" type="submit" value="Log In" />
            </a>
        </form>

        <div class="" style="margin:20px 20px 20px 60px;"> Don't have an account? <a href="signup_user.php">Signup</a> </div>

    </div>
</body>

</html>