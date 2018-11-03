<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Camagru</title>
    <meta name="viewport"   content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  type="text/css" media="screen" href="./css/main.css"/>
</head>
<body>
    <header>
        <div><h4 id="logo"><a href="gallery.php">Camagru</a></h4></div>
        <div>
            <ul id="gal">
                <!-- <li><a href="index.php">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li> -->
                <li><a href="snap.php">Snap</a></li>
                <li><a href="user_profile.php">Profile</a></li>
                <li><a href="index.php" id="logout">Logout</a></li>
            </ul>
        </div>
    </header>
    <div class="gallery-container">
        <ul id="infinite-list">
            <p><?php echo $_SESSION['username'] ?> Posted</p>
            <li><img src="./img/download.png" alt=""></li>
            <button type="button">like</button><br>
            <textarea rows="4" cols="50" name="comment" form="usrform"></textarea><br>
            <button type="button">Comment</button>
            <li><img src="./img/download.png" alt=""></li>
            <button type="button">like</button><br>
            <textarea rows="4" cols="50" name="comment" form="usrform"></textarea><br>
            <button type="button">Comment</button>
            <li><img src="./img/download.png" alt=""></li>
            <button type="button">like</button><br>
            <textarea rows="4" cols="50" name="comment" form="usrform"></textarea><br>
            <button type="button">Comment</button>
            <li><img src="./img/download.png" alt=""></li>
            <button type="button">like</button><br>
            <textarea rows="4" cols="50" name="comment" form="usrform"></textarea><br>
            <button type="button">Comment</button>
        </ul>
    </div>
    <?php include('./includes/footer.php'); ?>
    <script src="./js/main.js"></script>
</body>
</html>