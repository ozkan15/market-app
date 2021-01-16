<?php
include './db/connectDb.php';
function ensureDbCreated()
{
    $conn = connectToDb();

    if ($conn == null) {
        $servername = "localhost";
        $username = "root";
        $password = "admin";

        try {
            $conn = new PDO("mysql:host=$servername", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = "CREATE DATABASE marketapp;
                USE marketapp;
                CREATE TABLE Product(
                    id INT(6) UNSIGNED AUTO_INCREMENT,
                    name TEXT NOT NULL,
                    image TEXT NOT NULL,
                    PRIMARY KEY (id)
                );
                CREATE TABLE ProductSample(
                    id INT(6) UNSIGNED AUTO_INCREMENT,
                    name TEXT NOT NULL,
                    price DECIMAL NOT NULL,
                    market TEXT NOT NULL,
                    image TEXT NOT NULL,
                    link TEXT NOT NULL,
                    productId INT(6) UNSIGNED,
                    PRIMARY KEY (id),
                    FOREIGN KEY (productId) REFERENCES Product(id)
                );
                CREATE TABLE User(
                    id INT(6) UNSIGNED AUTO_INCREMENT,
                    name TEXT NOT NULL,
                    surname TEXT NOT NULL,
                    username TEXT NOT NULL,
                    email TEXT NOT NULL,
                    password TEXT NOT NULL,
                    PRIMARY KEY (id)
                );
                INSERT INTO User(name, surname, username, email, password)
                VALUES ('admin', 'admin', 'admin', 'test@test.com.tr', 'admin') 
            ";
            $conn->query($sql);
            $conn = null;
            echo 'db created successfully';
        } catch (PDOException $e) {
            echo 'db creation error !!!';
        }
    } else {
        $conn = null;
        echo 'db already exist';
    }
}

ensureDbCreated();
