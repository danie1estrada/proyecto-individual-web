<?php
require_once('../bd/Conexion.php');
require_once('../configuracion/configuracion.php');

use BD\Conexion;
$datosContacto = [];

$datosContacto['nombre'] = $_POST['nombre'];
$datosContacto['apellidos'] = $_POST['apellidos'];
$datosContacto['email'] = $_POST['email'];
$datosContacto['telefono_fijo'] = $_POST['telefono_fijo'];
$datosContacto['telefono_celular'] = $_POST['telefono_celular'];

$errores = [];
if (!$datosContacto['nombre']) {
    $errores[] = 'El nombre es un campo obligatorio';
}
if (!$datosContacto['apellidos']) {
    $errores[] = 'Los apellidos son obligatorios';
}

if (!$datosContacto['email']) {
    $errores[] = 'El email obligatorio';
}

if (!$datosContacto['telefono_fijo']) {
    $errores[] = 'El telefono fijo es obligatorio';
}

if (!$datosContacto['telefono_celular']) {
    $errores[] = 'El telefono celular es obligatorio';
}

if (count($errores) > 0) {
    header('Location: '.ROOT_URL.'/vistas/CrearContactoVista.php?err='.json_encode($errores));
    die();
}
try {
    $conexion = Conexion::obtenerConexion();
    $query = "INSERT INTO contactos (nombre, apellidos, email, telefono_fijo, telefono_celular) VALUES(:nombre, :apellidos, :email, :telefono_fijo, :telefono_celular)";

    $statement = $conexion->prepare($query);
    if ($statement->execute($datosContacto))
        header('Location: '.ROOT_URL.'/vistas/ListarContactosVista.php');
    else {
        header('Location: '.ROOT_URL.'/vistas/ErrorVista.php?err=Error la no se pudo realizar la insercion');
    }
} catch(\Exception $ex) {
    header('Location: '.ROOT_URL.'/vistas/ErrorVista.php?err='.$ex->getMessage());
    die();
}