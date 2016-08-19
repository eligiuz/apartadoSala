<?php
session_start();
// incluimos el archivo de funciones
include '../funciones.php';

// incluimos el archivo de configuracion
include '../config.php';

$di = evaluar($_GET['id']);
$cancel = evaluar($_GET['cancelado']);
if(!isset($_SESSION)){ //verificamos que exista una sesión
	header("Location:../index.php");
}else{
	$cancel==1 ? $cancel=0 : $cancel=1; 
	
	$sql="UPDATE eventos SET cancel = '$cancel' WHERE id = $di";
	$conexion->query($sql);
	header("Location:../eventosControl.php");	
}


?>