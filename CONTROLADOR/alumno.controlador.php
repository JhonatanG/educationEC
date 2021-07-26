<?php
class ControladorAlumnos{
  static public function ctrMostrarAlumnos($item,$valor){
    $tabla="edu_tab_estudiantes";
    $respuesta = ModeloAlumnos::mdlMostrarAlumnos($tabla,$item,$valor);
    return $respuesta;
  }
  static public function ctrMostrarAlumnoRepresentante($item,$valor){
   // $tabla="edu_tab_estudiantes";
    $respuesta = ModeloAlumnos::mdlMostrarAlumnoRepresentante($item,$valor);
    return $respuesta;
  }
/*========================================================================
CONTROLO DE INGRESO
==========================================================================*/
public function ctrIngresoEstudiante(){
  if(isset($_POST["usuario"])){
      if($_POST["usuario"][0]=="E" && $_POST["usuario"][1]=="-"){
      if(preg_match('/^[a-zA-Z0-9-]+$/',$_POST["usuario"])){
          $tabla="edu_tab_estudiantes";
          $item="usuario";
          $valor=$_POST["usuario"];
          $respuesta=ModeloAlumnos::mdlMostrarAlumnos($tabla,$item,$valor);
          if($respuesta["usuario"]==$_POST["usuario"] 
          && password_verify($_POST["password"],$respuesta["password"])){ 
     
           $_SESSION["iniciarSesionE"]="ok";
            $_SESSION["id"]=$respuesta["id"];
             $_SESSION["nombre"]=$respuesta["nombres"];
             $_SESSION["apellidos"]=$respuesta["apellidos"];
             $_SESSION["usuario"]=$respuesta["usuario"];
             $_SESSION["rol"]=$respuesta["rol"];

              echo '<script>
              window.location="'.SERVERURL.'inicio/"
              </script>';
           
            }else{
              
              echo'<br><div class="alert alert-danger">Contraseña o Usuario Incorrecto, vuelve a intentarlo</div>';
            }

      }
  }
  }


}
static public function ctrCrearAlumno(){
    if(isset($_POST["nuevoNombreE"])){
        if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoNombreE"])&&
        preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoApellidoE"])){
          $contra=$_POST["nuevaPasswordE"];
          $encriptar=password_hash($contra,PASSWORD_DEFAULT );
       $tabla = "edu_tab_estudiantes";     
        $datos = array("cedula"=>$_POST["nuevaCedulaE"],
        "nombres"=>$_POST["nuevoNombreE"],
        "apellidos"=>$_POST["nuevoApellidoE"],
        "genero"=>$_POST["nuevoGeneroE"],
        "email"=>$_POST["nuevoEmailE"],
        "telefono"=>$_POST["nuevoTelefonoE"],
        "direccion"=>$_POST["nuevaDireccionE"],
        "fecha"=>$_POST["nuevaFechaE"],
        "representante"=>$_POST["nuevoRepresentanteE"],
        "usuario"=>$_POST["nuevoUsuarioE"],
        "password"=>$encriptar,
        "rol"=>$_POST["nuevoRolE"]);
  

      $respuesta=ModeloAlumnos::mdlCrearAlumno($tabla,$datos);
    
     
      if($respuesta=="ok"){
        echo'<script>
        Swal.fire({
          icon: "success",
          title: "¡El/La estudiante ha sido guardado correctamente!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm:false
        }).then((result)=>{
          if(result.value){
            window.location="'.SERVERURL.'alumnos/";
  
          }
        });
        
        </script>';
      }else{
        echo'<script>
        Swal.fire({
          icon: "error",
          title: "¡No se pudo guardar, intente nuevamente!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm:false
        }).then((result)=>{
          if(result.value){
            window.location="'.SERVERURL.'alumnos/";
    
          }
        });
        
        </script>';
      }

        
        }else{
          echo'<script>
          Swal.fire({
            icon: "error",
            title: "¡No puede llevar caracteres especiales!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm:false
          }).then((result)=>{
            if(result.value){
              window.location="'.SERVERURL.'alumnos/";
      
            }
          });
          
          </script>';
        }
      }
}
/*========================================================================
CONTROL EDITAR estudiantes REGISTRADOS EN LA BASE DE DATOS               
==========================================================================*/
public function ctrEditarEstudiante(){
  if(isset($_POST["editarNombreE"])){
    if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarNombreE"])&&
    preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarApellidoE"])){

   $tabla = "edu_tab_estudiantes";
   if($_POST["editarPassword"]!=""){
    $contra=$_POST["editarPassword"];
    $encriptar=password_hash($contra,PASSWORD_DEFAULT );

  }else{
    $encriptar=$_POST["passwordActual"];
  }
    $datos = array(  
      "cedula"=>$_POST["editarCedulaE"],
      "email"=>$_POST["editarEmailE"],
    "telefono"=>$_POST["editarTelefonoE"],
    "direccion"=>$_POST["editarDireccionE"],
    "id_representante"=>$_POST["editarRepresentanteE"],
    "password"=>$encriptar);
        
    $respuesta=ModeloAlumnos::mdlEditarEstudiante($tabla,$datos);
    if($respuesta=="ok"){
      echo'<script>
      Swal.fire({
        icon: "success",
        title: "¡El representante ha sido modificado correctamente!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm:false
      }).then((result)=>{
        if(result.value){
          window.location="'.SERVERURL.'alumnos/";

        }
      });
      
      </script>';
    }
  }else{
      echo'<script>
      Swal.fire({
        icon: "error",
        title: "¡No puede llevar caracteres especiales!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm:false
      }).then((result)=>{
        if(result.value){
          window.location="'.SERVERURL.'alumnos/";
  
        }
      });
      
      </script>';

    
  }

}
}
static public function ctrBorrarEstudiante(){

  if(isset($_GET["idEstudiante"])){

    $tabla ="edu_tab_estudiantes";
    $datos = $_GET["idEstudiante"];

    $respuesta = ModeloAlumnos::mdlBorrarEstudiante($tabla, $datos);

    if($respuesta == "ok"){

      echo'<script>

      Swal.fire({
          icon: "success",
          title: "El estudiante ha sido borrado correctamente",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
          }).then(function(result){
              if (result.value) {

              window.location = "'.SERVERURL.'alumnos/";

              }
            })

      </script>';

    }else{
      echo'<script>
          Swal.fire({
            icon: "error",
            title: "¡No se pudo borrar!",
            text: "Puede estar la información relaciona con las demás partes del sistema",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm:false
          }).then((result)=>{
            if(result.value){
              window.location="'.SERVERURL.'alumnos/";
            }
          });
          
          </script>';
  }

  }

}
}