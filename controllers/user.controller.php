<?php
namespace Controllers;
require_once('../database/connection.php');

use DB\Connection;

class UserController {

    private $connection = null;

    function __construct() {
        $this->connection = Connection::getConnection();
    }

    public function login($username, $password) {
        $row = null;

        try {
            $query = "SELECT * FROM users WHERE `username` = :username AND `password` = :password";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(['username'=>$username, 'password'=>$password]);
            $row = $stmt->fetch();
        } catch(\Exception $e) { }

        return $row;
    }

    public function getUser($id) {
        $user = null;

        try {
            $query = "SELECT * FROM users WHERE `id` = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(['id'=>$id]);
            $user = $stmt->fetch();
        } catch(\Exception $e) { }

        return $user;
    }
}

