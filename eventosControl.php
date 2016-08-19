<?php
session_start();
include 'funciones.php';
include 'config.php';

//verifica si existe sesion
if (isset($_SESSION)) {
    $id = $_SESSION['id'];

// Sentencia sql para traer los eventos desde la base de datos
    if ($_SESSION['privilegio'] == 2) {
        $sql = "SELECT * FROM eventos";
    } else {
        $sql = "SELECT * FROM eventos WHERE user_id=$id";
    }
} else {
    header("Location:index.php");
}

include 'cabecera.php';

// Verificamos si existe un dato
if ($conexion->query($sql)->num_rows) {
    // Ejecutamos nuestra sentencia sql
    $e = $conexion->query($sql);

    ?>
<div class="container">
    <table class="table table-striped table-responsive">
    <caption><h1>Eventos</h1></caption>
        <thead class="thead-inverse">
            <tr>
                <th></th>
                <th>Titulo</th>
                <th>Responsable</th>
                <th>Tipo de evento</th>
                <th>Inicio</th>
                <th>Final</th>
                <th>Descripción</th>
                <th>Acciones</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
       <!---Realizamos un ciclo while para traer los eventos encontrados en la base de datos-->
        <?php while ($row = $e->fetch_array(MYSQLI_ASSOC)) {
        //Verificamos si tienen privilegios de administrador
            if ($_SESSION['privilegio'] == 2) {
                $adLink1 = "<a href='tools/apartadoCambio.php?id=" . $row['id'] . "&apartado=" . $row['apartado'] . "'>";
                $adLink2 = "</a>";
                $adLink3 = "<a href='tools/apartadoCancel.php?id=" . $row['id'] . "&cancelado=" . $row['cancel'] . "'>";
                $adLink4 = "</a>";
            } else {
                $adLink1 = "";
                $adLink2 = "";
                $adLink3 = "";
                $adLink4 = "";
            }
            if ($row['apartado'] == 1) {
                $apartado = "<span style='color:white;' class='glyphicon glyphicon-ok' aria-hidden='true'></span></a>";
                $color_celda = " style='background-color:green;vertical-align:middle;'";
            } else {
                $apartado = "<span class='glyphicon glyphicon-time' aria-hidden='true'></span>";
                $color_celda = " style='vertical-align:middle;'";
            }
            // Cambiamos colores si esta cancelado
            if ($row['cancel'] == 1) {
                $cancelar = "<span style='color:white;' class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></a>";
                $color_cancelar = " style='background-color:orange;vertical-align:middle;'";
            } else {
                $cancelar = "<span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span>";
                $color_cancelar = " style='vertical-align:middle;'";
            }

            echo '<tr>
	  			<td' . $color_celda . '>' . $adLink1 . $apartado . $adLink2 . '</td>
				<td>' . $row["title"] . '</td>
				<td>' . $row["responsable_nombre"] . ' ' . $row["responsable_apellido"] . '</td>
				<td>' . cambiarTipo($row["class"]) . '</td>
				<td>' . $row["inicio_normal"] . '</td>
				<td>' . $row["final_normal"] . '</td>
				<td>' . $row["body"] . '</td>';
            if ($row['cancel'] == 0 and $_SESSION['privilegio'] == 1) {
                echo '<td><a href="tools/modificar.php?id=' . $row["id"] . '"><button type="button" class="btn btn-warning">Modificar</button></a>';

                if ($row["apartado"] == 0 and $_SESSION['privilegio'] == 1) {
                    echo '<a href="tools/eliminar.php?id=' . $row["id"] . '" onclick="return confirm(\'¿Estas seguro que quieres eliminar este evento?\');"><button type="button" class="btn btn-danger">Eliminar</button></a>';
                }
            } elseif ($_SESSION['privilegio'] == 1) {
                echo '<td style="background-color:red;color:white;text-align:center;vertical-align:middle;">Cancelado</td>';
            }
            if ($_SESSION['privilegio'] == 2) {
                echo '<td><a href="tools/modificar.php?id=' . $row["id"] . '"><button type="button" class="btn btn-warning">Modificar</button></a>';
                echo '<a href="tools/eliminar.php?id=' . $row["id"] . '" onclick="return confirm(\'¿Estas seguro que quieres eliminar este evento?\');"><button type="button" class="btn btn-danger">Eliminar</button></a>';
            }

            echo '</td>';

            if ($_SESSION['privilegio'] == 2) {
                echo '<td' . $color_cancelar . '>' . $adLink3 . $cancelar . $adLink4 . '</td>';
            }

            echo '</tr>';
}?>
            </tbody>
        </table>
</div>

<?php
} else {
    echo '<div class="container">
			<h1>No existen datos</h1>
		 </div>';
}

include 'pie.php'

;?>