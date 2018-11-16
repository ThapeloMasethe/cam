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
        <div><h4 id="logo"><a href="index.php">Camagru</a></h4></div>
        <div>
            <ul id="gal">
                <li><a href="index.php">SignIn/SignUp</a></li>
                <!-- <li><a href="user_profile.php">Profile</a></li>
                <li><a href="index.php" id="logout">Logout</a></li> -->
            </ul>
        </div>
    </header>
    <div class="gallery-container">
        <?php
            session_start();
            include_once('connection.php');
                    /* include_once('./config/database.php'); */
            try{
                $query = $conn->prepare('SELECT * FROM `images` ORDER BY DATE DESC');
                $query->execute();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    echo '<div class="pagination">
                            <p><strong>'.$row['username'].'</strong> posted a photo. </p>
                            <img src="data:image/jpeg;base64,'.base64_encode($row['imagename'] ).'" height="200" width="200" class="img-thumnail" />
                        </div>';
                    }
            }catch(PDOException $e){
                echo 'Error: '. $e->getMessage();
            }
        ?>
    </div>
    <?php include('./includes/footer.php'); ?>
    <script src="./js/main.js"></script>
</body>
</html>