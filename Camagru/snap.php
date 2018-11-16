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
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="user_profile.php">Profile</a></li>
                <li><a href="index.php" id="logout">Logout</a></li>
            </ul>
        </div>
    </header>
    <div class="video-container">
        <video  id="video"></video>
        <button id="photo">Take Photo</button>
        <form action="users.php"  method="POST" enctype="multipart/form-data">
            <input  type="file"   name="image"  size="25" />
            <input type="submit" value="Upload Image" name="upload">
        </form>
        <canvas id="canvas" ></canvas>
    </div>

    <div id="gallery" class="gallery">
        <div class="superpose">
            <h4>Edit Yout Photo</h4>
            <div class="filters"><img id="pose"  src="./filters/bunny.png"     onclick="add_superpose(id)"  alt=""></div>
            <div class="filters"><img id="pose1" src="./filters/colorsky.png"  onclick="add_superpose(id)"  alt=""></div>
            <div class="filters"><img id="pose2" src="./filters/cupcake.png"   onclick="add_superpose(id)"  alt=""></div>
            <div class="filters"><img id="pose3" src="./filters/floral.png"    onclick="add_superpose(id)"  alt=""></div>
            <div class="filters"><img id="pose4" src="./filters/frame1.png"    onclick="add_superpose(id)"  alt=""></div>
            <div class="filters"><img id="pose5" src="./filters/giraffe.png"   onclick="add_superpose(id)"  alt=""></div>
            <div class="filters"><img id="pose6" src="./filters/vector.png"    onclick="add_superpose(id)"  alt=""></div>
        </div>
        <div class="edit-panel" id="edit-panel">
            <div id="pre-edit"></div>
            <form>
            <input id="upload-photo" type="submit" value="Save Your Photo" name="save-photo" onclick="save_photo()">
        </div>
        <canvas id="gallery-canvas"></canvas>
        <div id="edited"></div>
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