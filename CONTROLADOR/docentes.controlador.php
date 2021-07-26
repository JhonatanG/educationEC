<?php
class ControladorDocentes{
  /*========================================================================
LISTAR DOCENTES
==========================================================================*/
  static public function ctrListarDocentes(){
    $tabla="edu_tab_docentes";
    $respuesta=ModeloDocentes::mdlListarDocente($tabla);
    return $respuesta;
  }
/*========================================================================
CONTROLO DE INGRESO DE USUARIOS
==========================================================================*/
    public function ctrIngresoDocente(){
        if(isset($_POST["usuario"])){
            if($_POST["usuario"][0]=="D" && $_POST["usuario"][1]=="-"){
            if(preg_match('/^[a-zA-Z0-9-]+$/',$_POST["usuario"])){
                $tabla="edu_tab_docentes";
                $item="usuario";
                $valor=$_POST["usuario"];
                $respuesta=ModeloDocentes::mdlMostrarDocentes($tabla,$item,$valor);
                if($respuesta["usuario"]==$_POST["usuario"] 
                && password_verify($_POST["password"],$respuesta["password"])){ 
                  if($respuesta["estado"]==1){
                 $_SESSION["iniciarSesionD"]="ok";
                  $_SESSION["id"]=$respuesta["id"];
                   $_SESSION["nombre"]=$respuesta["nombres"];
                   $_SESSION["apellidos"]=$respuesta["apellidos"];
                   $_SESSION["foto"]=$respuesta["foto"];
                   $_SESSION["usuario"]=$respuesta["usuario"];
                   $_SESSION["rol"]=$respuesta["rol"];
    
                    echo '<script>
                    window.location="'.SERVERURL.'inicio/"
                    </script>';
                  }else{
                    echo'<br><div class="alert alert-danger">Tú usuario no está activado. Comunicate con el Administrador.</div>';
                    
                  }
                  }else{
                    
                    echo'<br><div class="alert alert-danger">Contraseña o Usuario Incorrecto, vuelve a intentarlo</div>';
                  }
    
            }
        }
        }
    
    
    }
/*========================================================================
CONTROLADOR DE CREAR USUARIOS
==========================================================================*/
static public function ctrCrearDocentes(){
    if(isset($_POST["nuevoUsuarioD"])){
        if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoNombreD"])&&
        preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoApellidoD"])&&
        preg_match('/^[a-zA-Z0-9-]+$/', $_POST["nuevoUsuarioD"])){
      /*=============================================
      =          VALIDAR IMAGEN  =
      =============================================*/
      $ruta="";
      if (isset($_FILES["nuevaFotoD"]["tmp_name"])){
      
       list($ancho, $alto)= getimagesize($_FILES["nuevaFotoD"]["tmp_name"]);
       $nuevoAncho=500;
       $nuevoAlto=500;
      
       $directorio = "VISTA/img/docentes/".$_POST["nuevoUsuarioD"];
       mkdir($directorio,0755);
      /*========================================================================
      = DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP =
      ==========================================================================*/
      
          if($_FILES["nuevaFotoD"]["type"]=="image/jpeg")
          {
          /*=============================================
          =  GUARDAMOS LA IMAGEN EN EL DIRECTORIO  =
          =============================================*/
              $aleatorio = mt_rand(100,999);
              $ruta="VISTA/img/docentes/".$_POST["nuevoUsuarioD"]."/".$aleatorio.".jpg";
              
              $origen = imagecreatefromjpeg($_FILES["nuevaFotoD"]["tmp_name"]);
              $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
              /*imagecopyresized(imagen-destino,donde-viene-origen,corte-nivel-X-DESTINO
              ,corte-nivel-Y-DESTINO,corte-nivel-X-ORIGE,corte-nivel-Y-origen,
              ANCHO-Nuevo,ALTO-Nuevo,ancho-ORigen,Alto-Origen);*/
              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
      
              imagejpeg($destino,$ruta);
      
          }
          if($_FILES["nuevaFotoD"]["type"]=="image/png")
          {
              /*=============================================
              =  GUARDAMOS LA IMAGEN EN EL DIRECTORIO  =
              =============================================*/
              $aleatorio = mt_rand(100,999);
              $ruta="VISTA/img/docentes/".$_POST["nuevoUsuarioD"]."/".$aleatorio.".png";
        
              $origen = imagecreatefrompng($_FILES["nuevaFotoD"]["tmp_name"]);
              $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
              /*imagecopyresized(imagen-destino,donde-viene-origen,corte-nivel-X-DESTINO
              ,corte-nivel-Y-DESTINO,corte-nivel-X-ORIGE,corte-nivel-Y-origen,
              ANCHO-Nuevo,ALTO-Nuevo,ancho-ORigen,Alto-Origen);*/
              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
      
              imagepng($destino,$ruta);
      
          }
      }
      $contra=$_POST["nuevaPasswordD"];
      $encriptar=password_hash($contra,PASSWORD_DEFAULT );
      //password hash

       $tabla = "edu_tab_docentes";
        $datos = array("cedula"=>$_POST["nuevaCedulaD"],
        "nombres"=>$_POST["nuevoNombreD"],
        "apellidos"=>$_POST["nuevoApellidoD"],
        "genero"=>$_POST["nuevoGeneroD"],
        "email"=>$_POST["nuevoEmailD"],
        "telefono"=>$_POST["nuevoTelefonoD"],
        "direccion"=>$_POST["nuevaDireccionD"], 
        "fecha"=>$_POST["nuevaFechaD"],
        "usuario"=>$_POST["nuevoUsuarioD"],
        "password"=>$encriptar,
         "rol"=>$_POST["nuevoRolD"],
          "foto"=>$ruta);

      $respuesta=ModeloDocentes::mdlCrearDocente($tabla,$datos);
      if($respuesta=="ok"){
        echo'<script>
        Swal.fire({
          icon: "success",
          title: "¡El/La docente ha sido guardado correctamente!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm:false
        }).then((result)=>{
          if(result.value){
            window.location="'.SERVERURL.'docente/";
  
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
            window.location="'.SERVERURL.'docente/";
    
          }
        });
        
        </script>';
      }

        
        }else{
          echo'<script>
          Swal.fire({
            icon: "error",
            title: "¡El usuario no puede llevar caracteres especiales!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm:false
          }).then((result)=>{
            if(result.value){
              window.location="'.SERVERURL.'docente/";
      
            }
          });
          
          </script>';
        }
      }
}
/*========================================================================
CONTROLO DE MOSTRAR DOCENTES
==========================================================================*/
static public function ctrMostrarDocentes($item,$valor){
  $tabla="edu_tab_docentes";
  $respuesta = ModeloDocentes::mdlMostrarDocentes($tabla,$item,$valor);
  return $respuesta;
}
/*========================================================================
CONTROL EDITAR DOCENTES REGISTRADOS EN LA BASE DE DATOS               
==========================================================================*/
public function ctrEditarDocente(){
  if(isset($_POST["editarUsuarioD"])){
    if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarNombreD"])&&
    preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarApellidoD"])&&
    preg_match('/^[a-zA-Z0-9-]+$/', $_POST["editarUsuarioD"])){

      $ruta=$_POST["fotoActual"];
      if (isset($_FILES["editarFotoD"]["tmp_name"]) && !empty($_FILES["editarFotoD"]["tmp_name"])){
        list($ancho, $alto)= getimagesize($_FILES["editarFotoD"]["tmp_name"]);
        $nuevoAncho=500;
        $nuevoAlto=500;
       
        $directorio = "VISTA/img/docentes/".$_POST["editarUsuarioD"];

        
        /*========================================================================
           PRIMERO PREGUNTEMOS SI EXISTE OTRA IMAGEN EN LA BASE DE DATOS    
       ==========================================================================*/
       if(!empty($_POST["fotoActual"])){
          unlink($_POST["fotoActual"]);
       }else{
        mkdir($directorio,0755);
       }


       /*========================================================================
       = DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP =
       ==========================================================================*/
       
         if($_FILES["editarFotoD"]["type"]=="image/jpeg")
           {
           /*=============================================
           =  GUARDAMOS LA IMAGEN EN EL DIRECTORIO  =
           =============================================*/
               $aleatorio = mt_rand(100,999);
                $ruta="VISTA/img/docentes/".$_POST["editarUsuarioD"]."/".$aleatorio.".jpg";

               $origen = imagecreatefromjpeg($_FILES["editarFotoD"]["tmp_name"]);
               $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
               /*imagecopyresized(imagen-destino,donde-viene-origen,corte-nivel-X-DESTINO
               ,corte-nivel-Y-DESTINO,corte-nivel-X-ORIGE,corte-nivel-Y-origen,
               ANCHO-Nuevo,ALTO-Nuevo,ancho-ORigen,Alto-Origen);*/
               imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
       
               imagejpeg($destino,$ruta);
       
           }
           if($_FILES["editarFotoD"]["type"]=="image/png")
           {
               /*=============================================
               =  GUARDAMOS LA IMAGEN EN EL DIRECTORIO  =
               =============================================*/
               $aleatorio = mt_rand(100,999);
             
              $ruta="VISTA/img/docentes/".$_POST["editarUsuarioD"]."/".$aleatorio.".png";

               $origen = imagecreatefrompng($_FILES["editarFotoD"]["tmp_name"]);
               $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
               /*imagecopyresized(imagen-destino,donde-viene-origen,corte-nivel-X-DESTINO
               ,corte-nivel-Y-DESTINO,corte-nivel-X-ORIGE,corte-nivel-Y-origen,
               ANCHO-Nuevo,ALTO-Nuevo,ancho-ORigen,Alto-Origen);*/
               imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
       
               imagepng($destino,$ruta);
       
           }
       }
    
    $tabla = "edu_tab_docentes";
    if($_POST["editarPassword"]!=""){
      $contra=$_POST["editarPassword"];
      $encriptar=password_hash($contra,PASSWORD_DEFAULT );

    }else{
      $encriptar=$_POST["passwordActual"];
    }
    $datos = array(
    "email"=>$_POST["editarEmailD"],
    "telefono"=>$_POST["editarTelefonoD"],
    "direccion"=>$_POST["editarDireccionD"],
    "usuario"=>$_POST["editarUsuarioD"],
    "password"=>$encriptar,
      "foto"=>$ruta);
    
    $respuesta=ModeloDocentes::mdlEditarDocente($tabla,$datos);
    if($respuesta=="ok"){
      echo'<script>
      Swal.fire({
        icon: "success",
        title: "¡El/La docente ha sido modificado correctamente!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm:false
      }).then((result)=>{
        if(result.value){
          window.location="'.SERVERURL.'docente/";

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
          window.location="'.SERVERURL.'docente/";
  
        }
      });
      
      </script>';

    
  }

}
}
static public function ctrBorrarDocente(){

  if(isset($_GET["idDocente"])){

    $tabla ="edu_tab_docentes";
    $datos = $_GET["idDocente"];

    if($_GET["fotoDocente"] != ""){
      unlink($_GET["fotoDocente"]);
      rmdir('VISTA/img/docentes/'.$_GET["usuario"]);
    }

    $respuesta = ModeloDocentes::mdlBorrarDocente($tabla, $datos);

    if($respuesta == "ok"){

      echo'<script>

      Swal.fire({
          icon: "success",
          title: "El/La docente ha sido borrado correctamente",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
          }).then(function(result){
              if (result.value) {

              window.location = "'.SERVERURL.'docente/";

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
              window.location="'.SERVERURL.'docente/";
            }
          });
          
          </script>';
  }

  }

}

}