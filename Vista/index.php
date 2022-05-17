<?php

session_start();
if (!isset($_SESSION['S_IDUSUARIO'])) {
    header('Location:../index.php'); /// si mi inicion esta creada me manda a la pagina
}

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SISTEMA LABORATIO/PANEL ADMINISTRATIVO</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../Plantilla/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Plantilla/dist/css/adminlte.min.css">
    <link rel="stylesheet" type="text/css" href="../utilitarios/DataTables/datatables.min.css" />

    <link rel="stylesheet" type="text/css" href="../Plantilla/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="../Plantilla/plugins/select2-bootstrap4-theme/select2-bootstrap4.css" />


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <?php echo $_SESSION['S_USUARIO']; ?>
                        <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" style="font-size: large;">
                            <i class="fas fa-user-cog mr-2"></i>
                            <span class="text-muted text-sm"><b>PERFIL</b></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="../Controlador/usuario/destruir_sesion.php" class="dropdown-item" style="font-size: large;">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="text-muted text-sm"><b>CERRAR SESION</b></span>
                        </a>
                        <div class="dropdown-divider"></div>

                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="../Plantilla/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../Plantilla/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">

                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="index.php" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    INICIO
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                        </li>
                        <li class="nav-header">PRINCIPAL</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','paciente/mantenimiento_paciente.php')">
                                <i class="fab fa-accessible-icon"></i>
                                <p>
                                    PACIENTES

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../reporte/reporte.php" class="nav-link">
                                <i class="fab fa-accessible-icon"></i>
                                <p>
                                    reporte

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','medico/mantenimiento_medico.php')">
                                <i class="nav-icon fas fa-user-md"></i>
                                <p>
                                    MEDICO

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','realizarexamen/mantenimiento_realizarexamen.php')">
                                <i class="nav-icon fas fa-heartbeat"></i>
                                <p>
                                    REALIZAR EXAMENES

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','resultado/mantenimiento_resultado.php')">
                                <i class="nav-icon fas fa-medkit"></i>
                                <p>
                                    RESULTADOS DE EXAMENES

                                </p>
                            </a>
                        </li>
                        <li class="nav-header">CONFIGURACION</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','usuario/mantenimiento_us.php')">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    USUARIOS

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','rol/mantenimiento_rol.php')">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    ROLES

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','examen/mantenimiento_examen.php')">
                                <i class="nav-icon fas fa-notes-medical"></i>
                                <p>
                                    EXAMEN

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','analisis/mantenimiento_analisis.php')">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    ANALISIS

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','especialidad/mantenimiento_especialidad.php')">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Especialidad

                                </p>
                            </a>
                        </li>
                    </ul>
                    <input type="text" value="<?php echo $_SESSION['S_IDUSUARIO'];?>" id="txt_idPrincipal"  >
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="contenido_principal">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Home</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>
                                <li class="breadcrumb-item active">INICIo</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <!-- /.col-md-6 -->
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="m-0">Featured</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Special title treatment</h6>

                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../Plantilla/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../Plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="../utilitarios/DataTables/datatables.min.js"></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src="../Plantilla/plugins/select2/js/select2.full.min.js"></script>
    <script src="../utilitarios/sweetalert.js"></script>
    <script src="../Plantilla/dist/js/adminlte.min.js"></script>

    <script>
        function cargar_contenido(id, vista) {
            $("#" + id).load(vista);
        }
        var idioma_espanol = {
            select: {
                // rows: "%d fila seleccionada"
                rows: ""
            },
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
            "sInfo": "Registros del (START al END) total de TOTAL registros",
            "sInfoEmpty": "Registro del (0 al 0) total 0 registros",
            "sInfoFiltered": "(Filtrado de un total de MAX registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "<b> No se encontraron datos </b>",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ":Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ":Activar para ordenar la columna de manera descendente"
            }

        }
        $(function() {
            var menues = $(".nav-link");
            menues.click(function() {
                menues.removeClass("active");
                $(this).addClass("active");
            });
        })

        function soloNumeros(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla == 8) {
                return true;
            }
            // Patron de entrada, en este caso solo acepta numeros
            patron = /[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }

        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = "8-37-39-46";
            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }
            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }

        function filterFloat(evt, input) {
            var key = window.Event ? evt.which : evt.keyCode;
            var chark = String.fromCharCode(key);
            var tempValue = input.value + chark;
            if (key >= 48 && key <= 57) {
                if (filter(tempValue) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                if (key == 8 || key == 13 || key == 0) {
                    return true;
                } else if (key == 46) {
                    if (filter(tempValue) === false) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return false;
                }
            }
        }

        function filter(__val__) {
            var preg = /^([0-9]+\.?[0-9]{0,2})$/;
            if (preg.test(__val__) === true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>