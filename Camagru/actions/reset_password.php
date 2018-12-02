<?php
    session_start();
    include_once('connection.php');
    
    //Change of password.
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

        $password = $new_password;
        if (strlen($password) < 8){
            header('Location: user_profile.php');
            $_SESSION['shortpassword'] = true;
        }elseif (!preg_match("#[0-9]+#", $password)){
            header('Location: user_profile.php');
            $_SESSION['nodigits'] = true;
        }elseif (!preg_match("#[a-zA-Z]+#", $password)){
            header('Location: user_profile.php');
            $_SESSION['nocases'] = true;
        }else{
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
    }
    //Forgot password.
    if (isset($_POST['reset-password'])){
        $method = $_POST['reset-method'];
        try{
            $query = $conn->prepare("SELECT `email` FROM `users`
            WHERE `username` = '$method' OR `email` = '$method'");
            $_SESSION['isreset'] = false;
            $query->execute();
        }catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
        }
        $reset_email       = $query->fetch(PDO::FETCH_ASSOC);
        $re                = $reset_email['email'];
        $_SESSION['email'] = $reset_email['email']; 
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
        $url     = "http://127.0.0.1:8080/cam/camagru/reset_password.php?token=$token";
        $message = "Please click the link below to reset your Camagru password $url";
        mail($re, $subject, $message);
        header('Location: index.php');
    }
    if (isset($_POST['reset-new'])){
        $password = $_POST['new-password'];
        if (strlen($password) < 8){
            header('Location: reset_password.php');
            $_SESSION['shortpassword'] = true;
        }elseif (!preg_match("#[0-9]+#", $password)){
            header('Location: reset_password.php');
            $_SESSION['nodigits'] = true;
        }elseif (!preg_match("#[a-zA-Z]+#", $password)){
            header('Location: reset_password.php');
            $_SESSION['nocases'] = true;
        }else{
            $mail     = $_SESSION['email'];
            $password = password_hash($_POST['new-password'], PASSWORD_BCRYPT, array('cost' => 5));
            try{
                $query = $conn->prepare("UPDATE `users` SET `password` = '$password'
                WHERE `email` = '$mail'");
                $query->execute();
                header('Location: index.php');
                $_SESSION['isreset'] = true;
            }catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
        }
    }
?>