<?php
    function generate_token($username){
        $token = sha1(uniqid($username, true));
        
        $query = $conn->prepare('INSERT INTO pending_users(token, username, timestmp)
        VALUES("'. $token . '","' . $username . '", "'. $_SERVER["REQUEST_TIME"] .'")');
        $query->execute();
    }
?>