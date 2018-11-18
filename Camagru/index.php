<?php 
    session_start();
?>
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
                <a href="forgot_password.php">forgot password?</a>
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
    </div>
    <?php include('./includes/footer.php'); ?>
    <script src="./js/main.js"></script>
</body>
</html>