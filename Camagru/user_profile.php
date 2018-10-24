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
    <?php include('./includes/user_header.php'); ?>
    <br>
    <div class="tab">
        <button class="tablinks" onclick="open_profile(event, 'Edit')">Edit Profile</button>
        <button class="tablinks" onclick="open_profile(event, 'Change')">Change Password</button>
    </div>

    <div id="Edit" class="tabcontent">
        <h3>Hi <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>, Edit your profile.</h3>
        <form action="">
            email <input type="email" name="email" value="<?php echo $_SESSION['email'];?>"><br>
            username <input type="text" name="username" value="<?php echo $_SESSION['username'];?>"><br>
            first name <input type="text" name="firstname" value="<?php echo $_SESSION['firstname'];?>"><br>
            last name <input type="text" name="lastname" value="<?php echo $_SESSION['lastname'];?>"><br>
            phone number <input type="text" name="cellnumber" value="<?php echo $_SESSION['cellnumber'];?>"><br>
            <input type="hidden" name="editprofile" value="editprofile">
            <input type="submit" value="Submit" id="upload-photo"> <br> 
        </form>
    </div>

    <div id="Change" class="tabcontent">
        <h3>Hi <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>, Change your password.</h3>
        <form action="">
            Old Password <input type="password"><br>
            New Password <input type="password"><br>
            Confirm Password <input type="password"><br>
            <input type="hidden" name="changepassword" value="ok">
            <input type="submit" value="Submit" id="upload-photo"> <br>
        </form>
    </div>
    <?php include('./includes/footer.php'); ?>
    <script src="./js/main.js"></script>
</body>
</html>
    