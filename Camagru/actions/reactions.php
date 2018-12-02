<?php
    session_start();
    include('connection.php');
    if (isset($_POST['comment'])){
        try{
            $query = $conn->prepare('INSERT INTO `comments` (username, imageid, comment)
            VALUES ("'.$_SESSION['username'].'", "'.$_POST['imageid'].'", "'.$_POST['comment-box'].'")');
            $query->execute();
            try{
                $query = $conn->prepare('SELECT * FROM `users`
                WHERE "'.$_SESSION['username'].'" = `username` ');
                $query->execute();
            }catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
            $row     = $query->fetch(PDO::FETCH_ASSOC);
            $email   = $row['email'];
            $subject = "Comments";
            $url     = "http://127.0.0.1:8080/cam/camagru/index.php";
            $message = "Someone commented on your photo, login to read the comments. $url";
            mail($email, $subject, $message);
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