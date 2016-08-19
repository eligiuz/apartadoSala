<?php
session_start();
header('content-type: text/html; charset=utf-8');
date_default_timezone_set("America/Mexico_City");
$hoy = date('d/m/Y H:i');
$base_url="../";

// incluimos el archivo de funciones
include '../funciones.php';

// incluimos el archivo de configuracion
include '../config.php';

/*$fechaCompara="13/09/2016 07:00";
$fechaCompara2="15/09/2016 20:00";


$fechaCompara = _formatear($fechaCompara);
$fechaCompara2 = _formatear($fechaCompara2);
$sql1 = "SELECT * FROM eventos WHERE ($fechaCompara BETWEEN start AND end) OR ($fechaCompara2 BETWEEN start AND end) OR (start BETWEEN $fechaCompara AND $fechaCompara2) OR (end BETWEEN $fechaCompara AND $fechaCompara2)";

$result = $conexion->query($sql1);

if ($result->num_rows > 0){
	echo "<br>Existe un problema";
	$messages="Las fechas del ".date('d/m/Y H:i',$fechaCompara/1000)." al ".date('d/m/Y H:i',$fechaCompara2/1000)." están ocupadas por otro evento";
	echo '<script type="text/javascript">alert("'.$messages.'");</script>';
}*/


$fecha_i ="13/09/2016 07:00";
$fecha_f ="15/09/2016 20:00";
// Se extraen las fechas originales para que queden en el formato yyyy-mm-dd
$fecha_inicial = (substr($fecha_i, 6, 4)."-".substr($fecha_i, 3, 2)."-".substr($fecha_i, 0, 2));
$fecha_final = (substr($fecha_f, 6, 4)."-".substr($fecha_f, 3, 2)."-".substr($fecha_f, 0, 2));
// Se compara si las fechas son iguales
if ($fecha_inicial != $fecha_final){
	// Al ser diferentes las fechas
	// se extraen las horas
	$hora_inicial = (substr($fecha_i,10,6));
	$hora_final = (substr($fecha_f,10,6));
	// Se convierten las fechas a objetos date
	$datetime1 = date_create($fecha_inicial);
	$datetime2 = date_create($fecha_final);
	//se encuentra la diferencia de dias entre las fechas $datetime2 - $datetime1
	$interval = date_diff($datetime1, $datetime2);
	$contador = (int)$interval->format('%R%a');
	
	// Este es el ciclo
	$cnt=0;
	
	while($cnt <= $contador){
	
		$aumento="+ ".$cnt." day";//se aumentan los dias
		$mas_uno = strtotime ($aumento, strtotime($fecha_inicial));// se le aumenta a la fechas los dias
		$un_dia = date('d/m/Y',$mas_uno);
		$final_1 = $un_dia.$hora_inicial;//se le agrega la hora a la fecha inicial
		$final_2 = $un_dia.$hora_final; //se le agrega la hora  a la fecha final
		
	//AQUI VA LA VERIFICACION DE FECHAS EN LA AGENDA DE EVENTOS PARA SABER SI ESTAN OCUPADAS LAS FECHAS Y HORAS
	$fechaCompara = _formatear($final_1);
	$fechaCompara2 = _formatear($final_2);
	//Se realiza la comparacion en la base de datos de todos los eventos
	$sql1 = "SELECT * FROM eventos WHERE ($fechaCompara BETWEEN start AND end) OR ($fechaCompara2 BETWEEN start AND end) OR (start BETWEEN $fechaCompara AND $fechaCompara2) OR (end BETWEEN $fechaCompara AND $fechaCompara2)";
	
	$result = $conexion->query($sql1);
	// Revisamos si existe algún evento que coincida
	if ($result->num_rows > 0){
		// Si existe coincidencia se procede con un aviso y esta fecha no podra ser agregada a la base de datos
		
		$messages="Las fechas del ".$final_1." al ".$final_2." están ocupadas por otro evento; recuerda que entre eventos debe existir al menos una hora de diferencia";
		echo '<script type="text/javascript">alert("'.$messages.'");</script>';
	}
		
		$cnt++; //se aumenta el contador en 1 
	
	} // Final de la revision de fechas en la AGENDA
		
	} // final del while