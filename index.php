<?php
session_start();
if (isset($_SESSION['S_IDUSUARIO'])) {
  header('Location: vista/index.php'); /// si mi inicion esta creada me manda a la pagina
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISTEMA LABBORATORIO</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Plantilla/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="Plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Plantilla/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>INICIAR SESION</a>
      </div>
      <div class="card-body">

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Ingrese usuario" id="txtUsuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Ingrese Password" id="txtPass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="rememberME">
              <label for="rememberME">
                RECUERDAME
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" onclick="iniciar_sesion()">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>

        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">Olvidaste Contraseña</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Registraste </a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="Plantilla/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="Plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="Plantilla/dist/js/adminlte.min.js"></script>
  <script src="utilitarios/sweetalert.js"></script>
  <script src="js/usuario.js?rev=<?php echo time() ///para recgar el js ?>"></script>
  
  <script>
    const rmcheck = document.getElementById('rememberME'),

    usuarioinput = document.getElementById('txtUsuario'),
    passinput = document.getElementById('txtPass');

    if (localStorage.checkbox && localStorage.checkbox !=="") {
      rmcheck.setAttribute("checked", "checked");
      usuarioinput.value = localStorage.usuario;
      passinput.value = localStorage.pass;


    } else {
      rmcheck.removeAttribute("checked"); 
      usuarioinput.value = "";
      passinput.value = "";

    }
  </script>
</body>

</html>