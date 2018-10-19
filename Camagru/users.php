<?php
    session_start();
    include('config/database.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (isset($_POST['login']))
        {
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
                    /* $_SESSION['username'] = $row['username']; */
                    $_SESSION['loggedin'] = true;
                    include('camagru.php');
                }
                else
                    echo "forbidden";
            }

        }
        elseif (isset($_POST['signup']))
        {
            $email = $_POST['email'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $cellnumber = $_POST['cellnumber'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 5));
            $user = array($email, $firstname, $lastname, $username, $cellnumber, $password);
            sign_up($user, $conn);
        }
    }

    function sign_up($user, $conn)
    {
        try
        {
            $check = $conn->prepare('SELECT * FROM users WHERE email="' . $user[0] . '"');
            $check->execute();
        }
        catch (Exception $exc)
        {
            echo "Error: ".$exc->getMessage();
        }
        $num = $check->rowCount();
        if ($num > 0)
        {
            echo "User Exists<br>";
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
            send_mail($user[0]);
            die();
        }
    }
    function send_mail($email)
    {
        $subject = "Registration";
        $headers= "From: Awe!";
        $message = "Guess What? You have registered to Camagru!";
        mail($email, $subject, $message, $headers);
    }
?>