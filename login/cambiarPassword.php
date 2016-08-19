<?php
session_start();
include'../config.php';
include'../funciones.php';

$id_usuario = $_SESSION['id'];

if(isset($_SESSION['id'])){

$sql="SELECT password FROM usuarios WHERE id = $id_usuario";
$result=$conexion->query($sql);
$row=$result->fetch_array();

$hash = $row['password'];

$password_old = $_POST['username'];
$password = $_POST['password'];

if (password_verify($password_old, $hash)){
	$password_nuevo = password_hash($password, PASSWORD_DEFAULT);
	$sql2="UPDATE usuarios SET password='$password_nuevo' WHERE id='$id_usuario'";
	$result2=$conexion->query($sql2);
	 
	$alerta2 = "Contraseña cambiada correctamente";
	$alerta1 = "";
}else{
	$alerta1 = "La Contraseña original no es la correcta";
	$alerta2 = "";
	}
	
header('Location:cambiar_P.php?alerta1='.$alerta1.'&alerta2='.$alerta2);

}else{
	header('Location:../index.php');
	}

?>