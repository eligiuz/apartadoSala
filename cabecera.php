<!DOCTYPE html>
<html lang="es">
<head>
        <meta name="author" content="Eligio Cachón Menéndez">
        <meta name="description" content="Página web para realizar la reservación en la sala de videoconferencias">
        <meta name="organization" content="Universidad Tecnologica de Tabasco">
        <meta name="encoding" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reservación Sala de Videoconferencias</title>

        <link rel="stylesheet" type="text/css" href="<?=$base_url?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=$base_url?>css/calendar.css">

       	<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/font-awesome.min.css">
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

<nav class="navbar navbar-default" role="navigation" style="background-color:#00B092">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://www.uttab.edu.mx"><img src="<?=$base_url?>imagenes/ut.png" style="height:auto; max-width:100%;" alt="ut" width="70px"></a>
      <a class="navbar-brand" href="<?=$base_url?>index.php" style="color:#0073AB;" onMouseOver="this.style.color = '#fff'" onMouseOut="this.style.color = '#0073AB'"><strong>Reservado de Sala</strong></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <!-- <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul> -->

      <ul class="nav navbar-nav navbar-right">

		<?php if (isset($_SESSION['username']) && $_SESSION['privilegio'] > 0) {?>

      <li><p class="navbar-text" style="color:#0073AB;">Nombre de usuario: </p></li>
        <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#0073AB;" onMouseOver="this.style.color = '#fff'" onMouseOut="this.style.color = '#0073AB'"><b><?php echo $_SESSION['username']; ?></b><span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">

              <li><a href="<?=$base_url?>eventosControl.php">Control de eventos</a></li>
              <li class="divider"></li>
              <li><a href="<?=$base_url?>login/cambiar_P.php">Cambiar contraseña</a></li>
              <li class="divider"></li>
	          <li><a href="<?=$base_url?>login/logout.php">Cerrar sesión</a></li>
	          </ul>

		<?php } else { ?>

          <li><p class="navbar-text" style="color:#0073AB">Tienes una Cuenta?</p></li>
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#0073AB" onMouseOver="this.style.color = '#fff'" onMouseOut="this.style.color = '#0073AB'"><b>Iniciar sesión</b> <span class="caret"></span></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">

								 <form class="form" role="form" method="post" action="login/checklogin.php" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											 <label class="sr-only" for="username">Nombre de Usuario</label>
											 <input name="username" type="text" class="form-control" id="username" placeholder="Nombre de usuario" required>
										</div>
										<div class="form-group">
											 <label class="sr-only" for="password">Contraseña</label>
											 <input name="password" type="password" class="form-control" id="password" placeholder="Contraseña" required>
										</div>
										<div class="form-group">
											 <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
										</div>

								 </form>
							</div>
              <div class="bottom text-center">

							</div>
					 </div>
				</li>
			</ul>
			<?php } ?>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>