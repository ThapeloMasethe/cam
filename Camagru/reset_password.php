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
        <div><h4 id="logo"><a href="index.php">Camagru</a></h4></div>
        <div>
            <ul id="gal">
                <li><a href="public_gallery.php">Gallery</a></li>
            </ul>
        </div>
    </header>
    <div class="forgot-password user-container">
        <?php
            session_start();
            echo '<form action="users.php" method="POST">
                    <p>Reset Your Password.</p>
                    <input type="password" name="new-password" placeholder="New Password"    id="reset-password" required><br>
                    <input type="password" name="confirm-new" placeholder="Confirm Password" id="reset-confirm"  required><br>
                    <button type="submit" name="reset-new" class="login">Reset Password</button>
                </form>';
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
         ?>
    </div>
    <?php include('footer.php');?>
    <script src="./js/main.js"></script>
    <script src="./js/check.js"></script>
</body>
</html>