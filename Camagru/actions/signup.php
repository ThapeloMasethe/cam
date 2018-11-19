<?php
    session_start();
    include_once('connection.php');
    include('main_functions.php');
    if (isset($_POST['signup'])){
        $email                 = $_POST['email'];
        $lastname              = $_POST['lastname'];
        $password              = $_POST['password'];
        $username              = $_POST['username'];
        $firstname             = $_POST['firstname'];
        $_SESSION['userexist'] = false;

        if (strlen($password) < 8){
            header('Location: index.php');
            $_SESSION['shortpassword'] = true;
        }
        elseif (!preg_match("#[0-9]+#", $password)){
            header('Location: index.php');
            $_SESSION['nodigits'] = true;
        }
        elseif (!preg_match("#[a-zA-Z]+#", $password)){
            header('Location: index.php');
            $_SESSION['nocases'] = true;
        }
        else{
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 5));
            $user     = array($username, $email, $firstname, $lastname, $password);
            $_SESSION['username'] = $username;
            sign_up($user, $conn);
        }
    }
    function sign_up($user, $conn){
        try{
            $check = $conn->prepare('SELECT * FROM users WHERE email="' . $user[1] . '"');
            $check->execute();
        }
        catch (Exception $exc){
            echo "Error: ".$exc->getMessage();
        }
        $num = $check->rowCount();
        if ($num > 0){
            $_SESSION['userexist'] = true;
            header('Location: index.php');
        }
        else{
            try{
                $add = $conn->prepare('INSERT INTO users(username, email, firstname, lastname, password)
                VALUES("' . $user[0] . '","' . $user[1] . '","' . $user[2] . '", "' . $user[3] . '", "' . $user[4] . '")');
                $add->execute();
            }
            catch (Exception $e){
                echo "SQL not performed! Error: ". $e->getMessage();
            }
            //Generate unique token.
            $uid = md5(uniqid($user[0]));
            try{
                $update = $conn->prepare("UPDATE `users` SET `user_token` = '$uid'
                WHERE username = '$user[0]'");
                $update->execute(); 
                send_mail($user[1], $uid);
                $_SESSION['registered'] = true;
                header('Location: index.php');
            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            die();
        }
    }
?>