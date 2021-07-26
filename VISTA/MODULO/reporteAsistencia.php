<?php
 if($_SESSION["rol"]=="Docente"
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
                    <h1><i class="fas fa-calendar-week"></i> Reporte Asistencia</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo SERVERURL;  ?>inicio/">Inicio</a></li>
                        <li class="breadcrumb-item active">Reporte Asistencia</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <!-- =============================================
FORM BUSCAR DOCENTE
=============================================*/ -->
                <form method="POST">
                    <div class="row">

                        <div class="col-md-2">


                        </div>
                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Docente:</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="idDocenteA"
                                    id="idDocenteA" data-placeholder="Seleccionar">
                                    <option value="">Seleccionar</option>
                                    <?php
                               
                               $docentes=ControladorDocentes::ctrListarDocentes();
                             
                               foreach($docentes as $key=>$value){
                                if(isset($_POST["idDocenteA"]) && $_POST["idDocenteA"] == $value["id"]){

                                echo'<option value="'.$value["id"].'" selected>'.$value["cedula"].': '.$value["nombre"].'</option>';

                                }else{
                                   
                                echo'<option value="'.$value["id"].'">'.$value["cedula"].': '.$value["nombre"].'</option>';
                            }  
                              }
                                          ?>

                                </select>

                            </div>
                        </div> 

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Buscar Docente:</label>
                                <button class="form-control btn btn-info">Buscar <i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </div>
                </form>
    <!-- =============================================
FORM BUSCAR MATERIA
=============================================*/ -->
                <form method="post">

                    <div class="row">

   <div class="col-md-3">
                            <div class="form-group">
                            <?php
      $idDoce = ControladorAsistencia::ctrIdDocente();
      if(!empty($idDoce)){
      foreach($idDoce as $idD){
          
             echo'       <input type="hidden" value="'.$idD["id"].'" id="idDocenteG"
                                    name="idDocenteG">
                     ';
            /*ID DEL DOCENTE PARA OBTENER LOS GRADOS*/
                     $id=$idD["id"];}
                    }
?>
                                <label>Grado:</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="idGrado" id="idGrado"
                                    data-placeholder="Seleccionar">
                                    <option value="">Seleccionar</option>
                                    <?php

 $item="id_docente";
$grados=ControladorAsistencia::ctrListaGradosDocente($item,$id);

foreach($grados as $key=>$value){
    if(isset($_POST["idGrado"]) && $_POST["idGrado"] == $value["id"]){

        echo'<option class="btnGradoAsistencia" value="'.$value["id"].'" selected >'.$value["grado"].'</option>';
            }else{
        echo'<option class="btnGradoAsistencia" value="'.$value["id"].'"  >'.$value["grado"].'</option>';
        
            }
    }

?>

                                </select>




                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Materia:</label>
                                <select class="form-control select2bs4 datos" name="idMateria" id="idMateria"
                                    style="width: 100%;">


                                </select>
                            </div>

                        </div>
                 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Asistencia:</label>
                                <button class="form-control btn btn-primary">Buscar <i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>





            <div class="card-body">
                <?php
  $lista= ControladorAsistencia::ctrListaCabecera();
  if(isset($lista)){
  foreach($lista as $a){
 echo' <div class="card bg-info text-dark"> 
 <div class="card-body">
  <div class="row">   <div class="col-md-3">
    <div class="form-group">
        <label>Docente:</label>
        <input type="text" class="form-control-plaintext" readonly value="'.$a["docente"].'">
    </div>
</div>';
echo'   <div class="col-md-3">
<div class="form-group">
    <label>Grado:</label>
    <input type="text" class="form-control-plaintext" readonly value="'.$a["grado"].'">
</div>
</div>';
echo'   <div class="col-md-3">
<div class="form-group">
    <label>Materia:</label>
    <input type="text" class="form-control-plaintext" readonly value="'.$a["materia"].'">
</div>
</div> 

</div>
</div>
</div>';
  }
  if(empty($lista)){
    echo' <div class="card bg-danger text-dark"> 
    <div class="card-body">
    <h3 align="center">¡No existen estudiantes!</h3>
    </div>
</div>';
  }
  }
?>
        

                    <table class="table table-bordered table-striped dt-responsive" id="tablaboton">
                        <thead>
                            <tr>
                                <th style="width: 8px;">#</th>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Fuga</th>
                                <th>Falta Injustificada</th>
                                <th>Falta Justificada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                $listaEstudiante = ControladorAsistencia::ctrReporteAsistencia();
                $cont=0;
    if(isset($listaEstudiante)){
        foreach($listaEstudiante as $es){

            $cont=$cont+1;
                 echo '<tr>
                         <td>'.$cont.'</td>
                        <td> '.$es["cedula"].'</td>
                      <input type="hidden" class="form-control-plaintext" readonly name="idEstudiante[]" value="'.$es["id"].'">
                      
            
                      <td>'.$es["estudiante"].'</td>';
                      if($es["FG"]>0){
                        echo ' <td><span class="badge bg-danger">'.$es["FG"].'</span> 
                        </td>' ;
                    }else {
                        echo ' <td><span class="badge bg-success">'.$es["FG"].'</span> 
                        </td>' ;
                    }
                    if($es["FI"]>0){
                        echo ' <td><span class="badge bg-warning">'.$es["FI"].'</span> 
                        </td>' ;
                    }else {
                        echo ' <td><span class="badge bg-success">'.$es["FI"].'</span> 
                        </td>' ;
                    }
                    if($es["FJ"]>0){
                        echo ' <td><span class="badge bg-primary">'.$es["FJ"].'</span> 
                        </td>' ;
                    }else {
                        echo ' <td><span class="badge bg-success">'.$es["FJ"].'</span> 
                        </td>' ;
                    }
                
                    
                    echo'
                        
                      </tr>
                      ';
                 
        }
    }

?>
                        </tbody>

                    </table>
      
            </div>

        </div>


    </section>
</div>
