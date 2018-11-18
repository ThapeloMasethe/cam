<?php
    session_start();
    include_once('connection.php');
    
    //Confirm change of password.
    if (isset($_POST['confirmation'])){
        $username = $_SESSION['username'];
        try{
            $query = $conn->prepare("SELECT * FROM `users` WHERE `username` = '$username'");
            $query->execute();
        }catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
        }
        $row          = $query->fetch(PDO::FETCH_ASSOC);
        $uid          = $row['token'];
        $hash         = $row['password'];
        $email        = $row['email'];
        $old_password = $_SESSION['oldpassword'];
        $new_password = $_SESSION['newpassword'];
        $password     = password_hash($new_password, PASSWORD_BCRYPT, array('cost' => 5));
        if (password_verify($old_password, $hash)){
            try{
                $change_password = $conn->prepare("UPDATE `users` SET `password` = '$password'");
                $change_password->execute();
                $_SESSION['passwordchanged'] = true;
                header('Location: index.php');
            }catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
        }
    }
    if (isset($_POST['reset-password'])){
        $method = $_POST['reset-method'];
        try{
            $query = $conn->prepare("SELECT `email` FROM `users`
            WHERE `username` = '$method' OR `email` = '$method'");
            $_SESSION['isreset'] = false;
            $query->execute();
            /* header('Location: forgot_password.php'); */
            /* echo $_SESSION['isreset']; */
        }catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
        }
        $reset_email = $query->fetch(PDO::FETCH_ASSOC);
        $re          = $reset_email['email'];
        try{
            $query = $conn->prepare("SELECT `user_token` FROM `users`
            WHERE `email` = '$re'");
            $query->execute();
        }catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
        }
        $uid     = $query->fetch(PDO::FETCH_ASSOC);
        $token   = $uid['user_token'];
        $subject = "Forgot Password";
        $url     = "http://127.0.0.1:8080/cam/camagru/forgot_password.php?token=$token";
        $message = "Please click the link below to reset your Camagru password $url";
        mail($re, $subject, $message);
        header('Location: forgot_password.php');
    }
    if (isset($_POST['reset-new'])){
     /*    try{
            $query = $conn->prepare("SELECT * FROM `users` WHERE `email` = '$username'");
            $query->execute();
        }catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
        } */
        echo 'im here';
        echo $_GET['token'];
    }
?>