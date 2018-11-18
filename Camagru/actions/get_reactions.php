<?php
    session_start();
    include_once('connection.php');
    try{
        $query = $conn->prepare('SELECT * FROM `images` ORDER BY DATE DESC');
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            echo '<div class="pagination">
                    <strong>'.$row['username'].'</strong> posted a photo.
                    <img src="data:image/jpeg;base64,'.base64_encode($row['imagename'] ).'" height="200" width="200" class="img-thumnail" />';
            try{
                $imgid = $row['imageid'];
                $get_likes = $conn->prepare("SELECT `username`, `imageid` FROM `likes`
                WHERE `imageid` = '$imgid'");
                $get_likes->execute();
            }catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
            $no_likes = $get_likes->rowCount();
            echo '  <form action="users.php" method="POST">
                        <input type="hidden" name="imageid" value="'.$row['imageid'].'" >
                        <input type="submit" value="like" name="like" id="like" float="left">
                    </form>';
            if ($no_likes == 1)
                echo '1 like<br>';
            else{
                echo '              '.$no_likes.' likes<br>'; 
            }
            try{
                $imgid = $row['imageid'];
                $get_comments = $conn->prepare("SELECT * FROM `comments` 
                WHERE `imageid` = '$imgid'
                ORDER BY `comment_date`");
                $get_comments->execute();
                while($row_comments = $get_comments->fetch(PDO::FETCH_ASSOC)){
                    echo '<strong>'.$row_comments['username'].' </strong>';
                    echo $row_comments['comment'] .'<br>';
                }
            }catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
            echo'   <form action="users.php" method="POST">
                        <textarea name="comment-box" id="comment-box" placeholder="Add comment..." cols="20" required></textarea><br>
                        <input type="hidden" name="imageid" value="'.$row['imageid'].'" >
                        <input type="hidden" name="comment" value="comment"><br>
                        <input type="submit" value="comment" name="comment" id="comment"><br>
                    </form>
                </div>';
            echo '<hr>';
            }
    }catch(PDOException $e){
        echo 'Error: '. $e->getMessage();
    }
?>