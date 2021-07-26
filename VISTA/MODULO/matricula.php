<?php
 if( $_SESSION["rol"]=="Docente"
 || $_SESSION["rol"]=="Representante"|| $_SESSION["rol"]=="Estudiante" ){
  echo  '<script> 
  window.location="'.SERVERURL.'inicio/";
  </script>
   ';

 }



?>
<div class="content-wrapper">

    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-chalkboard"></i>
                    Matrículas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo SERVERURL;  ?>inicio/">Inicio</a></li>
                    <li class="breadcrumb-item active">Matrículas</li>
                </ol>
            </div>
        </div>

    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <!--=====================================
      EL FORMULARIO
      ======================================-->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Matricula</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">



                        <!--=====================================
                ENTRADA DEL USUARIO
                ======================================-->

                        <form method="post">
                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-text"><i class="fa fa-user"></i></span>

                                    <input type="text" class="form-control" id="" name=""
                                        value="<?php echo $_SESSION["usuario"] ?>" readonly>
                                    <input type="hidden" class="form-control" id="nuevoUsuario" name="nuevoUsuario"
                                        value="<?php echo $_SESSION["id"] ?>" readonly>
                                </div>

                            </div>

                            <!--=====================================
                ENTRADA DEL MATRICULA
                ======================================-->

                            <?php 
     $item = null;
     $valor = null;
     $matricula = ControladorMatricula::ctrMostrarMatricula($item,$valor);

     if(!$matricula){
        echo '          <div class="form-group">

        <div class="input-group">

            <span class="input-group-text"><i class="fas fa-laptop-code"></i></span>

            <input type="text" class="form-control" id="nuevaMatricula" name="nuevaMatricula"
                value="1" readonly>

        </div>

    </div>';
     }else{
         foreach ($matricula as $key => $value ){
             
         }
         $codigo = $value["codigo"]+1;
        // var_dump($codigo);
         echo '          <div class="form-group">

         <div class="input-group">

             <span class="input-group-text"><i class="fas fa-laptop-code"></i></span>

             <input type="text" class="form-control" id="nuevaMatricula" name="nuevaMatricula"
                 value="'.$codigo.'" readonly>

         </div>

     </div>';

     }

     
     ?>


                            <!--=====================================
                ENTRADA DEL ESTUDIANTE
                ======================================-->

                            <div class="form-group">

                                <span class=""><strong>Estudiante: </strong></span>

                                <div class="select2-purple">

                                    <div class="input-group">
                                        <select class="select2" multiple="multiple"
                                            data-placeholder="Seleccionar Estudiante"
                                            data-dropdown-css-class="select2-purple" style="width: 80%;"
                                            name="nuevoEstudiante" required>

                                            <?php

$estudiante=ControladorMatricula::ctrListarEstudiante();

foreach($estudiante as $key=>$value){
   
echo'<option value="'.$value["id"].'">'.$value["cedula"].': '.$value["nombre"].'</option>';
     
}
          ?>

                                        </select>
                                        <div class="input-group-append">

                                            <a href="<?php echo SERVERURL;  ?>agregarAlumno/" class="btn btn-success"
                                                role="button" aria-pressed="true">
                                                <i class="fas fa-plus-square"></i> Agregar</a>
                                        </div>
                                    </div>

                                </div>


                            </div>


                            <!-- ENTRADA PARA ANIO LECTIVO-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                    <select name="nuevoPeriodo" id="" class="form-control input-lg" required>
                                        <option value="">Seleccionar Año Lectivo</option>
                                        <?php

$anio=ControladorAnio::ctrListarAnio();

foreach($anio as $key=>$value){
   
echo'<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
     
}
          ?>
                                    </select>
                                </div>
                            </div>
                            <!--                ENTRADA PARA AGREGAR GRADO -->

                            <div class="form-group row nuevoGrado">
                            </div>
                            <!-- ENTRADA PARA OBSERVACION     -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-archive"></i></span>
                                    <textarea class="form-control input-lg" name="nuevaObservacion"
                                        id="nuevaObservacion" placeholder="Observacion (Opcional)"></textarea>
                                </div>
                            </div>


                            <div class="modal-footer">

                                <button type="submit" class="btn btn-primary">Guardar</button>

                            </div>
                    </div>
                    <?php
$crear= new ControladorMatricula();
$crear -> ctrCrearMatricula();

               ?>
                    </form>
                </div>

            </div>

            <!--=====================================
      LISTA DE GRADO PARALELO
                ======================================-->
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Grado y Paralelo</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-1">
                        <table class="table table-bordered table-striped dt-responsive" id="tablas">
                            <thead>
                                <tr>
                                    <th style="width: 8px;">#</th>
                                    <th>Grado</th>
                                    <th>Cupos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                $item="";
                $valor="";
                $gparalelo =ControladorMatricula::ctrMostrarGparalelos();
                $cont=0;
        foreach($gparalelo as $a){
            $cont=$cont+1;
                 echo '<tr>
                         <td>'.$cont.'</td>
                        <td>'.$a["grado"].'</td>';
                        if($a["cupos"]>=20){
                         echo ' <td> <button class="btn btn-success">'.$a["cupos"].'</button>   </td>';
                        }else if($a["cupos"]<20 && $a["cupos"]>=10){
                            echo ' <td> <button class="btn btn-warning">'.$a["cupos"].'</button>   </td>';
                        }else if ($a["cupos"]<10 ){
                            echo ' <td> <button class="btn btn-danger">'.$a["cupos"].'</button>   </td>';
                        }
                        
                
    
                
                       echo'
                        <td>
                        <div class="btn-group">
                          <button class="btn btn-info btnGparalelo recuperarBoton" idGparalelo="'.$a["id"].'" id="agregar" name="agregar">Agregar <i class="fas fa-cart-plus"></i></button>
                        </div>
                        </td>
                        </tr>';
                            }

                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
    </section>

</div>