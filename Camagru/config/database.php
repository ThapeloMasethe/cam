<?php
    $DB_SERVER = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "prayeroracion";
    $DB_NAME = "db_camagru";
    $DB_DSN = "mysql:host=$DB_SERVER;dbname=$DB_NAME";

    try
    {
        $conn = new PDO("$DB_DSN", $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $exc)
    {
        echo "Connection failed: ".$exc->getMessage();
    }
?>