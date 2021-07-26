<?php
 if($_SESSION["rol"]=="Docente"
 || $_SESSION["rol"]=="Representante"|| $_SESSION["rol"]=="Administrador" ){
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
                    <h1><i class="fas fa-notes-medical"></i></i> Reporte Notas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo SERVERURL;  ?>inicio/">Inicio</a></li>
                        <li class="breadcrumb-item active">Reporte Notas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body">

                <table class="table table-bordered table-striped dt-responsive" id="tablaboton">
                    <thead>
                         <tr>
                                <th style="width: 8px;">#</th>
                                <th  width="20%"  >Nombre</th>
                                <th width="8%" bgcolor="yellow">P1Q1</th>
                                <th width="8%"  bgcolor="yellow">P2Q1</th>
                                <th width="8%"  bgcolor="yellow">P3Q1</th>
                                <th width="8%"  bgcolor="yellow">ExQ1</th>
                                <th width="8%" >Q1</th>
                                <th width="8%"  bgcolor="green">P1Q2</th>
                                <th width="8%"  bgcolor="green">P2Q2</th>
                                <th width="8%"  bgcolor="green">P3Q2</th>
                                <th width="8%"  bgcolor="green">ExQ2</th>
                                <th width="8%"  >Q2</th>
                                <th width="8%"  >Promedio</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php
 $id=$_SESSION["id"];
                $listaEstudiante = ControladorNotas::ctrReportNotEstud($id);
                $cont=0;
    if(isset($listaEstudiante)){
        foreach($listaEstudiante as $es){

            $cont=$cont+1;
                 echo '<tr>
                         <td>'.$cont.'</td>
                       
                      <input type="hidden" class="form-control-plaintext" readonly name="EidEstudiante[]" value="'.$es["id"].'">
                      
            
                      <td> '.$es["materia"].'</td>
                        <td> '.$es["P1Q1"].'</td>
                        <td> '.$es["P2Q1"].'</td>
                        <td>  '.$es["P3Q1"].'</td>
                        <td>'.$es["EXQ1"].'</td>';
                        if($es["Q1"]>=0 && $es["Q1"]<7){
                            echo ' <td><span class="badge bg-danger">'.$es["Q1"].'</span> 
                            </td>' ;
                        }
                        if($es["Q1"]>7 && $es["Q1"]<8.5){
                            echo ' <td><span class="badge bg-warning">'.$es["Q1"].'</span> 
                            </td>' ;
                        }
                        if($es["Q1"]>8.5 && $es["Q1"]<10){
                            echo ' <td><span class="badge bg-success">'.$es["Q1"].'</span> 
                            </td>' ;
                        }echo'

                        <td>'.$es["P1Q2"].'</td>
                        <td>'.$es["P2Q2"].'</td>
                        <td> '.$es["P3Q2"].'</td>
                        <td> '.$es["EXQ2"].'</td>';
                        if($es["Q2"]>=0 && $es["Q2"]<7){
                            echo ' <td><span class="badge bg-danger">'.$es["Q2"].'</span> 
                            </td>' ;
                        }
                        if($es["Q2"]>7 && $es["Q1"]<8.5){
                            echo ' <td><span class="badge bg-warning">'.$es["Q2"].'</span> 
                            </td>' ;
                        }
                        if($es["Q2"]>8.5 && $es["Q2"]<10){
                            echo ' <td><span class="badge bg-success">'.$es["Q2"].'</span> 
                            </td>' ;
                        }  if($es["NF"]>=0 && $es["NF"]<7){
                            echo ' <td><span class="badge bg-danger">'.$es["NF"].'</span> 
                            </td>' ;
                        }
                        if($es["NF"]>7 && $es["NF"]<8.5){
                            echo ' <td><span class="badge bg-warning">'.$es["NF"].'</span> 
                            </td>' ;
                        }
                        if($es["NF"]>8.5 && $es["NF"]<10){
                            echo ' <td><span class="badge bg-success">'.$es["NF"].'</span> 
                            </td>' ;
                        }echo'

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