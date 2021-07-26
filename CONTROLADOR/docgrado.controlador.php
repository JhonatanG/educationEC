<?php
class ControladorDocg{
  /*=============================================
MOSTRAR INFORMACION
=============================================*/
static public function ctrMostrarDocg($item,$valor){
  $tabla="edu_tab_grad_docente";
  $respuesta=ModeloDocg::mdlMostrarDocg($tabla,$item,$valor);
  return $respuesta;
}
/*=============================================
LISTAR GRADO CON PARALELO
=============================================*/
static public function ctrListarGradosParalelos(){
  $respuesta=ModeloDocg::mdlListarGradoParalelo();
  //var_dump($respuesta);
  return $respuesta;
}
/*=============================================
GUARDAR INFORMACION
=============================================*/
static public function ctrCrearDocg(){

  if(isset($_POST["idDocenteD"])){
      if(is_array($_POST["idGrados"]) && isset($_POST["idGrados"])){
      $tabla="edu_tab_grad_docente";  
      $idGrados=$_POST["idGrados"];
      $idMaterias=$_POST["idMateria"];


      foreach ($idGrados as $value) {
        foreach ($idMaterias as $v){
        $datos=array("idDocenteD" => $_POST["idDocenteD"]
        ,"idGrados"=>$value,"idMaterias"=>$v);
        $respuesta=ModeloDocg::mdlMostrarRepetidos($tabla,$datos);
       // var_dump($respuesta);
        }
    }
      if(empty($respuesta)){
        foreach ($idGrados as $value) {
          foreach ($idMaterias as $v){
          $datos=array("idDocenteD" => $_POST["idDocenteD"]
          ,"idGrados"=>$value,"observacion"=>$_POST["nuevaObservacion"],
          "estado"=>$_POST["nuevoEstado"],"idMaterias"=>$v);
          $respuesta=ModeloDocg::mdlCrearDocg($tabla,$datos);
          //var_dump($respuesta);
        }
      }
      if ($respuesta="ok"){
          echo'<script>
          Swal.fire({
            icon: "success",
            title: "¡La relación docente-grado ha sido guardado correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm:false
          }).then(function(result){
              if (result.value) {
              window.location = "'.SERVERURL.'docgrado/";
              }
          });
          
          </script>';
      }else {
          echo'<script>
          Swal.fire({
            icon: "error",
            title: "¡La relación docente-grado NO ha sido guardado correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm:false
          }).then(function(result){
              if (result.value) {
              window.location = "'.SERVERURL.'docgrado/";
              }
          });
          
          </script>';
      }
    }else{
      echo'<script>
      Swal.fire({
        icon: "error",
        title: "¡Ya existe relación entre el docente con el grado!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm:false
      }).then(function(result){
          if (result.value) {
          window.location = "'.SERVERURL.'docgrado/";
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
          window.location = "'.SERVERURL.'docgrado/";
          }
      });
      
      </script>';
  }
  }

}
/*=============================================
ELIMINAR INFORMACION
=============================================*/
static public function ctrEliminarDocgrados(){
  if(isset($_GET["idDocgrado"])){
      $tabla="edu_tab_grad_docente";
      $datos=$_GET["idDocgrado"];
      $respuesta=ModeloDocg::mdlEliminarDocgrados($tabla,$datos);
  if($respuesta=="ok"){
      echo'<script>
          Swal.fire({
            icon: "success",
            title: "La relación docente-grado ha sido borrado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
          }).then((result)=>{
            if(result.value){
              window.location="'.SERVERURL.'docgrado/";
      
            }
          });
          
          </script>';
  }else{
      echo'<script>
          Swal.fire({
            icon: "error",
            title: "¡No se pudo borrar!",
            text: "Puede estar la informacion relaciona con las demás partes del sistema",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm:false
          }).then((result)=>{
            if(result.value){
              window.location="'.SERVERURL.'docgrado/";
            }
          });
          
          </script>';
  }

  }
}
/*=============================================
EDITAR Informacion
=============================================*/
static public function ctrEditarDocgrado(){
  if(isset($_POST["editarObservacion"])){
      if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarObservacion"])){
          $tabla ="edu_tab_grad_docente";
          $datos=array(
                  "id"=>$_POST["editarDocgrado"],
                  "observacion"=>$_POST["editarObservacion"]);
          $respuesta=ModeloDocg::mdlEditarDocgrado($tabla,$datos);

          if($respuesta=="ok"){
              echo'<script>
          Swal.fire({
            icon: "success",
            title: "¡Ha sido modificado correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm:false
          }).then(function(result){
              if (result.value) {
              window.location = "'.SERVERURL.'docgrado/";
              }
          });
          
          </script>';
          }else{
            echo'<script>
            Swal.fire({
              icon: "error",
              title: "¡No se pudo editar la infomación, intente nuevamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm:false
            }).then((result)=>{
              if(result.value){
                window.location="'.SERVERURL.'docgrado/";
        
              }
            });
            
            </script>';
          }
          


      }else{
          echo'<script>
          Swal.fire({
            icon: "error",
            title: "¡No se admite caracteres especiales, intente nuevamente!",
            text: "Ejemplo (Primero)",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm:false
          }).then((result)=>{
            if(result.value){
              window.location="'.SERVERURL.'docgrado/";
      
            }
          });
          
          </script>';
      }


  }


}
}