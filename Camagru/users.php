<?php
    session_start();
    include('config/database.php');
    include('main_functions.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (isset($_POST['login']))
        {   $_SESSION['verified'] = true;
            $email = $_POST['email'];
            $password = $_POST['password'];
            try
            {
                $user = $conn->prepare("SELECT * FROM users WHERE email='$email' LIMIT 1");
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
                    include('camagru.php');
                }
                else
                {
                    $_SESSION['verified'] = false;
                    include('index.php');
                }

            }
        }
        elseif (isset($_POST['signup']))
        {
            $_SESSION['userexist'] == false;
            $email = $_POST['email'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $cellnumber = $_POST['cellnumber'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 5));
            $user = array($email, $firstname, $lastname, $username, $cellnumber, $password);
            sign_up($user, $conn);
        }
        else if(isset($_POST['editprofile']))
        {
            echo "edit your profile here";
        }
    }
?>