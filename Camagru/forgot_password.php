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
            if ($_SESSION['isreset'] == true){
                echo '<h3>Reset Your Password</h3>
                        <form action="users.php" method="POST">
                            <p>We can help you reset your password using your Camagru username or the email address linked to your account.</p>
                            <!-- <label for="reset-method"><strong>Email or Username</strong></label><br> -->
                            <p><strong>Email or Username</strong></p>
                            <input type="text" name="reset-method" required><br>
                            <button type="submit" name="reset-password" class="login">Reset Password</button>
                        </form>';
            }
            else if($_SESSION['isreset'] == false){
                echo '<form action="users.php" method="POST">
                        <p>Reset Your Password.</p>
                        <input type="password" name="new-password" required><br>
                        <input type="password" name="confirm-new" required><br>
                        <button type="submit" name="reset-new" class="login">Reset Password</button>
                    </form>';
            }
         ?>
    </div>
    <?php include('footer.php');?>
    <script href="./js/main.js"></script>
</body>
</html>