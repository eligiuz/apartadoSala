<?php
// incluimos el archivo de configuracion
require '../config.php';

 $tbl_name = "usuarios";
 
 $form_pass = $_POST['password'];
 
 $hash = password_hash($form_pass, PASSWORD_DEFAULT);

 $privilegio = $_POST['privi']; 

// Nos conectamos a la base de datos
 $conexion = new mysqli($servidor, $usuario, $pass, $bd);

 if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

 $buscarUsuario = "SELECT * FROM $tbl_name
 WHERE nombre_usuario = '$_POST[username]' ";

 $result = $conexion->query($buscarUsuario);

 $count = mysqli_num_rows($result);

 if ($count == 1) {
 echo "<br />". "Este nombre de usuario ya existe" . "<br />";

 echo "<a href='registro.html'>Por favor escoge otro nombre</a>";
 }
 else{

 $query = "INSERT INTO $tbl_name (nombre, apellido, nombre_usuario, password, privilegio)
           VALUES ('$_POST[first_name]', '$_POST[last_name]', '$_POST[username]', '$hash', '$privilegio')";

 if ($conexion->query($query) === TRUE) {
 
 echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
 echo "<h4>" . "Bienvenido: " . $_POST['username'] . "</h4>" . "\n\n";
 echo "<h5>" . "Hacer Login: " . "<a href='../index.php'>Login</a>" . "</h5>"; 
 }

 else {
 echo "Error al crear el usuario." . $query . "<br>" . $conexion->error; 
   }
 }
 mysqli_close($conexion);

?>