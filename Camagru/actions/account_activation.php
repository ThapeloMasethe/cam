<?php
    include_once('connection.php');
    if (isset($_POST['activation'])){
        $username = $_SESSION['username'];
        try{
            $user = $conn->prepare("UPDATE `users` SET `verified` = 'Y'
            WHERE username = '$username'");
            $user->execute();
            header('Location: index.php');
        }catch(PDOException $e){
            echo "Error: ". $e->getMessage();
        }
    }
?>