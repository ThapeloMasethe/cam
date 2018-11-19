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
            echo '<form action="users.php" method="POST">
                    <p>Reset Your Password.</p>
                    <input type="password" name="new-password" placeholder="New Password"    id="reset-password" required><br>
                    <input type="password" name="confirm-new" placeholder="Confirm Password" id="reset-confirm"  required><br>
                    <button type="submit" name="reset-new" class="login">Reset Password</button>
                </form>';
         ?>
    </div>
    <?php include('footer.php');?>
    <script href="./js/main.js"></script>
</body>
</html>