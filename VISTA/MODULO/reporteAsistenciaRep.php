<?php
 if($_SESSION["rol"]=="Docente"
 || $_SESSION["rol"]=="Estudiante"|| $_SESSION["rol"]=="Administrador" ){
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
            <div class="card-body">
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

                                <label>Estudiante:</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="idEstudiante"
                                    id="idEstudiante" data-placeholder="Seleccionar">
                                    <option value="">Seleccionar</option>
                                    <?php
                                $id=$_SESSION["id"];
                               $estudiantes=ControladorAsistencia::ctrEstuRepre($id);
                             
                               foreach($estudiantes as $key=>$value){
                                if(isset($_POST["idEstudiante"]) && $_POST["idEstudiante"] == $value["id"]){

                                echo'<option value="'.$value["id"].'" selected>'.$value["cedula"].': '.$value["nombre"].'</option>';
                                $idEstud=$value["id"];
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
                                <label>Buscar Estudiante:</label>
                                <button class="form-control btn btn-info">Buscar <i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
                <table class="table table-bordered table-striped dt-responsive" id="tablaboton">
                    <thead>
                        <tr>
                            <th style="width: 8px;">#</th>
                            <th>Cédula</th>
                            <th>Materia</th>
                            <th>Fuga</th>
                            <th>Falta Injustificada</th>
                            <th>Falta Justificada</th>
                            <th>Periodo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
if(isset($idEstud)){
                $listaEstudiante = ControladorAsistencia::ctrReportAsisEstud($idEstud);
                $cont=0;
    if(isset($listaEstudiante)){
        foreach($listaEstudiante as $es){

            $cont=$cont+1;
                 echo '<tr>
                         <td>'.$cont.'</td>
                        <td> '.$es["cedula"].'</td>                      
            
                      <td>'.$es["materia"].'</td>';
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
                    <td>'.$es["periodo"].'</td>
                      </tr>
                      ';
                 
        }
    }
}
?>
                    </tbody>

                </table>

            </div>

        </div>


    </section>
</div>