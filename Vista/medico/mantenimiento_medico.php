<script src="../js/medico.js?rev=<?php echo time() ///para recgar el js 
                                    ?>"></script>

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>MANTENIMIENTO DE MEDICOS</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO </a></li>
                    <li class="breadcrumb-item active">PACIENTES</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="car-title"><b>LISTADO DE PACIENTES</b></h3>
            <button class="btn btn-danger btn-sm float-right " onclick="abrirModalRegistroMedico()"><i class="fa fa-address-book" aria-hidden="true"></i> Nuevo Paciente</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table -responsive">
                    <table id="tabla_medicos" class="display">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DNI</th>
                                <th>MEDICO</th>
                                <th>Especialidad</th>
                                <th>Celular</th>
                                <th>Direccion</th>

                                <th>ACCION</th>

                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>
    </div>
</div>
<! INICIO MODAL -->
    <div class="modal fade" id="modal_registro_medico" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro del Medico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <label for="">DNI</label>
                            <input type="text" id="txt_dni" placeholder="Ingresar DNI" class="form-control" onkeypress="return soloNumeros(event);" maxlength="8">
                        </div>
                        <div class="col-9">
                            <label for="">NOMBRE</label>
                            <input type="text" id="txt_nombre" placeholder="Ingresar Nombres" class="form-control" onkeypress=" return soloLetras(event);">
                        </div>
                        <div class="col-6">
                            <label for="">APELLIDO PATERNO</label>
                            <input type="text" id="txt_aPaterno" placeholder="Ingresar Apellido Paterno" class="form-control" onkeypress=" return soloLetras(event);">
                        </div>

                        <div class="col-6">
                            <label for="">APELLIDO MATERNO</label>
                            <input type="text" id="txt_aMaterno" placeholder="Ingresar Apellido Materno" class="form-control" onkeypress=" return soloLetras(event);">
                        </div>
                        <div class="col-6">
                            <label for="">FECHA DE NACIMIENTO</label>
                            <input type="date" id="txt_fecha" class="form-control" onkeypress="return soloNumeros(event);" maxlength="9">
                        </div>
                        <div class="col-6">
                            <label for="">DIRECCION</label>
                            <input type="text" id="txt_direccion" placeholder="Ingresar Direccion
                            " class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">CELULAR</label>
                            <input type="text" id="txt_celular" placeholder="Ingresar Celular" class="form-control" onkeypress="return soloNumeros(event);" maxlength="9">
                        </div>
                        <div class="col-6">
                            <label for="">Especialidad</label>
                            <select class="js-example-basic-single" id="select_especialidad" style="width:100%"></select>
                        </div>
                        <div class="col-12" style="text-align:center">
                            <h2>DATOS DEL USUARIO</h2>
                        </div>
                        <div class="col-6">
                            <label for="">Usuario</label>
                            <input type="text" id="txt_usuario" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">Contraseña</label>
                            <input type="password" id="txt_contra" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">Email</label>
                            <input type="text" id="txt_email" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">Rol</label>
                            <select class="js-example-basic-single" id="select_rol" style="width:100%"></select>
                        </div>
                        <div class="col-6">
                            <label for="">Foto</label>
                            <input type="file" id="txt_foto" style="width:100%">
                        </div>


                        <div class="col-12" id="div_mensaje_error">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="registrar_medico()">REGISTRAR</button>
                </div>
            </div>
        </div>
    </div>
    <! FINAL MODAL -->
        <! INICIO MODAL -->
            <div class="modal fade" id="modal_editar_medico" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Paciente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">DNI</label>
                                    <input type="text" id="txt_idEditar" hidden>

                                    <input type="text" id="txt_dni_editar" placeholder="Ingresar DNI" class="form-control" onkeypress="return soloNumeros(event);" maxlength="8">
                                </div>
                                <div class="col-9">
                                    <label for="">NOMBRE</label>
                                    <input type="text" id="txt_nombre_editar" placeholder="Ingresar Nombres" class="form-control" onkeypress=" return soloLetras(event);">
                                </div>
                                <div class="col-6">
                                    <label for="">APELLIDO PATERNO</label>
                                    <input type="text" id="txt_aPaterno_editar" placeholder="Ingresar Apellido Paterno" class="form-control" onkeypress=" return soloLetras(event);">
                                </div>

                                <div class="col-6">
                                    <label for="">APELLIDO MATERNO</label>
                                    <input type="text" id="txt_aMaterno_editar" placeholder="Ingresar Apellido Materno" class="form-control" onkeypress=" return soloLetras(event);">
                                </div>
                                <div class="col-6">
                                    <label for="">FECHA DE NACIMIENTO</label>
                                    <input type="date" id="txt_fecha_editar" class="form-control" onkeypress="return soloNumeros(event);" maxlength="9">
                                </div>
                                <div class="col-6">
                                    <label for="">DIRECCION</label>
                                    <input type="text" id="txt_direccion_editar" placeholder="Ingresar Direccion" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="">CELULAR</label>
                                    <input type="text" id="txt_celular_editar" placeholder="Ingresar Celular" class="form-control" onkeypress="return soloNumeros(event);" maxlength="9">
                                </div>
                                <div class="col-6">
                                    <label for="">Especialidad</label>
                                    <select class="js-example-basic-single" id="select_especialidad_editar" style="width:100%"></select>
                                </div>
                                <div class="col-12" style="text-align:center">
                                    <h2>MODIFICAR DATOS DEL USUARIO</h2>
                                </div>
                                <div class="col-6">
                                    <label for="">Usuario</label>
                                    <input type="text" id="txt_idUsu_editar" readonly hidden>
                                    <input type="text" id="txt_usuario_editar" readonly class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="">Email</label>
                                    <input type="text" id="txt_email_editar" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="">Rol</label>
                                    <select class="js-example-basic-single" id="select_rol_editar" style="width:100%"></select>
                                </div>
                                <div class="col-12" id="div_mensaje_error_editar">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="editar_medico()">REGISTRAR</button>
                            </div>
                        </div>
                    </div>
                </div>
                <! FINAL MODAL -->


                    <script>
                        listado_medico();
                        cargar_select_especialidad();
                        cargar_select_rol();
                        $(document).ready(function() {
                            $('.js-example-basic-single').select2();

                        });
                    </script>