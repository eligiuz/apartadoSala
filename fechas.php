<?php 

// $fecha_inicial = new DateTime($_POST['from']);
// $fecha_final = new DateTime($_POST['to']);
$fecha_i = $_POST['from'];
$fecha_f = $_POST['to'];
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
			
			$messages[$cnt]="Las fechas del ".$final_1." al ".$final_2." están ocupadas por otro evento.";
			
		}else{
			
			// Si no existe conincidencia se procede normalmente
			// Aqui va la información
		
			$user_id = $_SESSION['id'];

			// Recibimos el fecha de inicio y la fecha final desde el form

			$inicio = _formatear($final_1);
			// y la formateamos con la funcion _formatear

			$final  = _formatear($final_2);

			// Recibimos el fecha de inicio y la fecha final desde el form

			$inicio_normal = $final_1;

			// y la formateamos con la funcion _formatear
			$final_normal  = $final_2;

			// Recibimos los demas datos desde el form
			$titulo = filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
			
			//Recibimos los datos del responsable
			$responsable_nombre = filter_input(INPUT_POST,'responsable_nombre',FILTER_SANITIZE_STRING);
			$responsable_apellido =  filter_input(INPUT_POST,'responsable_apellido',FILTER_SANITIZE_STRING);

			// y con la funcion evaluar
			$body   = filter_input(INPUT_POST,'event',FILTER_SANITIZE_STRING);

			// reemplazamos los caracteres no permitidos
			$clase  = evaluar($_POST['class']);

			// insertamos el evento
			$query="INSERT INTO eventos VALUES(null, '$user_id', '$titulo', '$responsable_nombre' , '$responsable_apellido' , '$body','','$clase','$inicio','$final','$inicio_normal','$final_normal','','','','','',0,0,0,0,0,0,0,0,'','','','','',0,'',0,'')";

			// Ejecutamos nuestra sentencia sql
			$conexion->query($query); 
			
			// Obtenemos el ultimo id insertado
			$im=$conexion->query("SELECT MAX(id) AS id FROM eventos");
			$row = $im->fetch_row();  
			$id = trim($row[0]);

			// para generar el link del evento
			$link = "$base_url"."descripcion_evento.php?id=$id";
			
			//Guardamos el id del primer evento de la serie
			if($cnt == 0){
				$id_unico =$id;
			}

			// y actualizamos su link y el vento seriado
			$query="UPDATE eventos SET url = '$link', serie = '$id_unico' WHERE id = $id";

			// Ejecutamos nuestra sentencia sql
			$conexion->query($query);
			
			$cnt++; //se aumenta el contador en 1 
		
		} // Final de la revision de fechas en la AGENDA
		
	} // final del while
	
} else {// Si no son varios días se procede a trabajar con un solo evento

	//AQUI VA LA VERIFICACION DE FECHAS EN LA AGENDA DE EVENTOS PARA SABER SI ESTA OCUPADA LA FECHA Y HORA
	$fechaCompara = _formatear($_POST['from']);
	$fechaCompara2 = _formatear($_POST['to']);
	//Se realiza la comparacion en la base de datos de todos los eventos
	$sql1 = "SELECT * FROM eventos WHERE ($fechaCompara BETWEEN start AND end) OR ($fechaCompara2 BETWEEN start AND end) OR (start BETWEEN $fechaCompara AND $fechaCompara2) OR (end BETWEEN $fechaCompara AND $fechaCompara2)";
	
	$result = $conexion->query($sql1);
	//revisamos si existe algún evento que coincida
	if ($result->num_rows > 0){
		// Si existe coincidencia se procede con un aviso y esta fecha no podra ser agregada a la base de datos
		$messages[0]="Las fechas del ".$_POST['from']." al ".$_POST['to']." están ocupadas por otro evento.";
	}else{
		
		// Si no existe conincidencia se procede normalmente
		// Aqui va la información

		 $user_id = $_SESSION['id'];
	
		  // Recibimos el fecha de inicio y la fecha final desde el form
	
		  $inicio = _formatear($_POST['from']);
		  // y la formateamos con la funcion _formatear
	
		  $final  = _formatear($_POST['to']);
	
		  // Recibimos el fecha de inicio y la fecha final desde el form
	
		  $inicio_normal = $_POST['from'];
	
		  // y la formateamos con la funcion _formatear
		  $final_normal  = $_POST['to'];
	
		  // Recibimos los demas datos desde el form
		  $titulo = filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
		  
		  //Recibimos los datos del responsable
		  $responsable_nombre = filter_input(INPUT_POST,'responsable_nombre',FILTER_SANITIZE_STRING);
		  $responsable_apellido = filter_input(INPUT_POST,'responsable_apellido',FILTER_SANITIZE_STRING);
	
		  // y con la funcion evaluar
		  $body   = filter_input(INPUT_POST,'event',FILTER_SANITIZE_STRING);
	
		  // reemplazamos los caracteres no permitidos
		  $clase  = evaluar($_POST['class']);
	
		  // insertamos el evento
		  $query="INSERT INTO eventos VALUES(null, '$user_id', '$titulo', '$responsable_nombre' , '$responsable_apellido' , '$body','','$clase','$inicio','$final','$inicio_normal','$final_normal','','','','','',0,0,0,0,0,0,0,0,'','','','','',0,'',0,0)";
	
		  // Ejecutamos nuestra sentencia sql
		  $conexion->query($query); 
	
	
		  // Obtenemos el ultimo id insertado
		  $im=$conexion->query("SELECT MAX(id) AS id FROM eventos");
		  $row = $im->fetch_row();  
		  $id = trim($row[0]);
	
		  // para generar el link del evento
		  $link = "$base_url"."descripcion_evento.php?id=$id";
	
		  // y actualizamos su link
		  $query="UPDATE eventos SET url = '$link' WHERE id = $id";
	
		  // Ejecutamos nuestra sentencia sql
		  $conexion->query($query);
	}//Final de revision de fecha en la AGENDA de EVENTOS
	
}// final del if para saber si estan seriadas las fechas

 ?>