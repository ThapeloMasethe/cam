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
        <h1>Camagru</h1>
    </header>
    <div class="video-container">
        <video id="video">Streaming....</video>
        <button id="photo"> Take Photo</button>
        <select id="filter">
            <option value="grayscale(100%)">Grayscale</option>
            <option value="sepia(100%)">Sepia</option>
            <option value="invert(100%)">Invert</option>
        </select>
        <canvas id="canvas"></canvas>
    </div>

    <div id="gallery" class="gallery">
        <h1>Gallery</h1>
    </div>
    <?php include('footer.php'); ?>
    <script src="./js/main.js"></script>
</body>
</html>