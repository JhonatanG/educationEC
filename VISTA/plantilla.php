<?php
session_start();//INICIAR VARIABLES DE SESSION

include "MODULO/config.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>U.E.“Cristóbal Colón”</title>

    <!-- =============================================
PLUGINS CSS
=============================================*/ -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/plugins/fontawesome-free/css/all.min.css">
    <!-- ICONO DE NAVEGACION -->
    <link rel="icon" href="<?php echo SERVERURL;  ?>VISTA/dist/img/escudo.png">
       <!-- VALIDACION PASSWORD CSS -->
       <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/dist/css/validacionPass.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/plugins/jqvmap/jqvmap.min.css">
 
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
       <!-- Theme style -->
       <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/dist/css/adminlte.css">
     <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo SERVERURL;  ?>VISTA/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    
    <!-- =============================================
PLUGINS JAVASCRIPT
=============================================*/ -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Sparkline -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/moment/moment.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->

<!-- DATATABLE -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/adminlte.min.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/demo.js"></script>
  <!-- SWEETALERT -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/sweetalert2/sweetalert2.all.js"></script>

<script src="<?php echo SERVERURL;  ?>VISTA/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- SELECT2 -->
<script src="<?php echo SERVERURL;  ?>VISTA/plugins/select2/js/select2.full.min.js"></script>

</head>

<?php
if(isset($_SESSION["iniciarSesion"])&& $_SESSION["iniciarSesion"]=="ok" || 
isset($_SESSION["iniciarSesionD"])&& $_SESSION["iniciarSesionD"]=="ok"|| 
isset($_SESSION["iniciarSesionR"])&& $_SESSION["iniciarSesionR"]=="ok" || 
isset($_SESSION["iniciarSesionE"])&& $_SESSION["iniciarSesionE"]=="ok" ){
echo '<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">';
echo '<div class="wrapper">';
date_default_timezone_set('America/Guayaquil');
/*=============================================
CABECERA
 =============================================*/
 include 'MODULO/cabecera.php';
 /*=============================================
 MENU
  =============================================*/
 include 'MODULO/menu.php';
 /*=============================================
 INICIO PAGINAS
  =============================================*/
  $rutas = array();

 if(isset($_GET["ruta"])){
     $rutas = explode("/",$_GET["ruta"]);
    // var_dump($rutas);
     if($rutas[0]=="inicio"
     ||$rutas[0]=="salir"
     ||$rutas[0]=="usuarios"
     ||$rutas[0]=="anioL"
     ||$rutas[0]=="materias"
     ||$rutas[0]=="grados"
     ||$rutas[0]=="paralelos"
     ||$rutas[0]=="gparalelos"
     ||$rutas[0]=="gmaterias"
     ||$rutas[0]=="docente"
     ||$rutas[0]=="representantes"
     ||$rutas[0]=="alumnos"
     ||$rutas[0]=="agregarAlumno"
     ||$rutas[0]=="editarAlumno"
     ||$rutas[0]=="madocente"
     ||$rutas[0]=="docgrado"
     ||$rutas[0]=="matricula"
     ||$rutas[0]=="listaMatricula"
     ||$rutas[0]=="asistencia"
     ||$rutas[0]=="editarAsistencia"
     ||$rutas[0]=="reporteAsistencia"
     ||$rutas[0]=="reporteAsistenciaEs"
     ||$rutas[0]=="reporteAsistenciaRep"
     ||$rutas[0]=="notas"
     ||$rutas[0]=="reporteNotas"
     ||$rutas[0]=="reporteNotasG"
     ||$rutas[0]=="reportesNotasEs"
     ||$rutas[0]=="reporteNotasRep"

     ){
         include "MODULO/".$rutas[0].".php";
     }else{
         include "MODULO/404.php";
     }
 }
  
 include "MODULO/footer.php";
 echo '</body>';
}else{
    echo '<body class="hold-transition login-page">';
    include "MODULO/login.php";
    echo '</body>';
}


?>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/plantilla.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/usuarios.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/anio.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/materias.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/grados.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/paralelos.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/validacionPass.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/docentes.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/representantes.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/alumnos.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/madocentes.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/docgrado.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/gparalelo.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/matricula.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/asistencia.js"></script>
<script src="<?php echo SERVERURL;  ?>VISTA/dist/js/notas.js"></script>



</html>