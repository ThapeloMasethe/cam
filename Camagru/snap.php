<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Camagru</title>
    <meta name="viewport"   content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  type="text/css" media="screen" href="./css/main.css" />
</head>
<body>
    <header>
        <div><h4 id="logo"><a href="gallery.php">Camagru</a></h4></div>
        <div>
            <ul id="gal">
                <!-- <li><a href="index.php">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li> -->
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="user_profile.php">Profile</a></li>
                <li><a href="index.php" id="logout">Logout</a></li>
            </ul>
        </div>
    </header>
    <div class="video-container">
        <video  id="video"></video>
        <button id="photo">Take Photo</button>
        <form action="users.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="image" size="25" />
            <button id="upload-photo" type="submit" name="upload">Upload Photo</button>
        </form>
        <canvas id="canvas"></canvas>
    </div>

    <div id="gallery" class="gallery">
        <h1>Gallery</h1>
    </div>
    <?php include('./includes/footer.php'); ?>
    <script src="./js/main.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
    </script>
</body>
</html>