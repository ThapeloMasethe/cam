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
            $check = $conn->prepare('SELECT * FROM users WHERE email="' . $user[0] . '"');
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
            include('index.php');
        }
        else
        {
            echo "There we go!";
             try
            {
                $add = $conn->prepare('INSERT INTO users(email, firstname, lastname, username, cellnumber, password)
                VALUES("' . $user[0] . '","' . $user[1] . '","' . $user[2] . '", "' . $user[3] . '", "' . $user[4] . '", "' . $user[5]. '")');
                $add->execute();
            }
            catch (Exception $e)
            {
                echo "SQL not performed!". $e->getMessage();
            }
            send_mail($user[0], $user[3]);
            die();
        }
    }
    function generate_token($username)
    {
        $token = sha1(uniqid($username, true));
        $query = $conn->prepare('INSERT INTO pending_users(token, username, timestmp)
        VALUES("'. $token . '","' . $username . '", "'. $_SERVER["REQUEST_TIME"] .'")');
        $query->execute();
    }

    function send_mail($email, $username)
    {
        $token = sha1(uniqid($username, true));
        $subject = "Registration";
        $url = "http://127.0.0.1:8080/cam/camagru/activation.php?token=$token";

        try
        {
            $query = $conn->prepare('INSERT INTO pending_users(token, username, timestmp)
            VALUES("'. $token . '","' . $username . '", "'. $_SERVER["REQUEST_TIME"] .'")');
            $query->execute();
        }
        catch(Exception $e)
        {
            echo "Error: ".$e->getMessage();
        }

        $message = "Please click the link below to comfrim your registration to Camagru $url";
        mail($email, $subject, $message);
    }
?>