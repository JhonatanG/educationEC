<?php
class ControladorAnio{
/*=============================================
MOSTRAR INFORMACION
=============================================*/
    static public function ctrMostrarAnio($item,$valor){
        $tabla="edu_tab_periodo";
        $respuesta= ModeloAnio::mdlMostrarAnio($tabla,$item,$valor);
        return $respuesta;
    }
    /*=============================================
Listar iNFORMACION
=============================================*/
static public function ctrListarAnio(){
  $tabla="edu_tab_periodo";
  $respuesta= ModeloAnio::mdlListarAnio($tabla);
  return $respuesta;
}
/*=============================================
CREAR ANIO
=============================================*/
    static public function ctrCrearAnio(){
        if(isset($_POST["nuevoAnio"])){
        if(preg_match('/^[0-9-]+$/', $_POST["nuevoAnio"])){
        $tabla="edu_tab_periodo";
        $datos=array("nombre" => $_POST["nuevoAnio"],"observacion"=>$_POST["nuevaObservacion"]);
        $respuesta=ModeloAnio::mdlCrearAnio($tabla,$datos);
        if($respuesta=="ok"){
            echo'<script>
            Swal.fire({
              icon: "success",
              title: "¡El Año Lectivo ha sido guardado correctamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm:false
            }).then(function(result){
                if (result.value) {
                window.location = "'.SERVERURL.'anioL/";
                }
            });
            
            </script>';
        }
    }else{
            echo'<script>
            Swal.fire({
              icon: "error",
              title: "¡No se admite letras, intente nuevamente!",
              text: "Ejemplo (2020-2021)",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm:false
            }).then((result)=>{
              if(result.value){
                window.location="'.SERVERURL.'anioL/";
        
              }
            });
            
            </script>';
          }
        }


    }

/*=============================================
EDITAR ANIO
=============================================*/
static public function ctrEditarAnio(){
    if(isset($_POST["editarAnio"])){
        if(preg_match('/^[0-9-]+$/', $_POST["editarAnio"])){
            $tabla ="edu_tab_periodo";
            $datos=array("nombre"=>$_POST["editarAnio"],
                    "id"=>$_POST["idAnio"],"observacion"=>$_POST["editarObservacion"]);
            $respuesta=ModeloAnio::mdlEditarAnio($tabla,$datos);

            if($respuesta=="ok"){
                echo'<script>
            Swal.fire({
              icon: "success",
              title: "¡El Año Lectivo ha sido modificado correctamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm:false
            }).then(function(result){
                if (result.value) {
                window.location = "'.SERVERURL.'anioL/";
                }
            });
            
            </script>';
            }
            


        }else{
            echo'<script>
            Swal.fire({
              icon: "error",
              title: "¡No se admite letras, intente nuevamente!",
              text: "Ejemplo (2020-2021)",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm:false
            }).then((result)=>{
              if(result.value){
                window.location="'.SERVERURL.'anioL/";
        
              }
            });
            
            </script>';
        }


    }


}
/*=============================================
ELIMINAR ANIO
=============================================*/
static public function ctrEliminarAnio(){
    if(isset($_GET["idAnio"])){
        $tabla="edu_tab_periodo";
        $datos=$_GET["idAnio"];
        $respuesta=ModeloAnio::mdlEliminarAnio($tabla,$datos);
    if($respuesta=="ok"){
        echo'<script>
            Swal.fire({
              icon: "success",
              title: "El Año Lectivo ha sido borrado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
            }).then((result)=>{
              if(result.value){
                window.location="'.SERVERURL.'anioL/";
        
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
                window.location="'.SERVERURL.'anioL/";
        
              }
            });
            
            </script>';
    }

    }
}
}