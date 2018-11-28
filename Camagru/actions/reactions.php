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
        $usr    = $_SESSION['username'];
        $imgid  = $_POST['imageid'];
        try{
            $query = $conn->prepare("SELECT `username`,`imageid` FROM `likes`
            WHERE '$usr' = `username` AND '$imgid' = `imageid`");
            $query->execute();
        }catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
        }
        if ($query->rowCount() < 1){
            try{
                $like = $conn->prepare('INSERT INTO `likes` (username, imageid)
                VALUES("'.$_SESSION['username'].'", "'.$_POST['imageid'].'")');
                $like->execute();
                header('Location: gallery.php');
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }
        }else if ($query->rowCount() >= 1){
            try{
                $like = $conn->prepare("DELETE FROM `likes`
                WHERE '$usr' = `username` AND '$imgid' = `imageid`");
                $like->execute();
                header('Location: gallery.php');
            }catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
        }
    }
?>