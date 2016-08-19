<?php 
session_start();
date_default_timezone_set("America/Mexico_City");
$hoy = date('d/m/Y H:i');
$base_url="../";

// incluimos el archivo de funciones
include '../funciones.php';

// incluimos el archivo de configuracion
include '../config.php';

// Verificamos si se ha enviado el campo con name from
if (isset($_POST['from'])) 
{

    // Si se ha enviado verificamos que no vengan vacios
    if ($_POST['from']!="" AND $_POST['to']!="") 
    {
        // Revisamos que puede agregar Eventos

        if (isset($_SESSION['id']) && $_SESSION['privilegio'] > 0 ) {
            
            $user_id = $_SESSION['id'];

            //Recibimos el id del evento

            $id_evento = $_POST['id'];

            // Recibimos el fecha de inicio y la fecha final desde el form

            $inicio = _formatear($_POST['from']);
            // y la formateamos con la funcion _formatear

            $final  = _formatear($_POST['to']);

            // Recibimos el fecha de inicio y la fecha final desde el form

            $inicio_normal = $_POST['from'];

            // y la formateamos con la funcion _formatear
            $final_normal  = $_POST['to'];

            // Recibimos los demas datos desde el form
            $titulo = htmlentities(evaluar($_POST['title']));
    		
    		//Recibimos los datos del responsable
    		$responsable_nombre = htmlentities(evaluar($_POST['responsable_nombre']));
			$responsable_apellido = htmlentities(evaluar($_POST['responsable_apellido']));

            // y con la funcion evaluar
            $body   = htmlentities(evaluar($_POST['event']));

            // reemplazamos los caracteres no permitidos
            $clase  = evaluar($_POST['class']);
			
			 // Recibimos datos del status
            $status  = htmlentities(evaluar($_POST['status']));
			
			// Recibimos datos del Ponente
            $ponente_nombre  = htmlentities(evaluar($_POST['ponente_nombre']));
            $ponente_apellido  = htmlentities(evaluar($_POST['ponente_apellido']));
			
			// Recibimos datos del Objetivo
            $objetivo  = htmlentities(evaluar($_POST['objetivo']));
			
			// Recibimos datos de la empresas del ponente
            $empresa  = htmlentities(evaluar($_POST['empresa']));
			
			// Recibimos datos de alumnos asistentes
            $ah  = ($_POST['ah']);
			$am  = ($_POST['am']);
			$dh  = ($_POST['dh']);
			$dm  = ($_POST['dm']);
			$adh  = ($_POST['adh']);
			$adm  = ($_POST['adm']);
			$oh  = ($_POST['oh']);
			$om  = ($_POST['om']);
			
			// Recibimos datos de las empresas participantes
            $inst_part  = htmlentities(evaluar($_POST['inst_part']));
			
			// Recibimos datos del Enlace
            $enlace_nombre  = htmlentities(evaluar($_POST['enlace_nombre']));
            $enlace_apellido  = htmlentities(evaluar($_POST['enlace_apellido']));
			
			// Recibimos datos de las observaciones
            $observacion  = htmlentities(evaluar($_POST['observacion']));
			
			// Recibimos datos de las opiniones
            $opinion  = htmlentities(evaluar($_POST['opinion']));

            // y actualizamos su link
        	$query="UPDATE eventos SET title = '$titulo', responsable_nombre ='$responsable_nombre', responsable_apellido ='$responsable_apellido', body = '$body', class = '$clase', start ='$inicio', end = '$final', inicio_normal = '$inicio_normal', final_normal = '$final_normal', status = '$status', ponente_nombre = '$ponente_nombre', ponente_apellido = '$ponente_apellido', objetivo = '$objetivo', empresa = '$empresa', ah = '$ah', am = '$am', dh = '$dh', dm = '$dm', adh = '$adh', adm = '$adm', oh = '$oh', om = '$om', inst_part = '$inst_part', enlace_nombre = '$enlace_nombre', enlace_apellido = '$enlace_apellido', observacion = '$observacion', opinion = '$opinion' WHERE id = $id_evento";

	        // Ejecutamos nuestra sentencia sql
	        $conexion->query($query);
	        	

	        // redireccionamos a nuestro calendario
	        header("Location:../eventosControl.php"); 

        }


        
    }
}


 ?>