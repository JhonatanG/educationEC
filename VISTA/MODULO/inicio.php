<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Inicio</h1>
          <!-- <?php
 if($_SESSION["foto"]==""){
  echo '<div class="alert alert-warning alert-dismissable">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  Por favor, actualice su foto de perfil.
</div>';}
        ?> -->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Tablero</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="row">
      
          <!-- small box -->
      <?php
      if ($_SESSION["rol"]=="Docente"){
        /*=============================================
ASISTENCIA
=============================================*/
      echo'
      <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3></h3>

              <p>Asistencia Estudiantes</p>
            </div>
            <div class="icon">
            <i class="fas fa-calendar-check"></i>
            </div>
            <a href="'.SERVERURL.'asistencia/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>';
        echo'     <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><sup style="font-size: 20px"></sup></h3>

            <p>Ingresar Calificaciones</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="'.SERVERURL.'notas/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>';
      echo'
      <div class="col-lg-3 col-6">

      <div class="small-box bg-warning">
        <div class="inner">
          <h3></h3>

          <p>Reporte de Notas</p>
        </div>
        <div class="icon">
        <i class="fas fa-notes-medical"></i>
        </div>
        <a href="'.SERVERURL.'reporteNotas/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>';
        
        }?>
        <?php
      if ($_SESSION["rol"]=="Estudiante"){

      echo'
      <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3></h3>

              <p>Asistencia</p>
            </div>
            <div class="icon">
            <i class="fas fa-calendar-check"></i>
            </div>
            <a href="'.SERVERURL.'reporteAsistenciaEs/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>';
        echo'     <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><sup style="font-size: 20px"></sup></h3>

            <p>Ingresar Calificaciones</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="'.SERVERURL.'reportesNotasEs/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>';

        
        }?>
         <?php
      if ($_SESSION["rol"]=="Representante"){

      echo'
      <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3></h3>

              <p>Asistencia</p>
            </div>
            <div class="icon">
            <i class="fas fa-calendar-check"></i>
            </div>
            <a href="'.SERVERURL.'reporteAsistenciaRep/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>';
        echo'     <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><sup style="font-size: 20px"></sup></h3>

            <p>Ingresar Calificaciones</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="'.SERVERURL.'reporteNotasRep/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>';

        
        }?>
          <!-- small box -->
      <?php
      if ($_SESSION["rol"]=="Administrador"){
    
      echo'
      <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3></h3>

              <p>Editar Asistencia Estudiantes</p>
            </div>
            <div class="icon">
            <i class="fas fa-calendar-check"></i>
            </div>
            <a href="'.SERVERURL.'editarAsistencia/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>';
        echo'     <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><sup style="font-size: 20px"></sup></h3>

            <p>Reportes Asistencia Estudiantes</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="'.SERVERURL.'reporteAsistencia/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>';
      echo'
      <div class="col-lg-3 col-6">

      <div class="small-box bg-warning">
        <div class="inner">
          <h3></h3>

          <p>Reporte de Notas</p>
        </div>
        <div class="icon">
        <i class="fas fa-notes-medical"></i>
        </div>
        <a href="'.SERVERURL.'reporteNotasG/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>';
    echo'
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3></h3>

            <p>Usuarios del Sistema</p>
          </div>
          <div class="icon">
          <i class="ion ion-person-add"></i>
          </div>
          <a href="'.SERVERURL.'usuarios/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>';
        
        }?>
           <?php
      if ($_SESSION["rol"]=="Secretaría"){
    
      echo'
      <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3></h3>

              <p>Editar Asistencia Estudiantes</p>
            </div>
            <div class="icon">
            <i class="fas fa-calendar-check"></i>
            </div>
            <a href="'.SERVERURL.'editarAsistencia/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>';
        echo'     <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><sup style="font-size: 20px"></sup></h3>

            <p>Reportes Asistencia Estudiantes</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="'.SERVERURL.'reporteAsistencia/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>';
      echo'
      <div class="col-lg-3 col-6">

      <div class="small-box bg-warning">
        <div class="inner">
          <h3></h3>

          <p>Reporte de Notas</p>
        </div>
        <div class="icon">
        <i class="fas fa-notes-medical"></i>
        </div>
        <a href="'.SERVERURL.'reporteNotasG/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>';
    echo'
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3></h3>

            <p>Matriculas</p>
          </div>
          <div class="icon">
          <i class="ion ion-person-add"></i>
          </div>
          <a href="'.SERVERURL.'listaMatricula/" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>';
        
        }?>
        
    </div>


  </section>
  <!-- /.content -->
</div>