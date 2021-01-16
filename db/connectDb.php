<?php
function connectToDb(): ?PDO
{
    $servername = "localhost";
    $username = "root";
    $password = "admin";
    $dbname = "marketapp";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch (PDOException $e) {
        $conn = null;
        return null;
    }

    return $conn;
}
