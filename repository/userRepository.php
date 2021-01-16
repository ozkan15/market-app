<?php
include $_SERVER['DOCUMENT_ROOT'].'/db/connectDb.php';
include $_SERVER['DOCUMENT_ROOT'].'/domain/user.php';
class UserRepository
{
    function add(User $user)
    {
    }

    function getById(int $id)
    {
    }

    function update(User $user)
    {
    }

    function delete(int $id)
    {
    }

    function getByEmail($email): ?User
    {
        $conn = connectToDb();
        if ($conn) {
            $sql = "SELECT id, name, surname, username, email, password FROM user WHERE email = '$email'";
            $statement =  $conn->query($sql);
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if($user == false) return null;
            return new User($user["id"], $user["name"], $user["surname"], $user["username"], $user["email"], $user["password"]);
        } else return null;
    }

    function getByUsername($username): ?User
    {
        $conn = connectToDb();
        if ($conn) {
            $sql = "SELECT id, name, surname, username, email, password FROM user WHERE username = '$username'";
            $statement =  $conn->query($sql);
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if($user == false) return null;
            return new User($user["id"], $user["name"], $user["surname"], $user["username"], $user["email"], $user["password"]);
        } else return null;
    }
}
