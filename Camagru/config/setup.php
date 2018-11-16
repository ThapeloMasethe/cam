<?php
    require_once('database.php');

    // CREATE DATABASE.
    try{
        $conn = new PDO("mysql:host=$DB_SERVER", $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("CREATE DATABASE IF NOT EXISTS `db_camagru`");
        $query->execute();
        echo "DATABASE CREATED SUCCESSFULLY.<br>";    
    }catch (PDOException $exc){
        echo "Error:".$exc->getMessage();
    }

    // CREATE TABLES
    try{
        //User Table.
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("CREATE TABLE IF NOT EXISTS `users` (
            `username`          VARCHAR(100) PRIMARY KEY NOT NULL,
            `email`             VARCHAR(50)  NOT NULL,
            `firstname`         VARCHAR(30)  NOT NULL,
            `lastname`          VARCHAR(30)  NOT NULL,
            `password`          VARCHAR(100) NOT NULL,
            `reg_date`          TIMESTAMP,
            `user_token`        VARCHAR(100),
            `verified`          CHAR(1) DEFAULT 'N',
            `email_pref`        VARCHAR(8)
            )");
        $query->execute();
        echo "USERS TABLE CREATED.<br>";
        
        //Images Table.
        $query = $conn->prepare("CREATE TABLE IF NOT EXISTS `images` (
            `imageid`           INT PRIMARY  KEY NOT NULL AUTO_INCREMENT,
            `username`          VARCHAR (45),
            `imagename`         LONGBLOB     NOT NULL,
            `date`              TIMESTAMP
        )");
        $query->execute();
        echo "IMAGES TABLE CREATED.<br>";

         //Likes Table.
         $query = $conn->prepare("CREATE TABLE IF NOT EXISTS `likes` (
            `likeid`            INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `username`          VARCHAR(150),
            `imageid`           INT,
            `imagename`         LONGBLOB,
            `date`              TIMESTAMP
        )");
        $query->execute();
        echo "Likes TABLE CREATED.<br>";

        //Comments Table.
        $query = $conn->prepare("CREATE TABLE IF NOT EXISTS `comments` (
            `commentid`         INT PRIMARY  KEY NOT NULL AUTO_INCREMENT,
            `username`          VARCHAR(100) NOT NULL,
            `imageid`           INT,
            `imagename`         LONGBLOB,
            `comment`           VARCHAR(1500),
            `comment_date`      TIMESTAMP
        )");
        $query->execute();
        echo "COMMENTS TABLE CREATED.<br>";
    }
    catch (PDOException $ex){
        echo "Error: " . $ex->getMessage();
    }
    /* try{
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("CREATE TABLE IF NOT EXISTS `images` (
            `username` VARCHAR(45) NOT NULL,
            `image` VARCHAR(1000),
            `date` TIMESTAMP 
        )");
        $query->execute();
    }
    catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    } */
    $conn = null;
    /* function connect_database()
    {
        try
        {
            $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $exc)
        {
            echo "Connection failed: ".$exc->getMessage();
        }
    } */
?>