<?php

/*session_start();
$_SESSION = array('user' => array('id' => 1,
'nombre' => "Eligio",
'apellido' => "Cachón Menéndez",
'edad' => 52, ) ,
'datos' => array(
'clase1' =>"Matematicas",
'clase2' => "Eletronica"), );*/

//$arreglo = array();

$cont=0;
while($cont < 10){
	$arreglo[$cont] = $cont;
	$cont++;
}
//$arreglo = 0;
foreach ($arreglo as $valor){
	echo $valor;
}
