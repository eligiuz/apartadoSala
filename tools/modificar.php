<?php

    session_start();
    include '../funciones.php';
    include '../config.php';
    // Definimos nuestra zona horaria
    date_default_timezone_set("America/Mexico_City");

if (!isset($_SESSION['id'])) {
    header("location:../index.php");
} else {
    $di = evaluar($_GET['id']);
    $id  = isset($di) ? $di : 0;
    $sql = "SELECT * FROM eventos WHERE id = $id";
        // Ejecutamos nuestra sentencia sql
        $e = $conexion->query($sql);

        //$stmt = $conexion->prepare($sql);
//		$stmt->bind_param('i',$id);
//		$stmt->execute();
//		$e = $stmt->get_result();
        $row=$e->fetch_array(MYSQLI_ASSOC);
        //$row = $e->fetch_assoc();
        $tipoEvento = cambiarTipo($row['class']);
    (($row['apartado'] == 1) and ($_SESSION['privilegio'] == 1)) ? $soloLeer="readonly" : $soloLeer="";
}


    $base_url="../";

    include '../cabecera.php';


    ?>

<div class="container" style="padding:30px">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-4">
          <form class="form-horizontal" action="modificarTodo.php" method="post">
            <legend style="float:right">Modificar Evento</legend>
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

            <!--Titulo-->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" required autocomplete="off" name="title" class="form-control input-md" id="title" <?php echo $soloLeer ?> value="<?php echo $row['title']?>">
                    </div>
                </div>
            </div>

             <!--Responsable-->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="">Responsable del evento</label>
                        <div class="input-group">
                            <input type="text" required autocomplete="off" name="responsable_nombre" class="form-control input-md" id="responsable_nombre" placeholder="Nombre" <?php echo $soloLeer ?> value="<?php echo $row['responsable_nombre']?>">
                            <span class="input-group-addon">-</span>
                            <input type="text" required autocomplete="off" name="responsable_apellido" class="form-control input-md" id="responsable_apellido" placeholder="Apellido" <?php echo $soloLeer ?> value="<?php echo $row['responsable_apellido']?>">
                        </div>
                    </div>
                </div>
            </div>

            <!--Responsable del evento-->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="">Responsable del evento</label>
                        <div class="input-group">
                            <input type='text' id="from" name="from" class="form-control input-md" required readonly value="<?php echo $row['inicio_normal']?>"  />
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                            <span class="input-group-addon">-</span>
                            <input type='text' name="to" id="to" class="form-control input-md"  required readonly value="<?php echo $row['final_normal']?>" />
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
            </div>

            <!--Tipo de evento-->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="class">Tipo de evento</label>
                        <?php if (($row['apartado'] == 1) and ($_SESSION['privilegio'] == 1)) {
        ?>
                            <select class="form-control" name="class" id="class">
                                <option value="<?php echo $row['class']?>" selected><?php echo $tipoEvento ?></option>
                            </select>
                        <?php
} else {
    ?>
                <select class="form-control" name="class" id="class">
                  <option value="<?php echo $row['class']?>" selected><?php echo $tipoEvento ?></option>
                  <option value="event-videoconferencia">Videoconferencia</option>
                  <option value="event-conferencia">Conferencia</option>
                  <option value="event-convenio">Convenio</option>
                  <option value="event-reunion">Reunión</option>
                  <option value="event-pelicula">Película</option>
                  <option value="event-capacitacion">Capacitación</option>
                  <option value="event-presentacionLibro">Presentación de Libro</option>
                  <option value="event-mesaLectura">Mesa de Lectura</option>
                  <option value="event-otro">Otro</option>
                </select>
                <?php
} ?>
                    </div>
                </div>
            </div>


            <!--Observación y o comentario-->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="event">Observación y/o comentario</label>
                        <textarea id="event" name="event" class="form-control" <?php echo $soloLeer ?> rows="3"><?php echo $row['body']?></textarea>
                    </div>
                </div>
            </div>

            <!--Status-->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" autocomplete="off" name="status" class="form-control input-md" id="status" placeholder="Público o Privado" value="<?php echo $row['status']?>">
                    </div>
                </div>
            </div>

            <!--Ponente-->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="">Ponente</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" name="ponente_nombre" class="form-control input-md" id="ponente_nombre" placeholder="Nombre" value="<?php echo $row['ponente_nombre']?>">
                            <span class="input-group-addon">-</span>
                            <input type="text" autocomplete="off" name="ponente_apellido" class="form-control input-md" id="ponente_apellido" placeholder="Apellido" value="<?php echo $row['ponente_apellido']?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Objetivo -->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="objetivo">Objetivo</label>
                        <textarea id="objetivo" name="objetivo" class="form-control" rows="3" placeholder="Propósito qué busca al promover el evento"><?php echo $row['objetivo']?></textarea>
                    </div>
                </div>
            </div>

            <!--Institución o empresa-->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="empresa">Institución/Empresa</label>
                        <input type="text" autocomplete="off" name="empresa" class="form-control input-md" id="empresa" placeholder="Intitución/Empresa de la ponencia" value="<?php echo $row['empresa']?>">
                    </div>
                </div>
            </div>


            <!--Numero de asistente-->
            <label for="">Número de asistentes</label>
            <!--Alumnos-->
            <div class="row">
                <div class="col-xs-8">
                    <label for="">Alumnos</label>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">H</span>
                            <input type="number" name="ah" class="form-control" id="ah" value="<?php echo isset($row['ah']) ? $row['ah'] : 0;?>">
                            <span class="input-group-addon">M</span>
                            <input type="number" name="am" class="form-control" id="am" value="<?php echo isset($row['am']) ? $row['am'] : 0;?>">
                        </div>
                    </div>
                </div>

            </div>
            <!--Docentes-->
            <div class="row">
                <div class="col-xs-8">
                    <label for="">Docentes</label>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">H</span>
                            <input type="number" name="dh" class="form-control" id="dh" value="<?php echo isset($row['dh']) ? $row['dh'] : 0;?>">
                            <span class="input-group-addon">M</span>
                            <input type="number" name="dm" class="form-control" id="dm" value="<?php echo isset($row['dm']) ? $row['dm'] : 0;?>">
                        </div>
                    </div>
                </div>
            </div>
            <!--Administrativos-->
            <div class="row">
                <div class="col-xs-8">
                    <label for="">Administrativos</label>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">H</span>
                            <input type="number" name="adh" class="form-control" id="adh" value="<?php echo isset($row['adh']) ? $row['adh'] : 0;?>">
                            <span class="input-group-addon">M</span>
                            <input type="number" name="adm" class="form-control" id="adm" value="<?php echo isset($row['adm']) ? $row['adm'] : 0;?>">
                        </div>
                    </div>
                </div>
            </div>
            <!--Otros-->
            <div class="row">
                <div class="col-xs-8">
                    <label for="">Otros</label>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">H</span>
                            <input type="number" name="oh" class="form-control" id="oh" value="<?php echo isset($row['oh']) ? $row['oh'] : 0;?>">
                            <span class="input-group-addon">M</span>
                            <input type="number" name="om" class="form-control" id="om" value="<?php echo isset($row['om']) ? $row['om'] : 0;?>">
                        </div>
                    </div>
                </div>
            </div>


            <!--Empresas participantes-->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="inst_part">Empresas participantes</label>
                        <textarea id="inst_part" name="inst_part" class="form-control" rows="3" placeholder="Empresas participantes (separar con comas)"><?php echo $row['inst_part']?></textarea>
                    </div>
                </div>
            </div>

            <!--Enlace-->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="">Enlace Administrativo/Técnico del evento</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" name="enlace_nombre" class="form-control input-md" id="enlace_nombre" placeholder="Nombre" value="<?php echo $row['enlace_nombre']?>">
                            <span class="input-group-addon">-</span>
                            <input type="text" autocomplete="off" name="enlace_apellido" class="form-control input-md" id="enlace_apellido" placeholder="Apellido" value="<?php echo $row['enlace_apellido']?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Observaciones despues del evento -->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="observacion">Observaciones (terminado el evento)</label>
                        <textarea id="observacion" name="observacion" class="form-control" rows="3" placeholder="Observaciones y/o comentarios despues de terminado el evento"><?php echo $row['observacion']?></textarea>
                    </div>
                </div>
            </div>

            <?php if ($_SESSION['privilegio'] == 2) {
        ?>
            <!-- Opinión general del evento (uso exclusivo de IE) -->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="opinion">Observaciones del evento (uso exclusivo Innovación Educativa)</label>
                        <textarea id="opinion" name="opinion" class="form-control" rows="3" placeholder="Opinión general del evento (retroalimentación)"><?php echo $row['opinion']?></textarea>
                    </div>
                </div>
            </div>
            <?php
} ?>

            <!--boton de guardar-->
            <div class="form-group">
            <div class="row">
              <div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-xs-2 col-sm-2 col-md-2">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>

            </div>
            </div>

            <?php if (($row['apartado'] == 1) and ($_SESSION['privilegio'] == 1)) {
} else {
    ?>

        <script type="text/javascript">
            $(function () {
                $('#from').datetimepicker({
                    language: 'es',
                    minDate: new Date()
                });
                $('#to').datetimepicker({
                    language: 'es',
                    minDate: new Date()
                });

            });
        </script>

        <?php
} ?>

          </form>
           <div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-xs-2 col-sm-2 col-md-2">
               <a href="../eventosControl.php"><button class="btn btn-warning">Cancelar</button></a>
           </div>
        </div>  <!--Fin de col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4-->
    </div>  <!--Fin de row centered-form-->
</div>	<!-- Fin de container -->


<?php

 include '../pie.php';

    ?>