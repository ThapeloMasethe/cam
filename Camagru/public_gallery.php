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
            </ul>
        </div>
    </header>
    <div class="gallery-container">
        <?php
             session_start();
             include_once('connection.php');
         
             $images_per_page = 5;
             try{
                 $query = $conn->prepare("SELECT * FROM `images`");
                 $query->execute();
                }catch(PDOException $e){
                    echo 'Error: '.$e->getMessage();
                }
            $number_of_images = $query->rowCount();
            $number_of_pages  = ceil($number_of_images / $images_per_page);
         
             if (!isset($_GET['page'])) {
                 $page = 1;
             }else {
                 $page = $_GET['page'];
             }
             $first_pages = ($page - 1) * $images_per_page;
             try{
                 $query = $conn->prepare("SELECT * FROM `images` LIMIT $first_pages , $images_per_page");
                 $query->execute();
             }catch(PDOException $e){
                 echo 'Error: '.$e->getMessage();
             }
             while($row = $query->fetch(PDO::FETCH_ASSOC)){
                 echo '<div class="pagination">
                         <strong>'.$row['username'].'</strong> posted a photo.';
                         if ($row['type'] == 'uploaded'){
                            echo '<img src="data:image/jpeg;base64,'.base64_encode($row['imagename'] ).'" height="200" width="200" class="img-thumnail" />';
                         }else if ($row['type'] == 'snapped'){
                            echo '<img src="'.($row['imagename']).'" height="200" width="200" class="img-thumnail" />';
                         }
            }
             for ($page=1;$page<=$number_of_pages;$page++) {
                 echo '<a class="pages" href="public_gallery.php?page=' . $page . '">' . $page . '</a> ';
            }
        ?>
    </div>
    <?php include('./includes/footer.php'); ?>
    <script src="./js/main.js"></script>
</body>
</html>