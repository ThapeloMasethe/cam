<?php session_start(); ?>
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
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="snap.php">Snap</a></li>
                <li><a href="index.php" id="logout">Logout</a></li>
            </ul>
        </div>
    </header>
    <br>
    <div class="tab">
        <button class="tablinks active" onclick="open_profile(event, 'Edit')">Edit Profile</button>
        <button class="tablinks"        onclick="open_profile(event, 'Change')">Change Password</button>
    </div>

    <div id="Edit" class="tabcontent">
        <h3>Hi <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>, Edit your profile.</h3>
        <form action="users.php"  class="user-profile" method="POST">
            <p>email</p>        <input type="email"    name="email"     value="<?php echo $_SESSION['email'];?>">
            <p>username</p>     <input type="text"     name="username"  value="<?php echo $_SESSION['username'];?>">
            <p>first name</p>   <input type="text"     name="firstname" value="<?php echo $_SESSION['firstname'];?>">
            <p>last name</p>    <input type="text"     name="lastname"  value="<?php echo $_SESSION['lastname'];?>">
            <br>
            Email preference    
            <input type="radio" name="email-preference" value="yes">
            <label for="yes">Yes</label>
            <input type="radio" name="email-preference" value="no" checked>
            <label for="no">No</label>
            <input type="hidden"   value="editprofile" name="editprofile"  ><br>
            <br>
            <input type="submit"   value="Submit"      name="edit-profile" class="upload-photo">
        </form>
    </div>

    <div id="Change" class="tabcontent">
        <h3>Hi <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>, Change your password.</h3>
        <form action="users.php"    class="user-profile"   method="POST">
            <p>Old Password</p>     <input type="password" name="oldpassword">
            <p>New Password</p>     <input type="password" name="newpassword"       id="newpassword">
            <p>Confirm Password</p> <input type="password" name="confirmpassword"   id="confirm-newpassword">
            <input type="hidden" name="changepassword" value="ok">
            <br><br>
            <input type="submit" value="Submit" name="changepassword" class="upload-photo">
        </form>
    </div>
    <?php include('./includes/footer.php'); ?>
    <script src="./js/main.js"></script>
</body>
</html>
    