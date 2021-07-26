<?php

class ControladorNotas{
           /*=============================================
LISTAR ESTUDIANTE
	=============================================*/
   static public function ctrListaEstudiante(){
    if(isset($_POST["idGrado"]) && isset($_POST["idMateria"])){
  
       $datos=array(
         "idGParalelo"=>$_POST["idGrado"],
         "idDocente"=>$_POST["idDocenteG"],
         "idMateria"=>$_POST["idMateria"]
       );
       $respuestaLista = ModeloNotas::mdlListaEstudiantes($datos);
       return $respuestaLista;
    
       }

       
     }
                /*=============================================
LISTAR NOTAS ESTUDIANTE
	=============================================*/
   static public function ctrListaNotas(){
    if(isset($_POST["idGrado"]) && isset($_POST["idMateria"])){
  
       $datos=array(
         "idGParalelo"=>$_POST["idGrado"],
         "idDocente"=>$_POST["idDocenteG"],
         "idMateria"=>$_POST["idMateria"]
       );
       $respuestaLista = ModeloNotas::mdlListaNotas($datos);
       return $respuestaLista;
    
       }

       
     }
       /*=============================================
GUARDAR INFORMACION
=============================================*/
static public function ctrCrearNotas(){
  //var_dump("asfsafasfasfasfdwerSSFAS");
     if(isset($_POST["idGdoc"])){
         if(isset($_POST["idEstudiante"])){
         $tabla="edu_tab_notas";  
         $idGdoc=$_POST["idGdoc"];
         $idEstudiante=$_POST["idEstudiante"];
         $P1Q1=$_POST["P1Q1"];
         $P2Q1=$_POST["P2Q1"];
         $P3Q1=$_POST["P3Q1"];
         $EXQ1=$_POST["ExQ1"];
         $Q1=$_POST["Q1"];
         $P1Q2=$_POST["P1Q2"];
         $P2Q2=$_POST["P2Q2"];
         $P3Q2=$_POST["P3Q2"];
         $EXQ2=$_POST["ExQ2"];
         $Q2=$_POST["Q2"];
         $PT=$_POST["promedio"];

      /*  $datos=array("idGdocente"=>$_POST["idGdoc"] ,"idEstudiante"=>$_POST["idEstudiante"],
        "fecha"=>$_POST["nuevafecha"],"asistencia"=>$_POST["nuevaAsistencia"]);
         
         $respuesta=ModeloAsistencia::mdlCrearAsistencia($tabla,$datos);*/
  
           for ($i = 0; $i<count($idEstudiante);$i++) {
             $estu = $idEstudiante[$i];
             $P1Q11=$P1Q1[$i];
         $P2Q11=$P2Q1[$i];
         $P3Q11=$P3Q1[$i];
         $EXQ11=$EXQ1[$i];
         $Q11=$Q1[$i];
         $P1Q22=$P1Q2[$i];
         $P2Q22=$P2Q2[$i];
         $P3Q22=$P3Q2[$i];
         $EXQ22=$EXQ2[$i];
         $Q22=$Q2[$i];
         $PTT=$PT[$i];

             $datos=array("idGdocente" => $_POST["idGdoc"]
             ,"idEstudiante"=>$estu,"P1Q1"=>$P1Q11,"P2Q1"=>$P2Q11,"P3Q1"=>$P3Q11,"EXQ1"=>$EXQ11,"Q1"=>$Q11
            ,"P1Q2"=>$P1Q22,"P2Q2"=>$P2Q22,"P3Q2"=>$P3Q22,"EXQ2"=>$EXQ22,"Q2"=>$Q22,
            "PT"=>$PTT);
            // var_dump($datos);
            $respuesta=ModeloNotas::mdlCrearNotas($tabla,$datos);
         //   var_dump($respuesta);
             
                 
               }
            
         
        if($respuesta=="ok"){
             echo'<script>
             Swal.fire({
               icon: "success",
               title: "¡Se ha guardado correctamente!",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConfirm:false
             }).then(function(result){
                 if (result.value) {
                 window.location = "'.SERVERURL.'notas/";
                 }
             });
             
             </script>';
         }
  
     }else{
         echo'<script>
         Swal.fire({
           icon: "error",
           title: "¡Debe seleccionar los campos!",
           showConfirmButton: true,
           confirmButtonText: "Cerrar",
           closeOnConfirm:false
         }).then(function(result){
             if (result.value) {
             window.location = "'.SERVERURL.'notas/";
             }
         });
         
         </script>';
     }
     }
  
  }
  /*=============================================
EDITAR INFORMACION
=============================================*/
static public function ctrEditarNotas(){
  //var_dump("asfsafasfasfasfdwerSSFAS");
     if(isset($_POST["EidGdoc"])){
         if(isset($_POST["EidEstudiante"])){
         $tabla="edu_tab_notas";  
         $idGdoc=$_POST["EidGdoc"];
         $idEstudiante=$_POST["EidEstudiante"];
         $P1Q1=$_POST["EP1Q1"];
         $P2Q1=$_POST["EP2Q1"];
         $P3Q1=$_POST["EP3Q1"];
         $EXQ1=$_POST["EExQ1"];
         $Q1=$_POST["EQ1"];
         $P1Q2=$_POST["EP1Q2"];
         $P2Q2=$_POST["EP2Q2"];
         $P3Q2=$_POST["EP3Q2"];
         $EXQ2=$_POST["EExQ2"];
         $Q2=$_POST["EQ2"];
         $PT=$_POST["Epromedio"];
         $idNot=$_POST["EidNota"];
         

      /*  $datos=array("idGdocente"=>$_POST["idGdoc"] ,"idEstudiante"=>$_POST["idEstudiante"],
        "fecha"=>$_POST["nuevafecha"],"asistencia"=>$_POST["nuevaAsistencia"]);
         
         $respuesta=ModeloAsistencia::mdlCrearAsistencia($tabla,$datos);*/
  
           for ($i = 0; $i<count($idEstudiante);$i++) {
             $estu = $idEstudiante[$i];
             $P1Q11=$P1Q1[$i];
         $P2Q11=$P2Q1[$i];
         $P3Q11=$P3Q1[$i];
         $EXQ11=$EXQ1[$i];
         $Q11=$Q1[$i];
         $P1Q22=$P1Q2[$i];
         $P2Q22=$P2Q2[$i];
         $P3Q22=$P3Q2[$i];
         $EXQ22=$EXQ2[$i];
         $Q22=$Q2[$i];
         $PTT=$PT[$i];
         $id=$idNot[$i];

             $datos=array("idGdocente" => $_POST["EidGdoc"]
             ,"idEstudiante"=>$estu,"P1Q1"=>$P1Q11,"P2Q1"=>$P2Q11,"P3Q1"=>$P3Q11,"EXQ1"=>$EXQ11,"Q1"=>$Q11
            ,"P1Q2"=>$P1Q22,"P2Q2"=>$P2Q22,"P3Q2"=>$P3Q22,"EXQ2"=>$EXQ22,"Q2"=>$Q22,
            "PT"=>$PTT,"idNota"=>$id);
             var_dump($datos);
            $respuesta=ModeloNotas::mdlEditarNotas($tabla,$datos);
            //var_dump($respuesta);
             
                 
               }
            
         
       if($respuesta=="ok"){
             echo'<script>
             Swal.fire({
               icon: "success",
               title: "¡Se ha guardado correctamente!",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConfirm:false
             }).then(function(result){
                 if (result.value) {
                 window.location = "'.SERVERURL.'notas/";
                 }
             });
             
             </script>';
         }
  
     }else{
         echo'<script>
         Swal.fire({
           icon: "error",
           title: "¡Debe seleccionar los campos!",
           showConfirmButton: true,
           confirmButtonText: "Cerrar",
           closeOnConfirm:false
         }).then(function(result){
             if (result.value) {
             window.location = "'.SERVERURL.'notas/";
             }
         });
         
         </script>';
     }
     }
  
  }  
    /*=============================================
REPORTE NOTAS PARA CADA ESTUDIANTE
	=============================================*/
  static public function ctrReportNotEstud($valor){
    //  var_dump($datos);
    $respuesta = ModeloNotas::mdlReportNotasEstud($valor);
    return $respuesta;  
 }
}



