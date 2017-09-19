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
if (isset($_POST['from'])) {
    // Si se ha enviado verificamos que no vengan vacios
    if ($_POST['from']!="" and $_POST['to']!="") {
        // Revisamos que puede agregar Eventos

        if (isset($_SESSION['id']) && $_SESSION['privilegio'] > 0) {
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
            $titulo = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);

            //Recibimos los datos del responsable
            $responsable_nombre = filter_input(INPUT_POST, 'responsable_nombre', FILTER_SANITIZE_STRING);
            $responsable_apellido = filter_input(INPUT_POST, 'responsable_apellido', FILTER_SANITIZE_STRING);


            // y con la funcion evaluar
            $body   = filter_input(INPUT_POST, 'event', FILTER_SANITIZE_STRING);

            // reemplazamos los caracteres no permitidos
            $clase  = evaluar($_POST['class']);

             // Recibimos datos del status
            $status  = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

            // Recibimos datos del Ponente
            $ponente_nombre  = filter_input(INPUT_POST, 'ponente_nombre', FILTER_SANITIZE_STRING);
            $ponente_apellido  = filter_input(INPUT_POST, 'ponente_apellido', FILTER_SANITIZE_STRING);

            // Recibimos datos del Objetivo
            $objetivo  = filter_input(INPUT_POST, 'objetivo', FILTER_SANITIZE_STRING);

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
            $inst_part  = filter_input(INPUT_POST, 'inst_part', FILTER_SANITIZE_STRING);

            // Recibimos datos del Enlace
            $enlace_nombre  = filter_input(INPUT_POST, 'enlace_nombre', FILTER_SANITIZE_STRING);
            $enlace_apellido  = filter_input(INPUT_POST, 'enlace_apellido', FILTER_SANITIZE_STRING);

            // Recibimos datos de las observaciones
            $observacion  = filter_input(INPUT_POST, 'observacion', FILTER_SANITIZE_STRING);

            // Recibimos datos de las opiniones
            $opinion  = filter_input(INPUT_POST, 'opinion', FILTER_SANITIZE_STRING);

            // y actualizamos su link
            $query="UPDATE eventos SET title = '$titulo', responsable_nombre ='$responsable_nombre', responsable_apellido ='$responsable_apellido', body = '$body', class = '$clase', start ='$inicio', end = '$final', inicio_normal = '$inicio_normal', final_normal = '$final_normal', status = '$status', ponente_nombre = '$ponente_nombre', ponente_apellido = '$ponente_apellido', objetivo = '$objetivo', empresa = '$empresa', ah = '$ah', am = '$am', dh = '$dh', dm = '$dm', adh = '$adh', adm = '$adm', oh = '$oh', om = '$om', inst_part = '$inst_part', enlace_nombre = '$enlace_nombre', enlace_apellido = '$enlace_apellido', observacion = '$observacion', opinion = '$opinion' WHERE id = $id_evento";

            // Ejecutamos nuestra sentencia sql
            $conexion->set_charset('utf8');
            $conexion->query($query);

            // redireccionamos a nuestro calendario
            header("Location:../eventosControl.php");
        }
    }
}
