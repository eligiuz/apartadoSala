<?php 
session_start();

include '../config.php';
$base_url="../";
include '../cabecera.php';

if(isset($_SESSION['id'])) {

isset($_GET['alerta1']) ? $alerta1=$_GET['alerta1'] : $alerta1="";
isset($_GET['alerta2']) ? $alerta2=$_GET['alerta2'] : $alerta2="";
?>
<script type="text/javascript">

  function checkForm(form)
  {
    if(form.username.value === "") {
      alert("Error: La contraseña anterior no debe estar vacio!");
      form.username.focus();
      return false;
    }
    re = /^\w+$/;
    /*if(!re.test(form.username.value)) {
      alert("Error: El nombre de usuario debe contener unicamente letras o numeros");
      form.username.focus();
      return false;
    }*/

    if(form.password.value !== "" && form.password.value === form.password2.value) {
      if(form.password.value.length < 6) {
        alert("Error: El password debe contener al menos 6 caracteres!");
        form.password.focus();
        return false;
      }
      if(form.password.value == form.username.value) {
        alert("Error: La contraseña nueva debe ser diferente a la anterior!");
        form.password.focus();
        return false;
      }
      /*re = /[0-9]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        form.password.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form.password.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form.password.focus();
        return false;
      }*/
    } else {
      alert("Error: La contraseña y la verificacion son diferentes!");
      form.password.focus();
      return false;
    }

    alert("Has introducido una contraseña valida.");
    return true;
  }

</script>
    
    <div class="container">
    	<div class="row centered-form" style="margin-top: 60px">
    	<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default" style="background: rgba(255,255,255,0.8); box-shadow: rgba(0,0,0,0.3) 20px 20px 20px;">
        		<div class="panel-heading">
                	<h3 class="panel-title">Cambio de contraseña</h3>
			 	</div>
                <div class="panel-body">
                    <form role="form" action="cambiarPassword.php" method="post" onSubmit="return checkForm(this);"> 
                                      
                        <!--Nombre Usuario-->
                        <div class="form-group">
                            <label for="username">Contraseña anterior</label><br>
                            <input type="password" name="username" placeholder="Contraseña anterior" maxlength="20" id="username" required class="form-control">
                    	</div>
                
                        <!--Password-->
                        <div class="row">
                        	<div class="col-xs-4 col-sm-4 col-md-4">
                            	<div class="form-group">
                                    <label for="password">Contraseña nueva:</label><br>
                                    <input type="password" name="password" id="password" maxlength="25"  required placeholder="Contraseña nueva">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                            	<div class="form-group">
                                    <label for="password2">escribir otra vez:</label><br>
                                    <input type="password" name="password2" maxlength="25" id="password2" required placeholder="Confirmar contraseña">
                                    
                                </div>
                            </div>
                        </div>
                		
                        <div class="row">
                        	<div class="col-xs-6 col-sm-6 col-md-6">
                            	<div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Cambiar">
                                </div>
                        	</div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                            	<div class="form-group">
                                    <input type="button" class="btn btn-danger" name="cancelar" value="Salir" onClick="location.href='../index.php'">
                                </div>
                        	</div>
                        </div>
                
                    </form>
                    <div><span style="color:#FF0000"><?php echo $alerta1 ?></span><span style="color:#0F0"><?php echo $alerta2 ?></span></div>
                
                    <hr /><br />
            	</div> <!--Terminal panel-body-->
        	</div> <!--Terminal panel-->
        </div> 
    	</div> <!--Termina row-->
    </div> <!--Termina container-->
    
<?php 
}
include '../pie.php';
?>

