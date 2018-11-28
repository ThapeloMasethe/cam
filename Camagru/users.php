<?php
    session_start();
    include('connection.php');
    include('functions.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        include_once('actions/signin.php');
        include_once('actions/signup.php');
        include_once('actions/account_activation.php');
        include_once('actions/reactions.php');
        include_once('actions/reset_password.php');
        include_once('actions/pictures.php');

        if (isset($_POST['changepassword'])){
            $username = $_SESSION['username'];
            try{
                $query = $conn->prepare("SELECT * FROM `users` WHERE `username` = '$username'");
                $query->execute();
            }catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
            $row                     = $query->fetch(PDO::FETCH_ASSOC);
            $uid                     = $row['token'];
            $hash                    = $row['password'];
            $email                   = $row['email'];
            $_SESSION['newpassword'] = $_POST['newpassword'];
            $_SESSION['oldpassword'] = $_POST['oldpassword'];

            $old_password = $_SESSION['oldpassword'];
            $new_password = $_SESSION['newpassword'];
            if (password_verify($old_password, $hash)){

                $subject = "Password change";
                $url = "http://127.0.0.1:8080/cam/camagru/change_pwd.php?token=$uid";
                $message = "You are about to change your password, please confirm $url";
                mail($email, $subject, $message);
                $_SESSION['pwdemail'] = true;
                header('Location: user_profile.php');
            }
        }
        if (isset($_POST['edit-profile'])){
            $email     = $_POST['email'];
            $username  = $_POST['username'];
            $lastname  = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $emailpref = $_GET['email-prefence'];
            try{
                $modify = $conn->prepare("UPDATE `users`/* (username, email, firstname, lastname, email_pref) */
                SET `username` = '$username', `email` = '$email', `firstname` = '$firstname', `lastname` = '$lastname', `email_pref` = '$emailpref'");
                $modify->execute();
                echo $emailpref;
            }catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
        }
        if (isset($_POST['delete-post'])){
            $imgid = $_POST['imageid'];
            try{
                $query = $conn->prepare("DELETE FROM `images` WHERE `imageid` = '$imgid'");
                $query->ececute();
                header('Location: gallery.php');
            }catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
        }
    }
?>