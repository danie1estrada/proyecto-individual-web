<?php
namespace DB;
use PDO;

class Connection {
    public static function getConnection() {
        return new PDO('mysql:host=localhost;dbname=medical_records', 'root', getenv('DB_PASSWORD'));
    }
}