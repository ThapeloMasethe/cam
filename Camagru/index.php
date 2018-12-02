<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css" />
</head>
<body>
    <div class="container">
    <header>
        <div id="logo">
            <h4 id="title"><a href="#">Camagru</a></h4>
        </div>
        <div>
            <ul id="gal">
                <li><a href="public_gallery.php">Gallery</a></li>
            </ul>
        </div>
        <div id="login">
            <form action="users.php" method="POST" class="login">
                <input  type="text"     name="username" placeholder="username"  required>
                <input  type="password" name="password" placeholder="password"  required>
                <input  type="hidden"   name="login" value="login">
                <button type="submit">LOGIN</button>
                <a href="forgot_password.php" id="fp">forgot password?</a>
            </form>
            
        </div>   
</header>
    <div class="main-container">
        <img src="./img/main.jpg" alt="main">
    </div>
    <div class="user-container">
        <form action="users.php" method="POST">
            <h4>Sign Up</h4>
            <p>Create an account below.</p>
            <input  type="text"    name="username"  placeholder="username"  required> <br>
            <input  type="email"   name="email"     placeholder="email"     required> <br>
            <input  type="text"    name="firstname" placeholder="firstname" required> <br>
            <input  type="text"    name="lastname"  placeholder="lastname"  required> <br>
            <input  id="password"                   type="password"         name="password"         placeholder="Password"          required> <br>
            <input  id="confirm-password"           type="password"         name="confirmpassword"  placeholder="Comfirm Password"  required> <br>
            <input  type="hidden"  name="signup"    value="signup"> <br>
            <button type="submit"  name="submit"    class="user-button">SIGNUP</button> <br>
        </form>
        <?php
            session_start();
            if ($_SESSION['registered'] == true){
                echo '<div class="success">
                        <strong>SUCCESS!</strong> You are successfully registered, check your email to verify.
                    </div>';
                $_SESSION['registered'] = false;
            }
            if ($_SESSION['userexist'] == true){
                echo '<div class="alert" color="red">
                        <strong>ERROR!</strong> Username or Email already exists, Please try another.
                    </div>';
                $_SESSION['userexist'] = false;
            }
            if ($_SESSION['shortpassword'] == true){
                echo '<div class="alert" color="red">
                        <strong>ERROR!</strong> Your password is too short, enter atleast 8 characters.
                    </div>';
                    $_SESSION['shortpassword'] = false;
            }
            if ($_SESSION['nodigits'] == true){
                echo '<div class="alert" color="red">
                        <strong>ERROR!</strong> Your password should contain atleast 1 digit.
                    </div>';
            $_SESSION['nodigits'] = false;
            }
            if ($_SESSION['nocases'] == true){
                echo '<div class="alert" color="red">
                        <strong>ERROR!</strong> Your password should contain atleast 1 Uppercase and Lowercase.
                    </div>';
                $_SESSION['nocases'] = false;
            }
            if ($_SESSION['isreset'] == true){
                '<div class="success">
                    <strong>SUCCESS!</strong> Your password is successfully reset. Now you can login!
                </div>';  
            }
         ?>
    </div>
    <?php include('./includes/footer.php'); ?>
    <script src="./js/main.js"></script>
    <script src="./js/check.js"></script>
    </div>
</body>
</html>