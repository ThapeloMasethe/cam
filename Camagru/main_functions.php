<?php
    function sign_in($user)
    {
        $row = $user->fetch(PDO::FETCH_ASSOC);
        $num = $user->rowCount();
        $hash = $row['password'];
        if ($num > 0)
        {
            if (password_verify($password, $hash))
            {
                $_SESSION['email'] = $row['email'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['cellnumber'] = $row['cellnumber'];
                $_SESSION['loggedin'] = true;
                include('camagru.php');
            }
            else
                echo $_SESSION['verified'] = false;
        }
    }
    
    function sign_up($user, $conn)
    {
        try
        {
            $check = $conn->prepare('SELECT * FROM users WHERE email="' . $user[1] . '"');
            $check->execute();
            header('Location: user_default.php');
        }
        catch (Exception $exc)
        {
            echo "Error: ".$exc->getMessage();
        }
        $num = $check->rowCount();
        if ($num > 0)
        {
            $_SESSION['userexist'] = true;
            header('Location: index.php');
        }
        else
        {
            try
            {
                $add = $conn->prepare('INSERT INTO users(username, email, firstname, lastname, password)
                VALUES("' . $user[0] . '","' . $user[1] . '","' . $user[2] . '", "' . $user[3] . '", "' . $user[4] . '")');
                $add->execute();
            }
            catch (Exception $e)
            {
                echo "SQL not performed! Error: ". $e->getMessage();
            }
            // GENERATE UNIQUE ID FOR USER
            $uid = md5(uniqid($user[0]));
            try
            {
                /* $add = $conn->prepare('INSERT INTO users(user_token)
                VALUES("'. $uid .'")');
                $add->execute(); */
                $update = $conn->prepare("UPDATE `users` SET `user_token` = '$uid'
                WHERE username = '$user[0]'");
                $update->execute(); 
                send_mail($user[1], $uid);
            }
            catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
            die();
        }
    }

    function send_mail($email, $uid)
    {
        /* $token = sha1(uniqid($username, true)); */
        $subject = "Registration";
        $url = "http://127.0.0.1:8080/cam/camagru/activation.php?token=$uid";

     /*    try
        {
            $query = $conn->prepare('INSERT INTO pending_users(token, username, timestmp)
            VALUES("'. $token . '","' . $username . '", "'. $_SERVER["REQUEST_TIME"] .'")');
            $query->execute();
        }
        catch(Exception $e)
        {
            echo "Error: ".$e->getMessage();
        } */

        $message = "Please click the link below to comfrim your registration to Camagru $url";
        mail($email, $subject, $message);
    }

    function password_validator($password)
    {
        $uppercase = preg_match('@[A-Z]',$password);
        $lowercase = preg_match('@[a-z]',$password);
        $number = preg_match('@[0-9]',$password);
        
        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8)
        {
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