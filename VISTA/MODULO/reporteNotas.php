<?php
 if($_SESSION["rol"]=="Secretaría" || $_SESSION["rol"]=="Administrador"
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
                    <h1><i class="fas fa-notes-medical"></i> Calificaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo SERVERURL;  ?>inicio/">Inicio</a></li>
                        <li class="breadcrumb-item active">Calificaciones</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <form method="post">
                    <div class="row">

                        <div class="col-md-3">

                            <div class="form-group">
                                <input type="hidden" value="<?php echo $_SESSION["id"]?>" id="idDocenteG"
                                    name="idDocenteG">
                                <label>Grado:</label>
                                <select required class="form-control select2bs4" style="width: 100%;" name="idGrado" id="idGrado"
                                    data-placeholder="Seleccionar">
                                    <option value="">Seleccionar</option>
                                    <?php
 $id=$_SESSION["id"];
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
                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label>Fecha:</label>
                                <input type="text" class="form-control" name="fecha" value="<?php echo date("Y-m-d") ?>" readonly>
                            </div>
                        </div> -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Calificaciones:</label>
                                <button class="form-control btn btn-primary" >Buscar <i
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
                <form method="POST">
<?php
        $notas = ControladorNotas::ctrListaNotas();
    

 if(!empty($lista)){
     echo'
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">

                        </div>

                    </div>';} ?>
                    <table class="table table-bordered table-striped dt-responsive" data-page-length='50' id="tablaboton">
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

                $cont=0;
         
    if(isset($notas)){
        foreach($notas as $es){

            $cont=$cont+1;
                 echo '<tr>
                         <td>'.$cont.'</td>
                       
                      <input type="hidden" class="form-control-plaintext" readonly name="EidEstudiante[]" value="'.$es["id"].'">
                      <input type="hidden" class="form-control-plaintext" readonly name="EidGdoc" value="'.$es["gdoc"].'">
                      <input type="hidden" class="form-control-plaintext" readonly name="EidNota[]" value="'.$es["idNota"].'">
            
                      <td> '.$es["estudiante"].'</td>
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
        echo'<input type="hidden" id="num" value="'.$cont.'">';
    }

?>
                        </tbody>

                    </table>
     
                    </form>
            </div>

        </div>


    </section>
</div>