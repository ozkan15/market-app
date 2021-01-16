<?php
class User
{
    public $id;
    public $name;
    public $surname;
    public $username;
    public $email;
    public $password;

    function __construct(
        $id,
        $name,
        $surname,
        $username,
        $email,
        $password
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}
