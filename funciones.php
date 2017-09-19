<?php

/**
**
**POR: ELIGIO CACHÓN MENÉNDEZ
**/

// Evaluar los datos que ingresa el usuario y eliminamos caracteres no deseados.
function evaluar($valor) 
{
	$nopermitido = array("'",'\\','<','>',"\"");
	$valor = str_replace($nopermitido, "", $valor);
	return $valor;
}

// Formatear una fecha a microtime para añadir al evento, tipo 1401517498985.
//https://currentmillis.com/
function _formatear($fecha)
{
	return strtotime(substr($fecha, 6, 4)."-".substr($fecha, 3, 2)."-".substr($fecha, 0, 2)." " .substr($fecha, 10, 6)) * 1000;
}

function cambiarTipo($tipo)
{
	switch ($tipo) {
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
    return $clase_evento;
}



 ?>
