<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <img src="<?php echo SERVERURL;  ?>VISTA/dist/img/escudo.png" class="user-image" style="padding: 30px 100px 0px 100px;">

    <div class="card-header text-center">
      <a href="#" class="h2">U.E.<b>“Cristóbal Colón”</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Ingreso de Sistema</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="usuario" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="social-auth-links text-center mt-2 mb-3">
          <button type="submit" class="btn btn-block btn-primary">
            Ingresar
          </button>
        </div>
        <?php
        $login = new ControladorUsuarios();
        $login->ctrIngresoUsuario();
        $loginD = new ControladorDocentes();
        $loginD->ctrIngresoDocente();
        $loginR = new ControladorRepresentantes();
        $loginR -> ctrIngresoRepresentante();
        $loginE = new ControladorAlumnos();
        $loginE->ctrIngresoEstudiante();
         ?>
      </form>
    </div>

  </div>

</div>