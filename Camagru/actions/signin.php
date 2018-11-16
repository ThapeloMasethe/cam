<?php
    session_start();
    include_once('connection.php');
        if (isset($_POST['login'])){
            $email                = $_POST['email'];
            $password             = $_POST['password'];
            $username             = $_POST['username'];
            $_SESSION['verified'] = true;
            try{
                $check_verified = $conn->prepare("SELECT `verified` FROM `users` WHERE `username` = '$username'");
                $check_verified->execute();
            }catch(PDOException $e){
                echo 'Error: '.$e->getMessgae();
            }
            $row = $check_verified->fetch(PDO::FETCH_ASSOC);
            if ($row['verified'] == 'Y'){
                try{
                    $user = $conn->prepare("SELECT * FROM `users` WHERE `username` = '$username'");
                    $user->execute();
                }catch (PDOException $exc){
                    echo "Error: ".$exc->getMessage();
                }
            }
            else{
                $_SESSION['verified'] = false;
                header('Location: index.php');
            }
    
            $row = $user->fetch(PDO::FETCH_ASSOC);
            $num = $user->rowCount();
            $hash = $row['password'];
            if (
                $num > 0){
                if (password_verify($password, $hash)){  
                    $_SESSION['email']      = $row['email'];
                    $_SESSION['token']      = $row['token'];
                    $_SESSION['loggedin']   = true;
                    $_SESSION['lastname']   = $row['lastname'];
                    $_SESSION['username']   = $row['username'];
                    $_SESSION['firstname']  = $row['firstname']; 
                    $_SESSION['cellnumber'] = $row['cellnumber'];
                    include('snap.php');
                }
                else{
                    $_SESSION['verified'] = false;
                    header('Location: index.php');
                }
    
            }
        }
?>