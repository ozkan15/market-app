<?php
include $_SERVER['DOCUMENT_ROOT'].'/db/connectDb.php';
function deleteDb()
{
    $servername = "localhost";
    $username = "root";
    $password = "admin";

    try {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
        $sql = "DROP DATABASE IF EXISTS marketapp;";
        $conn->query($sql);
        $conn = null;
        echo 'db deleted successfully';
    } catch (PDOException $e) {
        echo 'db deletion error !!!';
    }
}

deleteDb();
