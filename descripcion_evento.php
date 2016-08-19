<?php
session_start();
/**
**
**  BY iCODEART
**Modificado Por Eligio Cachón Menéndez
**********************************************************************
**                      REDES SOCIALES                            ****
**********************************************************************
**                                                                ****
** FACEBOOK: https://www.facebook.com/icodeart                    ****
** TWIITER: https://twitter.com/icodeart                          ****
** YOUTUBE: https://www.youtube.com/c/icodeartdeveloper           ****
** GITHUB: https://github.com/icodeart                            ****
** TELEGRAM: https://telegram.me/icodeart                         ****
** EMAIL: info@icodeart.com                                       ****
**                                                                ****
**********************************************************************
**********************************************************************
**/
    
    //incluimos nuestro archivo config
    include 'config.php'; 

    // Incluimos nuestro archivo de funciones
    include 'funciones.php';

    // Obtenemos el id del evento
    $id  = evaluar($_GET['id']);

    // y lo buscamos en la base de dato
    $bd  = $conexion->query("SELECT * FROM eventos WHERE id=$id");

    // Obtenemos los datos
    $row = $bd->fetch_assoc();

    // titulo 
    $titulo=$row['title'];
	
	// responsable
	$responsable=$row['responsable_nombre'].' '.$row['responsable_apellido'];

    // cuerpo
    $evento=$row['body'];

    // Fecha inicio
    $inicio=$row['inicio_normal'];

    // Fecha Termino
    $final=$row['final_normal'];
    
    // Clase de evento
    switch ($row['class']) {
        case "event-videoconferencia":
            $clase_evento = "Videconferencia";
            break;
        case "event-conferencia":
            $clase_evento = "Conferencia";
            break;
        case "event-convenio":
            $clase_evento = "Convenio";
            break;
        case "event-reunion":
            $clase_evento = "Reunión";
            break;
        case "event-pelicula":
            $clase_evento = "Pelicula";
            break;
        case "event-capacitacion":
            $clase_evento = "Capacitación";
            break;
        case "event-presentacionLibro":
            $clase_evento = "Presentación de Libro";
            break;
        case "event-mesaLectura":
            $clase_evento = "Mesa de Lectura";
            break;
        case "event-otro":
            $clase_evento = "Otro";
            break;
        
    }
   
// Eliminar evento
/*if (isset($_POST['eliminar_evento'])) 
{
    $id  = evaluar($_GET['id']);
    $sql = "DELETE FROM eventos WHERE id = $id";
    if ($conexion->query($sql)) 
    {
        echo "Evento eliminado";
		
    }
    else
    {
        echo "El evento no se pudo eliminar";
		
    }
}*/
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$titulo?></title>
        
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=$base_url?>css/calendar.css">
       
       <link href="<?=$base_url?>css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>css/cabecera.css"> <!-- se incluye el estilo de la cabecera -->
        <script type="text/javascript" src="<?=$base_url?>js/es-MX.js"></script>
        <script src="<?=$base_url?>js/jquery.min.js"></script>
        <script src="<?=$base_url?>js/moment.js"></script>
        <script src="<?=$base_url?>js/bootstrap.min.js"></script>
        <script src="<?=$base_url?>js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="<?=$base_url?>css/bootstrap-datetimepicker.min.css" />
       <script src="<?=$base_url?>js/bootstrap-datetimepicker.es.js"></script>

</head>
<body style="background: white;">
	 <h3><?=$titulo?></h3>
	 <hr>
     <p><b>Responsable del evento: </b><?=$responsable?></p>
     <p><b>Tipo de evento: </b><?=$clase_evento?></p>
     <b>Fecha inicio:</b> <?=$inicio?>
     <b>Fecha termino:</b> <?=$final?><br><br>
     <b>Observación y/o comentario</b>
 	 <p><?=$evento?></p>
<!--<a href="tools/modificar.php?id='<?php /*?><?php echo $id?><?php */?>'"><button type="submit" class="btn btn-danger" name="eliminar_evento">Modificar</button></a>-->
<!--</body>
<form action="" method="post">
    <button type="submit" class="btn btn-danger" name="eliminar_evento">Eliminar</button>
</form>-->
</html>
