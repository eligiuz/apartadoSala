<?php
session_start();
// incluimos el archivo de funciones
include '../funciones.php';

// incluimos el archivo de configuracion
include '../config.php';

$di = evaluar($_GET['id']);
$apart = evaluar($_GET['apartado']);
if (!isset($_SESSION)) { //verificamos que exista una sesión
    header("Location:../index.php");
} else {
    $apart==1 ? $apart=0 : $apart=1;

    $sql="UPDATE eventos SET apartado = '$apart' WHERE id = $di";
    $conexion->query($sql);
    header("Location:../eventosControl.php");
}
