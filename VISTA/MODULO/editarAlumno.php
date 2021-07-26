<?php
 if($_SESSION["rol"]=="Secretaría" || $_SESSION["rol"]=="Docente"
 || $_SESSION["rol"]=="Representante"|| $_SESSION["rol"]=="Estudiante" ){
  echo  '<script> 
  window.location="'.SERVERURL.'inicio/";
  </script>
   ';
   return;
 }



?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-graduate"></i>

                        Editar Estudiante</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo SERVERURL;  ?>inicio/">Inicio</a></li>
                        <li class="breadcrumb-item active">Editar Estudiante</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="card card-danger">
                    <form method="post">
                        <div class="card-body">
                            <form method="post">

                                <?php
$link =mysqli_connect($hostname='localhost',$username='root',$password='') or die ("<script language='javascript'>alert('No se puede conectar a la base de datos.')</script>");
mysqli_select_db($link, $dbname='education8');
$rutas = explode("/",$_GET["ruta"]);
$id = $rutas[1];
//$item='id';
//$alumno = ControladorAlumnos::ctrMostrarAlumnos($item,$id);
//var_dump($alumno);
/*$alumno = "SELECT * 
    FROM edu_tab_estudiantes 
   WHERE id = $id";*/
$alumno = "SELECT ate.id as id, ate.CEDULA as cedula, ate.NOMBRES as nombres, ate.APELLIDOS as apellidos,
ate.GENERO as genero, ate.EMAIL as email,ate.TELEFONO as telefono, 
ate.DIRECCION as direccion, 
ate.FECHA_NACIMIENTO as fecha_nacimiento,
ate.id_representante as id_representante, 
ate.password as password,
CONCAT( etr.CEDULA,': ', etr.NOMBRES,' ', etr.APELLIDOS) as representante 
FROM edu_tab_estudiantes ate 
INNER JOIN edu_tab_representantes etr 
ON (etr.id = ate.id_representante) 
where ate.id= $id";


$resultado=mysqli_query($link,$alumno);
//var_dump($resultado);
//$resultado ->query($alumno);
//var_dump($resultado);
//while($alum =$resultado-> fetch_array(MYSQLI_ASSOC));{
while ( $a=mysqli_fetch_assoc($resultado)){
?>
                                <!-- CEDULA Estudiante -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" class="form-control input-lg" name=""
                                            value="<?php echo $a["id"] ?>" readonly>

                                    </div>
                                </div>
                                <!-- CEDULA Estudiante -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        <input type="text" class="form-control input-lg" name="editarCedulaE"
                                            id="editarCedulaE" value="<?php echo $a["cedula"]?>" readonly>
                                    </div>
                                </div>
                                <!-- NOMBRES -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                        <input type="text" class="form-control input-lg" name="editarNombreE"
                                            id="editarNombreE" value="<?php echo $a["nombres"]?>" readonly>
                                    </div>
                                </div>
                                <!-- APELLIDOS -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                        <input type="text" class="form-control input-lg" name="editarApellidoE"
                                            id="editarApellidoE" value="<?php echo $a["apellidos"]?>" readonly>
                                    </div>
                                </div>
                                <!-- GENERO -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                        <input type="text" class="form-control input-lg" name="editarGeneroE"
                                            id="editarGeneroE" value="<?php echo $a["genero"]?>" readonly>
                                    </div>
                                </div>

                                <!-- EMAIL -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        <input type="email" class="form-control input-lg" name="editarEmailE"
                                            id="editarEmailE" placeholder="Ingrese correo electrónico"
                                            value="<?php echo $a["email"]?>" required>
                                    </div>
                                </div>
                                <!-- TELEFONO -->
                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="text" class="form-control" data-inputmask='"mask": "999 999-9999"'
                                            data-mask placeholder="Ingrese número telefónico" name="editarTelefonoE"
                                            id="editarTelefonoE" value="<?php echo $a["telefono"]?>" required>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                     <!-- PASSWORD -->
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control input-lg" name="editarPassword"
                                                placeholder="Ingresar nueva contraseña" id="editarPassword"
                                                minlength="8" autocomplete="off">
                                            <input type="hidden" id="passwordActual" name="passwordActual" value="<?php echo $a["password"] ?>">
                                        </div>
                                        <div id="editarMensaje"></div>
                                    </div>
                                    <!-- DIRECCION-->
                             
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        <textarea class="form-control input-lg" name="editarDireccionE"
                                            id="editarDireccionE"
                                            placeholder="Ingrese dirección"><?php echo $a["direccion"]?></textarea>
                                    </div>
                                </div>
                                <!-- FECHA DE NACIMIENTO -->
                                <!-- <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control input-lg" data-inputmask-alias="datetime"
                                data-inputmask-inputformat="yyyy/mm/dd" data-mask name="editarFechaD" id="editarFechaD"
                                readonly>
                        </div>

                    </div> -->
                                <!-- REPRESENTANTE -->
                                <div class="form-group">

                                    <span class=""><strong>Representante: </strong></span>

                                    <div class="select2-purple">
                                        <div class="input-group">
                                            <select class="select2 input-lg" multiple="" style="width: 100%;"
                                                name="editarRepresentanteE">
                                                <option value="<?php echo $a["id_representante"]?> " selected>
                                                    <?php echo $a["representante"]?></option>
                                                <?php

$representante=ControladorRepresentantes::ctrListarRepresentante();

foreach($representante as $key=>$value){
   
echo'<option value="'.$value["id"].'">'.$value["cedula"].': '.$value["nombre"].'</option>';
     
}
          ?>
                                            </select>

                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a type="submit" class="btn btn-danger"
                                        href="<?php echo SERVERURL;  ?>alumnos/">Cancelar</a>
                                    <button class="btn btn-primary">Guardar</button>
                                </div>

                        </div>
                        <?php } ?>

                        <?php
                        
                        $editarE = new ControladorAlumnos();
                        $editarE-> ctrEditarEstudiante();

                        ?>

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->



        </div>
        <!-- /.col (right) -->
</div>

</section>
</div>