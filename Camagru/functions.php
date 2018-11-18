<?php

    function send_mail($email, $uid){
        $subject = "Registration";
        $url     = "http://127.0.0.1:8080/cam/camagru/activation.php?token=$uid";
        $message = "Please click the link below to comfrim your registration to Camagru $url";
        mail($email, $subject, $message);
    }

    function password_validator($password){
        $uppercase = preg_match('@[A-Z]',$password);
        $lowercase = preg_match('@[a-z]',$password);
        $number    = preg_match('@[0-9]',$password);
        
        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8){
            $_SESSION['validpass'] = false;
            return false;
        }
        else
            return true;
    }
    function generate_token($username)
    {
        $token = sha1(uniqid($username, true));
        $query = $conn->prepare('INSERT INTO pending_users(token, username, timestmp)
        VALUES("'. $token . '","' . $username . '", "'. $_SERVER["REQUEST_TIME"] .'")');
        $query->execute();
    }
?>