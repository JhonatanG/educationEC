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
                    <h1> <i class="fas fa-building nav-icon"></i>
                        Clases Docente</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo SERVERURL;  ?>inicio/">Inicio</a></li>
                        <li class="breadcrumb-item active"> Clases Docente</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDocg">
                    <i class="fas fa-plus-square"></i> Agregar Clases Docente
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped dt-responsive" id="tablaboton">
                    <thead>
                        <tr>
                            <th style="width: 8px;">#</th>
                            <th>Docentes</th>
                            <th>Grados</th>
                            <th>Materias</th>
                            <th>Estado</th>
                            <th>Observacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
            $item="";
            $valor="";
            $docg =ControladorDocg::ctrMostrarDocg($item,$valor);
            $cont=0;
    foreach($docg as $a){
        $cont=$cont+1;
             echo '<tr>
                     <td>'.$cont.'</td>
                    <td>'.$a["docente"].'</td>
                    <td>'.$a["grado"].'</td>
                    <td>'.$a["nombre"].'</td>';
                    if ($a["estado"]!=0){
                        echo' <td><button class="btn btn-success btn-xs  btnActivarDocgrado" idDocgrado="'.$a["id"].'"
                        estadoDocgrado="0">Activo</button></td>';
                        }else{
                          echo' <td><button class="btn btn-danger btn-xs  btnActivarDocgrado" idDocgrado="'.$a["id"].'"
                        estadoDocgrado="1">Inactivo</button></td>';
                        }

                echo '
                    <td>'.$a["observacion"].'</td>
                    <td>
                    <div class="btn-group">
                    <button class="btn btn-warning btnEditarDocgrado" idDocgrado="'.$a["id"].'" data-toggle="modal"  data-target="#modalEditarDocgrado">
                          <i class="fas fa-edit"></i></butoon>
                      <button class="btn btn-danger btnEliminarDocgrado" idDocgrado="'.$a["id"].'"><i class="fas fa-trash"></i></button>
                    </div>
                    </td>
                    </tr>';
                        }

                ?>
                    </tbody>

                </table>

            </div>

        </div>


    </section>

</div>
<!-- 
/*=============================================
MODAL AGREGAR 
=============================================*/ -->
<div class="modal fade" id="modalAgregarDocg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header" style="background: #008080;">
                    <h5 class="modal-title">Agregar Clases Docentes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="true">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </h5>
                </div>
                <div class="modal-body">

                    <!-- ENTRADA Materias -->
                    <div class="form-group">

                        <span class=""><strong>Seleccionar el Docente: </strong></span>

                        <div class="select2-purple">
                            <div class="input-group">
                                <select class="select2" multiple="multiple" data-placeholder="Seleccionar el Docente"
                                    data-dropdown-css-class="select2-purple" style="width: 100%;" name="idDocenteD"
                                    id="idDocenteD" required>
                                    <?php
                               
                               $docentes=ControladorDocentes::ctrListarDocentes();
                             
                               foreach($docentes as $key=>$value){
                                   
                                echo'<option value="'.$value["id"].'">'.$value["cedula"].': '.$value["nombre"].'</option>';
                                     
                              }
                                          ?>


                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class=""><strong> Seleccionar los Grados:</strong> </span>
                        <div class="input-group">

                            <?php
               $GraPa=ControladorDocg::ctrListarGradosParalelos();
                foreach ($GraPa as $key => $value) {
                    echo'<div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="idGrado" name="idGrados[]" value="'.$value["id"].'">
                    <label class="form-check-label" for="">'.$value["grado"].'</label>
                </div>';
                 }                     
                    ?>
                        </div>
                    </div>
                    <!-- ENTRADA MATERIAS -->
                    <div class="form-group">
                        <span class=""><strong> Seleccionar las Materias:</strong> </span>
                        <div class="input-group">

                            <?php
               $Materias=ControladorMaterias::ctrListarMaterias();
                foreach ($Materias as $key => $value) {
                    echo'<div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="idMateria" name="idMateria[]" value="'.$value["id"].'">
                    <label class="form-check-label" for="Materias">'.$value["nombre"].'</label>
                </div>';
                 }                     
                    ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-archive"></i></span>
                            <textarea class="form-control input-lg" name="nuevaObservacion" id="nuevaObservacion"
                                placeholder="Ingrese observación general para todas los grados seleccionados (Opcional)"></textarea>
                        </div>
                    </div>
                    <input type="hidden" value="1" name="nuevoEstado">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    <?php
$crearN = new ControladorDocg();
$crearN -> ctrCrearDocg();
?>


                </div>
            </form>
        </div>
    </div>
</div>
<!-- 
/*=============================================
MODAL EDITAR Paralelo 
=============================================*/ -->
<div class="modal fade" id="modalEditarDocgrado" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header" style="background: #008080;">
                    <h5 class="modal-title">Editar Observación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </h5>
                </div>
                <div class="modal-body">
             
                    <div class="form-group">
                        <div class="input-group">
            
                            <input type="hidden" class="form-control input-lg" name="editarDocgrado" id="editarDocgrado"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-archive"></i></span>
                            <textarea class="form-control input-lg" name="editarObservacion"
                                id="editarObservacion"               
                                 placeholder="Ingrese observación (Opcional)"></textarea>
                        </div>
                    </div>
      
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
<?php
$editar= new ControladorDocg();
$editar->ctrEditarDocgrado();
?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$eliminar = new ControladorDocg();
$eliminar->ctrEliminarDocgrados();
?>