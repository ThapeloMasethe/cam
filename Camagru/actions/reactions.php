<?php
    session_start();
    include('connection.php');
    if (isset($_POST['comment'])){
        try{
            $query = $conn->prepare('INSERT INTO `comments` (username, imageid, comment)
            VALUES ("'.$_SESSION['username'].'", "'.$_POST['imageid'].'", "'.$_POST['comment-box'].'")');
            $query->execute();
            header('Location: gallery.php');
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
    if (isset($_POST['like'])){
        try{
            $query = $conn->prepare('INSERT INTO `likes` (username, imageid)
            VALUES("'.$_SESSION['username'].'", "'.$_POST['imageid'].'")');
            $query->execute();
            header('Location: gallery.php');
        }catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }
?>