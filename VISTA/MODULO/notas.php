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

                            <div class="form-group">

                                <button class="form-control btn btn-success">Guardar <i
                                        class="fas fa-save"></i></button>
                            </div>
                        </div>

                    </div>';} ?>
                    <table class="table table-bordered table-striped dt-responsive" data-page-length='50'>
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
if(empty($notas)){
                $listaEstudiante = ControladorNotas::ctrListaEstudiante();
                $cont=0;
    if(isset($listaEstudiante)){
        foreach($listaEstudiante as $es){

            $cont=$cont+1;
                 echo '<tr>
                         <td>'.$cont.'</td>
                       
                      <input type="hidden" class="form-control-plaintext" readonly name="idEstudiante[]" value="'.$es["id"].'">
                      <input type="hidden" class="form-control-plaintext" readonly name="idGdoc" value="'.$es["gdoc"].'">
            
                      <td> '.$es["estudiante"].'</td>
                        <td> <input type="number" required class="form-control" onchange="sumarPromedioQ1(this.value);" name="P1Q1[]" id="P1Q1'.$cont.'" value="0" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" required class="form-control" onchange="sumarPromedioQ1(this.value);" name="P2Q1[]" id="P2Q1'.$cont.'"  value="0" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" required class="form-control"  onchange="sumarPromedioQ1(this.value);" name="P3Q1[]" id="P3Q1'.$cont.'" value="0" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" required class="form-control" onchange="sumarPromedioQ1(this.value);" name="ExQ1[]" id="ExQ1'.$cont.'" value="0" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" readonly class="form-control" name="Q1[]" id="Q1'.$cont.'" value="0" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" class="form-control" onchange="sumarPromedioQ2(this.value);" name="P1Q2[]" id="P1Q2'.$cont.'" value="0" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" class="form-control" onchange="sumarPromedioQ2(this.value);" name="P2Q2[]" id="P2Q2'.$cont.'"  value="0" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" class="form-control" onchange="sumarPromedioQ2(this.value);" name="P3Q2[]" id="P3Q2'.$cont.'"  value="0" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" class="form-control" onchange="sumarPromedioQ2(this.value);"  name="ExQ2[]" id="ExQ2'.$cont.'"  value="0" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" class="form-control" readonly  name="Q2[]"  id="Q2'.$cont.'"  value="0" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" readonly class="form-control" id="P'.$cont.'" name="promedio[]"  value="0" min="0" max="10" step="0.01"></td>

                      </tr>
                      ';
                 
        }
        echo'<input type="hidden" id="num" value="'.$cont.'">';
    }

}else{
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
                        <td> <input type="number" required class="form-control" onchange="sumarPromedioQ1(this.value);" name="EP1Q1[]" id="P1Q1'.$cont.'" value="'.$es["P1Q1"].'" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" required class="form-control" onchange="sumarPromedioQ1(this.value);" name="EP2Q1[]" id="P2Q1'.$cont.'"  value="'.$es["P2Q1"].'" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" required class="form-control"  onchange="sumarPromedioQ1(this.value);" name="EP3Q1[]" id="P3Q1'.$cont.'" value="'.$es["P3Q1"].'" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" required class="form-control" onchange="sumarPromedioQ1(this.value);" name="EExQ1[]" id="ExQ1'.$cont.'" value="'.$es["EXQ1"].'" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" readonly class="form-control" name="EQ1[]" id="Q1'.$cont.'" value="'.$es["Q1"].'" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" class="form-control" onchange="sumarPromedioQ2(this.value);" name="EP1Q2[]" id="P1Q2'.$cont.'" value="'.$es["P1Q2"].'" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" class="form-control" onchange="sumarPromedioQ2(this.value);" name="EP2Q2[]" id="P2Q2'.$cont.'"  value="'.$es["P2Q2"].'" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" class="form-control" onchange="sumarPromedioQ2(this.value);" name="EP3Q2[]" id="P3Q2'.$cont.'"  value="'.$es["P3Q2"].'" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" class="form-control" onchange="sumarPromedioQ2(this.value);"  name="EExQ2[]" id="ExQ2'.$cont.'"  value="'.$es["EXQ2"].'" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" class="form-control" readonly  name="EQ2[]"  id="Q2'.$cont.'"  value="'.$es["Q2"].'" min="0" max="10" step="0.01"></td>
                        <td> <input type="number" readonly class="form-control" id="P'.$cont.'" name="Epromedio[]"  value="'.$es["NF"].'" min="0" max="10" step="0.01"></td>

                      </tr>
                      ';
                 
        }
        echo'<input type="hidden" id="num" value="'.$cont.'">';
    }
}
?>
                        </tbody>

                    </table>
               <?php   
                 $crear = new ControladorNotas();
    $crear->ctrCrearNotas();
    $editar = new ControladorNotas();
    $editar->ctrEditarNotas();
    ?>
                    </form>
            </div>

        </div>


    </section>
</div>