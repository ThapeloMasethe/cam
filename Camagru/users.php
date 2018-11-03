<?php
    session_start();
    include('config/database.php');
    include('main_functions.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (isset($_POST['login']))
        {   $_SESSION['verified'] = true;
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            try
            {
                $user = $conn->prepare("SELECT * FROM `users` WHERE `username` = '$username' LIMIT 1");
                $user->execute();
            }
            catch (Exception $exc)
            {
                echo "Error: ".$exc->getMessage();
            }
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
                    include('snap.php');
                }
                else
                {
                    $_SESSION['verified'] = false;
                    header('Location: index.php');
                }

            }
        }
        elseif (isset($_POST['signup']))
        {
            $_SESSION['userexist'] == false;
            $username = $_POST['username'];
            $_SESSION['username'] = $username;
            $email = $_POST['email'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $password = $_POST['password'];

            if (strlen($password) < 8)
            {
                header('Location: index.php');
                $_SESSION['shortpassword'] = true;
            }
            elseif (!preg_match("#[0-9]+#", $password))
            {
                header('Location: index.php');
                $_SESSION['nodigits'] = true;
            }
            elseif (!preg_match("#[a-zA-Z]+#", $password))
            {
                header('Location: index.php');
                $_SESSION['nocases'] = true;
            }
            else
            {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 5));
                $user = array($username, $email, $firstname, $lastname, $password);
                sign_up($user, $conn);
            }
        }

        if (isset($_POST['activation'])){
            $username = $_SESSION['username'];
            try
            {
                $user = $conn->prepare("UPDATE `users` SET `user_token` = 'Token Used, User Confirmed'
                WHERE username = '$username'");
                $user->execute();
                header('Location: index.php');
            }
            catch(PDOException $e)
            {
                echo "Error: ". $e->getMessage();
            }
        }
        if (isset($_POST['upload'])){
            $image = $_FILES['image']['name'];
            $target = getcwd().basename($image);
           try{
                $query = "INSERT INTO `images` (username, `image`) VALUES ('$username', '$image')";
                $query->execute();
           }
           catch(PDOException $e){
               echo "Error: " . $e->getMessage();
           }
        }
    }
?>