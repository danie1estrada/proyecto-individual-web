<?php
namespace Controllers;
require_once('../database/connection.php');

use DB\Connection;

class MedicalRecordController {

    private $connection = null;

    function __construct() {
        $this->connection = Connection::getConnection();
    }

    public function createMedicalRecord($data) {
        try {
            $query = "INSERT INTO medical_records(full_name, gender, age, date_of_birth, occupation, location, nationality, religion, phone, address, email, emergency_phone, emergency_contact)
            VALUES(:full_name, :gender, :age, :date_of_birth, :occupation, :location, :nationality, :religion, :phone, :address, :email, :emergency_phone, :emergency_contact)";

            $stmt = $this->connection->prepare($query);
            if (!$stmt->execute($data)) {
                return false;
            }
        } catch(\Exception $e) { return false; }

        return true;
    }

    public function getMedicalRecord($id) {
        $row = null;

        try {
            $query = "SELECT * FROM medical_records WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(['id'=>$id]);
            $row = $stmt->fetch();
        } catch(\Exception $e) { };

        return $row;
    }

    public function getMedicalRecords($params) {
        $query = "SELECT * FROM medical_records";

        if ($params) {
            $query .= " WHERE full_name LIKE :params OR email LIKE :params OR phone LIKE :params OR occupation LIKE :params";
        }

        $stmt = $this->connection->prepare($query);
        if ($params) {
            $stmt->execute(['params'=>'%'.$params.'%']);
        } else {
            $stmt->execute();
        }

        return $stmt;
    }

    public function editMedicalRecord($data) {
        try {
            $query = "UPDATE medical_records SET full_name = :full_name, gender = :gender, age = :age, date_of_birth = :date_of_birth, occupation = :occupation, location = :location, nationality = :nationality, religion = :religion, phone = :phone, address = :address, email = :email, emergency_phone = :emergency_phone, emergency_contact = :emergency_contact WHERE id = :id";
            
            $stmt = $this->connection->prepare($query);
            if (!$stmt->execute($data)) {
                return false;
            } 
        } catch(\Exception $e) { return false; }

        return true;
    }

    public function delete($id) {
        $query = "DELETE FROM medical_records WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        if ($stmt->execute(['id'=>$id])) {
            return true;
        }

        return false;
    }
}