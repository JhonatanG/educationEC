<?php
class ControladorUsuarios{
/*========================================================================
CONTROLO DE INGRESO DE USUARIOS
==========================================================================*/
public function ctrIngresoUsuario(){
    if(isset($_POST["usuario"])){
      if($_POST["usuario"][0]!="D" && $_POST["usuario"][1]!="-"){
        if(preg_match('/^[a-zA-Z0-9]+$/',$_POST["usuario"])){
            $tabla="edu_tab_usuarios";
            $item="usuario";
            $valor=$_POST["usuario"];
            $respuesta=ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);
            if($respuesta["usuario"]==$_POST["usuario"] 
            && password_verify($_POST["password"],$respuesta["password"])){ 
                if($respuesta["estado"]==1){
                $_SESSION["iniciarSesion"]="ok";
              $_SESSION["id"]=$respuesta["id"];
               $_SESSION["nombre"]=$respuesta["nombre"];
               $_SESSION["usuario"]=$respuesta["usuario"];
               $_SESSION["foto"]=$respuesta["foto"];
               $_SESSION["rol"]=$respuesta["rol"];
          /*=============================================
               =   REGISTRAR FECHA PARA SABER EL ULTIMO LOGIN  =
               =============================================*/
               date_default_timezone_set("America/Guayaquil");
               $fecha = date('Y-m-d');
               $hora = date('H:i:s');
               $fechaActual=$fecha.' '.$hora;
               $item1="ultimo_login";
               $valor1 = $fechaActual;

               $item2="id";
               $valor2=$respuesta["id"];
               $ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

               if($ultimoLogin == "ok"){
                echo '<script>
                window.location="'.SERVERURL.'inicio/"
                </script>';
                
               }


              }else{
                echo'<br><div class="alert alert-danger">El usuario aún no está activado, Comunicate con el Administrador</div>';
                
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
static public function ctrCrearUsuarios(){
    if(isset($_POST["nuevoUsuario"])){
        if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoNombre"])&&
        preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"])){
      /*=============================================
      =          VALIDAR IMAGEN  =
      =============================================*/
      $ruta="";
      if (isset($_FILES["nuevaFoto"]["tmp_name"])){
       list($ancho, $alto)= getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
       $nuevoAncho=500;
       $nuevoAlto=500;
      
       $directorio = "VISTA/dist/img/usuarios/".$_POST["nuevoUsuario"];
       mkdir($directorio,0755);
      /*========================================================================
      = DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP =
      ==========================================================================*/
      
          if($_FILES["nuevaFoto"]["type"]=="image/jpeg")
          {
          /*=============================================
          =  GUARDAMOS LA IMAGEN EN EL DIRECTORIO  =
          =============================================*/
              $aleatorio = mt_rand(100,999);
              $ruta="VISTA/dist/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
              $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
              $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
              /*imagecopyresized(imagen-destino,donde-viene-origen,corte-nivel-X-DESTINO
              ,corte-nivel-Y-DESTINO,corte-nivel-X-ORIGE,corte-nivel-Y-origen,
              ANCHO-Nuevo,ALTO-Nuevo,ancho-ORigen,Alto-Origen);*/
              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
      
              imagejpeg($destino,$ruta);
      
          }
          if($_FILES["nuevaFoto"]["type"]=="image/png")
          {
              /*=============================================
              =  GUARDAMOS LA IMAGEN EN EL DIRECTORIO  =
              =============================================*/
              $aleatorio = mt_rand(100,999);
              $ruta="VISTA/dist/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";
              $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
              $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
              /*imagecopyresized(imagen-destino,donde-viene-origen,corte-nivel-X-DESTINO
              ,corte-nivel-Y-DESTINO,corte-nivel-X-ORIGE,corte-nivel-Y-origen,
              ANCHO-Nuevo,ALTO-Nuevo,ancho-ORigen,Alto-Origen);*/
              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
      
              imagepng($destino,$ruta);
      
          }
      }
      $contra=$_POST["nuevoPassword"];
      $encriptar=password_hash($contra,PASSWORD_DEFAULT );
      //password hash
      
      
       $tabla = "edu_tab_usuarios";
        $datos = array("nombre"=>$_POST["nuevoNombre"],
                  "usuario"=>$_POST["nuevoUsuario"],
                  "password"=>$encriptar,
                  "rol"=>$_POST["nuevoRol"],
                   "foto"=>$ruta);
        $respuesta=ModeloUsuarios::mdlCrearUsuario($tabla,$datos);
          if($respuesta=="ok"){
            echo'<script>
            Swal.fire({
              icon: "success",
              title: "¡El usuario ha sido guardado correctamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm:false
            }).then((result)=>{
              if(result.value){
                window.location="'.SERVERURL.'usuarios/";
      
              }
            });
            
            </script>';
          }else{
            echo'<script>
            Swal.fire({
              icon: "error",
              title: "¡No se pudo guardar usuario, intente nuevamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm:false
            }).then((result)=>{
              if(result.value){
                window.location="'.SERVERURL.'usuarios/";
        
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
              window.location="'.SERVERURL.'usuarios/";
      
            }
          });
          
          </script>';
        }
      }
}
/*========================================================================
CONTROLO DE MOSTRAR USUARIOS
==========================================================================*/
static public function ctrMostrarUsuarios($item,$valor){
    $tabla="edu_tab_usuarios";
    $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);

    return $respuesta;

}
/*========================================================================
CONTROL EDITAR USUARIOS REGISTRADOS EN LA BASE DE DATOS               
==========================================================================*/
public function ctrEditarUsuario(){
    if(isset($_POST["editarUsuario"])){
      if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarNombre"])){
  
        $ruta=$_POST["fotoActual"];
        if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){
          list($ancho, $alto)= getimagesize($_FILES["editarFoto"]["tmp_name"]);
          $nuevoAncho=500;
          $nuevoAlto=500;
         
          $directorio = "VISTA/dist/img/usuarios/".$_POST["editarUsuario"];
          
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
         
           if($_FILES["editarFoto"]["type"]=="image/jpeg")
             {
             /*=============================================
             =  GUARDAMOS LA IMAGEN EN EL DIRECTORIO  =
             =============================================*/
                 $aleatorio = mt_rand(100,999);
                 $ruta="VISTA/dist/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";
                 $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
                 $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
                 /*imagecopyresized(imagen-destino,donde-viene-origen,corte-nivel-X-DESTINO
                 ,corte-nivel-Y-DESTINO,corte-nivel-X-ORIGE,corte-nivel-Y-origen,
                 ANCHO-Nuevo,ALTO-Nuevo,ancho-ORigen,Alto-Origen);*/
                 imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
         
                 imagejpeg($destino,$ruta);
         
             }
             if($_FILES["editarFoto"]["type"]=="image/png")
             {
                 /*=============================================
                 =  GUARDAMOS LA IMAGEN EN EL DIRECTORIO  =
                 =============================================*/
                 $aleatorio = mt_rand(100,999);
                 $ruta="vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";
                 $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
                 $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
                 /*imagecopyresized(imagen-destino,donde-viene-origen,corte-nivel-X-DESTINO
                 ,corte-nivel-Y-DESTINO,corte-nivel-X-ORIGE,corte-nivel-Y-origen,
                 ANCHO-Nuevo,ALTO-Nuevo,ancho-ORigen,Alto-Origen);*/
                 imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
         
                 imagepng($destino,$ruta);
         
             }
         }
      
      $tabla = "edu_tab_usuarios";
      if($_POST["editarPassword"]!=""){
        $contra=$_POST["editarPassword"];
        $encriptar=password_hash($contra,PASSWORD_DEFAULT );
  
      }else{
        $encriptar=$_POST["passwordActual"];
      }
      $datos = array("nombre"=>$_POST["editarNombre"],
              "usuario"=>$_POST["editarUsuario"],
              "password"=>$encriptar,
              "rol"=>$_POST["editarRol"],
               "foto"=>$ruta);
      
      $respuesta=ModeloUsuarios::mdlEditarUsuario($tabla,$datos);
      if($respuesta=="ok"){
        echo'<script>
        Swal.fire({
          icon: "success",
          title: "¡El usuario ha sido modificado correctamente!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm:false
        }).then((result)=>{
          if(result.value){
            window.location="'.SERVERURL.'usuarios/";
  
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
            window.location="'.SERVERURL.'usuarios/";
    
          }
        });
        
        </script>';
  
      
    }
  
  }
  }
  static public function ctrBorrarUsuario(){

    if(isset($_GET["idUsuario"])){
  
      $tabla ="edu_tab_usuarios";
      $datos = $_GET["idUsuario"];
  
      if($_GET["fotoUsuario"] != ""){
        unlink($_GET["fotoUsuario"]);
        rmdir('VISTA/dist/img/usuarios/'.$_GET["usuario"]);
  
      }
  
      $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);
  
      if($respuesta == "ok"){
  
        echo'<script>
  
        Swal.fire({
            icon: "success",
            title: "El usuario ha sido borrado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {
  
                window.location = "'.SERVERURL.'usuarios/";
  
                }
              })
  
        </script>';
  
      }		
  
    }
  
  }

}