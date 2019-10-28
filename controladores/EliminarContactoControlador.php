<?php
require_once('../bd/Conexion.php');
require_once('../configuracion/configuracion.php');

use BD\Conexion;
$datosContacto = [];
$datosContacto['id'] = $_POST['id'];

$errores = [];
if (!$datosContacto['id']) {
    $errores[] = 'El id es un campo obligatorio';
}


if (count($errores) > 0) {
    header('Location: '.ROOT_URL.'/vistas/CrearContactoVista.php?err='.json_encode($errores));
    die();
}
try {
    $conexion = Conexion::obtenerConexion();
    $query = "DELETE FROM contactos WHERE id = :id";

    $statement = $conexion->prepare($query);
    if ($statement->execute($datosContacto))
        header('Location: '.ROOT_URL.'/vistas/ContactoEliminadoVista.php');
    else {
        header('Location: '.ROOT_URL.'/vistas/ErrorVista.php?err=Error la no se pudo realizar la insercion');
    }
} catch(\Exception $ex) {
    header('Location: '.ROOT_URL.'/vistas/ErrorVista.php?err='.$ex->getMessage());
    die();
}