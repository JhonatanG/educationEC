<?php

class ControladorAsistencia{
     /*=============================================
LISTA GRADOS DOCENTES
	=============================================*/
  static public function ctrListaGradosDocente($item,$valor){
    //  $item="id_docente";
     $respuesta=ModeloAsistencia::mdlListaGradosDocente($item,$valor);
    // var_dump($respuesta);
     return $respuesta;
  }
 /* static public function ctrListaMateriasDocente($item,$item2,$valor,$valor2){
      $respuesta=ModeloAsistencia::mdlListaMateriasDocente($item,$item2,$valor,$valor2);
   
      return $respuesta;     
  }*/
  static public function ctrListaMDoc($item,$valor,$item2,$valor2){
     $respuesta=ModeloAsistencia::mdlListaMDocente($item,$valor,$item2,$valor2);
    //var_dump($respuesta);
     return $respuesta;
  }
      /*=============================================
LISTAR CABECERA
	=============================================*/
  static public function ctrListaCabecera(){
   if(isset($_POST["idGrado"]) && isset($_POST["idMateria"])){
      $datos=array(
        "idGParalelo"=>$_POST["idGrado"],
        "idDocente"=>$_POST["idDocenteG"],
        "idMateria"=>$_POST["idMateria"]
      );
      $respuesta = ModeloAsistencia::mdlCabeceraAsistencia($datos);
      //var_dump($respuesta);
       return $respuesta;
      
    }
  
 }
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
         $respuestaLista = ModeloAsistencia::mdlListaEstudiantes($datos);
         foreach($respuestaLista as $value)
         {
            $id=$value["gdoc"];
            $datosExistente = array(
             "fecha"=>$_POST["fecha"],
             "idGdocente"=>$id
            );
            $respuestaDatosExis=ModeloAsistencia::mdlAsistenciaExistente($datosExistente);

            if(empty($respuestaDatosExis)){
               return $respuestaLista;
            }else{
               echo'<script>
         Swal.fire({
           icon: "error",
           title: "¡Ya se encuentra registrada la asistencia!",
           showConfirmButton: true,
           confirmButtonText: "Cerrar",
           closeOnConfirm:false
         }).then(function(result){
             if (result.value) {
             window.location = "'.SERVERURL.'asistencia/";
             }
         });
         
         </script>';
            }
         }

         
       }
     
    }
    /*=============================================
GUARDAR INFORMACION
=============================================*/
static public function ctrCrearAsistencia(){
//var_dump("asfsafasfasfasfdwerSSFAS");
   if(isset($_POST["idGdoc"])){
       if(isset($_POST["idEstudiante"])){
       $tabla="edu_tab_asistencias";  
       $idGdoc=$_POST["idGdoc"];
       $idEstudiante=$_POST["idEstudiante"];
       $fecha=$_POST["nuevafecha"];
       $asistencia=$_POST["nuevaAsistencia"];
    /*  $datos=array("idGdocente"=>$_POST["idGdoc"] ,"idEstudiante"=>$_POST["idEstudiante"],
      "fecha"=>$_POST["nuevafecha"],"asistencia"=>$_POST["nuevaAsistencia"]);
       
       $respuesta=ModeloAsistencia::mdlCrearAsistencia($tabla,$datos);*/

         for ($i = 0; $i<count($idEstudiante);$i++) {
           $estu = $idEstudiante[$i];
           $asis = $asistencia[$i];
           $datos=array("idGdocente" => $_POST["idGdoc"]
           ,"idEstudiante"=>$estu,"fecha"=>$_POST["nuevafecha"],"asistencia"=>$asis);
          // var_dump($datos);
           $respuesta=ModeloAsistencia::mdlCrearAsistencia($tabla,$datos);
         //  var_dump($respuesta);
           
               
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
               window.location = "'.SERVERURL.'asistencia/";
               }
           });
           
           </script>';
       }else{
         echo'<script>
         Swal.fire({
           icon: "error",
           title: "¡No se pudo guardar!",
           showConfirmButton: true,
           confirmButtonText: "Cerrar",
           closeOnConfirm:false
         }).then(function(result){
             if (result.value) {
             window.location = "'.SERVERURL.'asistencia/";
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
           window.location = "'.SERVERURL.'asistencia/";
           }
       });
       
       </script>';
   }
   }

}
/*=============================================
DEVUELVE EL ID DEL DOCENTE
=============================================*/
static public function ctrIdDocente(){
  if(isset($_POST["idDocenteA"])){
    $tabla="edu_tab_docentes";
    $datos=array("idDocente"=>$_POST["idDocenteA"]);
    $respuesta=ModeloAsistencia::mdlIdDocente($tabla,$datos);
    return $respuesta;
  }

}
/*=============================================
LISTA ESTUDIANTES POR FECHA
=============================================*/
static public function ctrListaEstuFec(){
  if(isset($_POST["idGrado"]) && isset($_POST["idMateria"])){
      $fecha=$_POST["fecha"];
      $fechaFor = date("Y-m-d",strtotime($fecha));
     // var_dump($fechaFor);
     $datos=array(
       "idGParalelo"=>$_POST["idGrado"],
       "idDocente"=>$_POST["idDocenteG"],
       "idMateria"=>$_POST["idMateria"],
       "fecha"=> $fechaFor
     );
   //  var_dump($datos);
   $respuestaLista = ModeloAsistencia::mdlListaEstuFec($datos);
   if(empty($respuestaLista)){
    echo'<script>
    Swal.fire({
      icon: "error",
      title: "¡El docente aún no registra la asistencia!",
      showConfirmButton: true,
      confirmButtonText: "Cerrar",
      closeOnConfirm:false
    }).then(function(result){
        if (result.value) {
        window.location = "'.SERVERURL.'editarAsistencia/";
        }
    });
    
    </script>';

   }else{

    return $respuestaLista;
   }  
   }
 
}
/*=============================================
MOSTRAR TABLA ASISTENCIA
=============================================*/
static public function ctrMostrarAsistencia($item,$valor){
  $tabla="edu_tab_asistencias";
  $respuesta=ModeloAsistencia::mdlMostrarAsistencia($tabla,$item,$valor);
  return $respuesta;
}
/*=============================================
EDITAR
=============================================*/
static public function ctrEditarAsistencia(){
  if(isset($_POST["editarAsistencia"])){
    $tabla="edu_tab_asistencias" ;
    $datos=array("idAsistencia"=>$_POST["idAsistencia"],"asistencia"=>$_POST["editarAsistencia"]);
    $respuesta=ModeloAsistencia::mdlEditarAsistencia($tabla,$datos);
    if($respuesta=="ok"){
      echo'<script>
      Swal.fire({
        icon: "success",
        title: "¡Se ha guardado correctamente!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm:false
      })
      
      </script>';
    }

  }


}
 /*=============================================
REPORTE ASISTENCIA
	=============================================*/
 static public function ctrReporteAsistencia(){
  if(isset($_POST["idGrado"]) && isset($_POST["idMateria"])){
   $datos=array(
     "idGParalelo"=>$_POST["idGrado"],
     "idDocente"=>$_POST["idDocenteG"],
     "idMateria"=>$_POST["idMateria"]
   );
 //  var_dump($datos);
 $respuesta = ModeloAsistencia::mdlReporteAsistencia($datos);
 return $respuesta;

}

 }
  /*=============================================
REPORTE ASISTENCIA PARA CADA ESTUDIANTE
	=============================================*/
  static public function ctrReportAsisEstud($valor){
   //  var_dump($datos);
   $respuesta = ModeloAsistencia::mdlReportAsisEstud($valor);
   return $respuesta;  
}

        /*=============================================
OBTIENE ESTUDIANTES POR REPRESENTANTE
	=============================================*/

  static public function ctrEstuRepre($valor){
    $respuesta = ModeloAsistencia::mdlEstuRepre($valor);
    return $respuesta;
  }

}