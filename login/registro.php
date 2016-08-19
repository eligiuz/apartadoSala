<?php 
session_start();

$base_url="../";
include '../cabecera.php';

if(isset($_SESSION['id']) && ($_SESSION['privilegio'] == 2)) {

?>
<script type="text/javascript">

  function checkForm(form)
  {
    if(form.username.value == "") {
      alert("Error: El nombre de usuario no debe estar vacio!");
      form.username.focus();
      return false;
    }
    re = /^\w+$/;
    if(!re.test(form.username.value)) {
      alert("Error: El nombre de usuario debe contener unicamente letras o numeros");
      form.username.focus();
      return false;
    }

    if(form.password.value != "" && form.password.value == form.password2.value) {
      if(form.password.value.length < 6) {
        alert("Error: El password debe contener al menos 6 caracteres!");
        form.password.focus();
        return false;
      }
      if(form.password.value == form.username.value) {
        alert("Error: Password debe ser diferente al nombre de usuario!");
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
      alert("Error: Please check that you've entered and confirmed your password!");
      form.password.focus();
      return false;
    }

    alert("You entered a valid password: " + form.password.value);
    return true;
  }

</script>
    
    <div class="container">
    	<div class="row centered-form" style="margin-top: 60px">
    	<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default" style="background: rgba(255,255,255,0.8); box-shadow: rgba(0,0,0,0.3) 20px 20px 20px;">
        		<div class="panel-heading">
                	<h3 class="panel-title">Bienvenido por favor registrese</h3>
			 	</div>
                <div class="panel-body">
                    <form role="form" action="registrar_usuario.php" method="post" onSubmit="return checkForm(this);">
                    	<!--Nombre y apellido-->
                    	<div class="row">
                        	<div class="col-xs-6 col-sm-6 col-md-6">
			    				<div class="form-group">
                                	<label for="first_name">Nombre(s)</label>
			                		<input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="Nombre(s)">
			    				</div>
			    			</div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                	<label for="last_name">Apellido(s)</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Apellido(s)">
                                </div>
                            </div>                       
                        </div>  
                                      
                        <!--Nombre Usuario-->
                        <div class="form-group">
                            <label for="username">Nombre de Usuario:</label><br>
                            <input type="text" name="username" placeholder="usuario" maxlength="20" required class="form-control input-sm">
                    	</div>
                
                        <!--Password-->
                        <div class="row">
                        	<div class="col-xs-6 col-sm-6 col-md-6">
                            	<div class="form-group">
                                    <label for="password">Password:</label><br>
                                    <input type="password" name="password" id="password" maxlength="25" required placeholder="password">
                                    
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                            	<div class="form-group">
                                    <label for="password2">escribir otra vez:</label><br>
                                    <input type="password" name="password2" maxlength="25" required placeholder="Confirmar password">
                                    
                                </div>
                            </div>
                        </div>
                		
                        <!-- Privilegios -->
                        <div class="row">
                        	<div class="col-xs-6 col-sm-6 col-md-6">
                            	<div class="form-group">
                                    <label for="privi">Privilegios</label>
                                    <select class="form-control" name="privi" id="privi">
                                        <option value="2">Administrador</option>
                                        <option value="1">Usuario</option>
                                        <!--<option value="0" selected>Invitado</option>-->
                                    </select>
                                </div>
                        	</div>
                        </div>
                
                        <div class="row">
                        	<div class="col-xs-6 col-sm-6 col-md-6">
                            	<div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Registrarme">
                                </div>
                        	</div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                            	<div class="form-group">
                                    <input type="reset" class="btn btn-danger" name="clear" value="Borrar">
                                </div>
                        	</div>
                        </div>
                
                    </form>
                
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

