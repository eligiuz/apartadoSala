<?php 
	session_start();
	include 'funciones.php';
	include 'config.php';
	

	if (isset($_SESSION)) { //verifica si existe sesion
		$id = $_SESSION['id'];
	

		// Sentencia sql para traer los eventos desde la base de datos
		if ($_SESSION['privilegio'] == 2) {
			$sql="SELECT * FROM eventos";
		} else {
			$sql="SELECT * FROM eventos WHERE user_id=$id";
		}

	}else {header("Location:index.php"); }

include 'cabecera.php';

// Verificamos si existe un dato
if ($conexion->query($sql)->num_rows)
{ 


    // Ejecutamos nuestra sentencia sql
    $e = $conexion->query($sql); 



	 
?>
<div class="container">
	<table class="table table-striped table-responsive">
		<caption><h1>Eventos</h1></caption>
		<thead class="thead-inverse">
			<tr>
				<th>Titulo</th>
				<th>Responsable</th>
				<th>Tipo de evento</th>
				<th>Inicio</th>
				<th>Final</th>
				<th>Descripción</th>
			</tr>
		</thead>
		<tbody>
		<?php while($row=$e->fetch_array(MYSQLI_ASSOC)) // realizamos un ciclo while para traer los eventos encontrados en la base de dato
    {
      echo '<tr>
				<td>'.$row["title"].'</td><td>'.$row["responsable_nombre"].' '.$row["responsable_apellido"].'</td><td>'.cambiarTipo($row["class"]).'</td><td>'.$row["inicio_normal"].'</td><td>'.$row["final_normal"].'</td><td>'.$row["body"].'</td><td><a href="tools/modificar.php?id='.$row["id"].'"><button type="button" class="btn btn-warning">Modificar</button></a><a href="tools/eliminar.php?id='.$row["id"].'" onclick="return confirm(\'¿Estas seguro que quieres eliminar este evento?\');"><button type="button" class="btn btn-danger">Eliminar</button></a></td>
			</tr>';
    } ?>
			
		</tbody>
	</table>
</div>

<?php 

}else{

	echo '<div class="container">
			<h1>No existen datos</h1>
		 </div>';
}

include 'pie.php'

 ?>