<?php 

	session_start();
	include '../funciones.php';
	include '../config.php';

	// if (isset($_SESSION)) 
	// {
// 	    $id  = evaluar($_GET['id']);
	    
// 	    $sql = "SELECT * FROM eventos WHERE id = $id";
// 	    echo $sql;
// 	    // Ejecutamos nuestra sentencia sql
//     	if (!$resultado = $conexion->query($sql)) {
//     // ¡Oh, no! La consulta falló. 
//     echo "Lo sentimos, este sitio web está experimentando problemas.";

//     // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
//     // cómo obtener información del error
//     echo "Error: La ejecución de la consulta falló debido a: \n";
//     echo "Query: " . $sql . "\n";
//     echo "Errno: " . $conexion->errno . "\n";
//     echo "Error: " . $conexion->error . "\n";
//     exit;
// }
	    //$row=$e->fetch_array(MYSQLI_ASSOC);
	    //$row = $e->fetch_assoc();
	// }
// 	$hoy = getdate();
// print_r($hoy);
	//echo date('l jS \of F Y h:i:s A');
	//date_default_timezone_set('UTC');
	// Definimos nuestra zona horaria
date_default_timezone_set("America/Mexico_City");
/*	echo date('d/m/Y H:i');
	echo $hoy = date("Y-m-d H:i:s");*/
	
	$fecha = new DateTime('2016/09/22 15:24');
	$fecha->add(new DateInterval(PT1H));
	echo "Fecha: ".$fecha->format('d/m/Y H:i');

 ?>