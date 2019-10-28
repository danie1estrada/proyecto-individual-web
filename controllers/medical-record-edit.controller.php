<?php
require_once('./medical-record.controller.php');
require_once('../config/config.php');

use Controllers\MedicalRecordController;

$data = [];
$data['id'] = $_POST['id'];
$data['full_name'] = $_POST['full_name'];
$data['gender'] = $_POST['gender'];
$data['age'] = $_POST['age'];
$data['date_of_birth'] = $_POST['date_of_birth'];
$data['occupation'] =$_POST['occupation'];
$data['location'] = $_POST['location'];
$data['nationality'] = $_POST['nationality'];
$data['religion'] = $_POST['religion'];
$data['phone'] = $_POST['phone'];
$data['address'] = $_POST['address'];
$data['email'] = $_POST['email'];
$data['emergency_phone'] = $_POST['emergency_phone'];
$data['emergency_contact'] = $_POST['emergency_contact'];

$controller = new MedicalRecordController();

if ($controller->editMedicalRecord($data)) {
    header('Location: '.URL.'/views/medical-record-edit.php?id='.$data['id'].'&success=true');
} else {
    header('Location: '.URL.'/views/medical-record-edit.php?id='.$data['id'].'success=false');
}