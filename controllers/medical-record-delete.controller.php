<?php
require_once('./medical-record.controller.php');
require_once('../config/config.php');

use Controllers\MedicalRecordController;

$controller = new MedicalRecordController();
$id = $_GET['id'];

if ($controller->delete($id)){
    header('Location: '.URL.'/views/index.php?success=true&message=Registro eliminado satisfactoriamente');
} else {
    header('Location: '.URL.'/views/index.php?success=false&message=No se pudo eliminar el registro');
}