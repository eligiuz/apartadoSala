<?php 
session_start();

$base_url="../";
include '../cabecera.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
       <link href="../css/font-awesome.min.css" rel="stylesheet">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>

</head>
<body style="background: white;">
	<div class="container center-block">
		<h1>Login de Usuarios</h1>
		<hr />

		<form action="checklogin.php" method="post" >

			<label>Nombre Usuario:</label><br>
			<input name="username" type="text" id="username" required>
			<br><br>

			<label>Password:</label><br>
			<input name="password" type="password" id="password" required>
			<br><br>

			<input type="submit" name="Submit" value="LOGIN">

		</form>
		<hr />
	</div>
    
<?php 

include '../pie.php';
?>
