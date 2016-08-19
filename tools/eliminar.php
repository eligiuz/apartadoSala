<?php
session_start();
include '../funciones.php';
include '../config.php';

if (isset($_SESSION)) {
    $di = evaluar($_GET['id']);
    $id  = isset($di) ? $di : 0;
    $sql = "DELETE FROM eventos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt -> bind_param(i, $id) ;
    if ($stmt->execute()) {
        header("Location:../eventosControl.php");
    } else {
        echo "El evento no se pudo eliminar ";
    }
}
