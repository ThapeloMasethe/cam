<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css" />
    <script src="main.js"></script>
</head>
<body>
    <header>
        <div><h4 id="logo"><a href="gallery.php">Camagru</a></h4></div>
        <div>
            <ul id="gal">
                <!-- <li><a href="index.php">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li> -->
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="snap.php">Snap</a></li>
                <li><a href="user_profile.php">Profile</a></li>
                <li><a href="index.php" id="logout">Logout</a></li>
            </ul>
        </div>
    </header>
    <br>
    <div class="tab">
        <button class="tablinks active" onclick="open_profile(event, 'Edit')">Edit Profile</button>
        <button class="tablinks" onclick="open_profile(event, 'Change')">Change Password</button>
    </div>

    <div id="Edit" class="tabcontent">
        <h3>Hi <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>, Edit your profile.</h3>
        <form action="" class="user-profile">
            <p>email</p><input type="email" name="email" value="<?php echo $_SESSION['email'];?>">
            <p>username</p><input type="text" name="username" value="<?php echo $_SESSION['username'];?>">
            <p>first name</p> <input type="text" name="firstname" value="<?php echo $_SESSION['firstname'];?>">
            <p>last name</p><input type="text" name="lastname" value="<?php echo $_SESSION['lastname'];?>">
            <input type="hidden" name="editprofile" value="editprofile"><br>
            Email preference <input type="checkbox" name="user-preference" checked="false">
            <br><input type="submit" value="Submit" id="upload-photo">
        </form>
    </div>

    <div id="Change" class="tabcontent">
        <h3>Hi <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>, Change your password.</h3>
        <form action="" class="user-profile">
            <p>Old Password</p><input type="password">
            <p>New Password</p><input type="password">
            <p>Confirm Password</p><input type="password">
            <input type="hidden" name="changepassword" value="ok"><br>
            <br><input type="submit" value="Submit" id="upload-photo">
        </form>
    </div>
    <?php include('./includes/footer.php'); ?>
    <script src="./js/main.js"></script>
</body>
</html>
    