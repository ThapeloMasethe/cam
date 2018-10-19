<?php
    include('database.php');
    //Create database.
    try
    {
        $conn = new PDO("mysql:host=$DB_SERVER", $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS db_camagru";
        $conn->exec($sql);
        echo "Database Created Successfully.<br>";    
    }
    catch (PDOException $exc)
    {
        echo "Error:".$exc->getMessage();
    }
    //Create table for users.
    try
    {
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $st = $conn->prepare("CREATE TABLE IF NOT EXISTS Users (
            /* id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, */
            email VARCHAR(50),
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            username VARCHAR(100) NOT NULL,
            cellnumber VARCHAR(12) NOT NULL,
            password VARCHAR(100) NOT NULL,
            reg_date TIMESTAMP
            )");
        $st->execute();
        echo "Users Table Created.<br>";
    }
    catch (PDOException $ex)
    {
        echo "Error: ".$ex->getMessage();
    }
    $conn = null;
?>