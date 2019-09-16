<?php

class UsersDbHandler
{
    private $instance;

    public function __construct($connection)
    {
        $this->instance = $connection;
    }

    public function addUser($email, $password)
    {
        $query = $this->instance->prepare('INSERT INTO users_table (email, password) values (:email,:password)');
        $hashedPassword = hash('sha256', $password);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $hashedPassword);
        if ($query->execute()) {
            return json_encode(
                array(
                    "status" => true,
                    "password" => $hashedPassword
                )
            );
        }
        return json_encode(
            array(
                "status" => false,
                "message" => "Error occurred"
            )
        );

    }
}