<?php
    session_start();
    include_once('connection.php');
    //Upload picture.
     if (isset($_POST['upload'])){
        $username   = $_SESSION['username'];
        $file       = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        try{
            $query  = $conn->prepare('INSERT INTO `images` (username, imagename, `type`)
            VALUES ("'.$username.'", "'.$file.'", "uploaded")');
            $query->execute();
            $_SESSION['imguploaded'] = true;
            header('Location: snap.php');
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
    // Save the edited photo.
    if (isset($_POST['save-photo'])){
        $username   = $_SESSION['username'];
        $file = $_POST['snap'];
        echo $username;
        try{
            $query = $conn->prepare('INSERT INTO `images` (username, imagename, `type`)
            VALUES ("'.$username.'", "'.$file.'", "snapped")');
            $query->execute();
            $_SESSION['imgsaved'] = true;
            header('Location: snap.php');
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
    // Taking a photo.
    if (isset($_POST['take-photo'])){
        $_SESSION['phototaken'] = true;
        header('Location: snap.php');
    }
?>