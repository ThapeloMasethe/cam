<?php
    session_start();
    include_once('connection.php');
    if (isset($_POST['reset-password'])){
        $method = $_POST['reset-method'];
        try{
            $query = $conn->prepare("SELECT `email` FROM `users`
            WHERE `username` = '$method' OR `email` = '$method'");
            $query->execute();
        }catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
        }
        $reset_email = $query->fetch(PDO::FETCH_ASSOC);
    } 
?>