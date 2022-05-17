<script src="../js/paciente.js?rev=<?php echo time() ///para recgar el js 
                                    ?>"></script>

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>MANTENIMIENTO PACIENTES</b></h1>
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
            <button class="btn btn-danger btn-sm float-right " onclick="abrirModalRegistroPaciente()"><i class="fa fa-address-book" aria-hidden="true"></i> Nuevo Paciente</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table -responsive">
                    <table id="tabla_paciente" class="display">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DNI</th>
                                <th>PACIENTE</th>
                                <th>CELULAR</th>
                                <th>EDAD</th>
                                <th>SEXO</th>
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
    <div class="modal fade" id="modal_registro_paciente" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro PACIENTE</h5>
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
                            <label for="">CELULAR</label>
                            <input type="text" id="txt_celular" placeholder="Ingresar Celular" class="form-control" onkeypress="return soloNumeros(event);" maxlength="9">
                        </div>
                        <div class="col-6">
                            <label for="">EDAD</label>
                            <input type="text" id="txt_edad" placeholder="Ingresar edad" class="form-control" onkeypress="return soloNumeros(event);">
                        </div>
                        <div class="col-6">
                            <label for="">TIPO</label>
                            <select class="js-example-basic-single" id="select_tipo" style="width:100%">
                                <option value="">SELECCIONAR TIPO</option>
                                <option value="AÑOS">AÑOS</option>
                                <option value="MESES">MESES</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="">GENERO</label>
                            <select class="js-example-basic-single" id="select_sexo" style="width:100%">
                                <option value="">SELECCIONAR SEXO DEL PACIENTE</option>
                                <option value="MASCULINO">MASCULINO</option>
                                <option value="FEMENINO">FEMENINO</option>
                            </select>
                        </div>

                        <div class="col-12" id="div_mensaje_error">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="registrar_paciente()">REGISTRAR</button>
                </div>
            </div>
        </div>
    </div>
    <! FINAL MODAL -->
        <! INICIO MODAL -->
            <div class="modal fade" id="modal_editar_paciente" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <input type="text" id="txt_dniEditar" placeholder="Ingresar DNI" class="form-control" onkeypress="return soloNumeros(event);" maxlength="8">
                                </div>
                                <div class="col-9">
                                    <label for="">NOMBRE</label>
                                    <input type="text" id="txt_nombreEditar" placeholder="Ingresar Nombres" class="form-control" onkeypress=" return soloLetras(event);">
                                </div>
                                <div class="col-6">
                                    <label for="">APELLIDO PATERNO</label>
                                    <input type="text" id="txt_aPaternoEditar" placeholder="Ingresar Apellido Paterno" class="form-control" onkeypress=" return soloLetras(event);">
                                </div>

                                <div class="col-6">
                                    <label for="">APELLIDO MATERNO</label>
                                    <input type="text" id="txt_aMaternoEditar" placeholder="Ingresar Apellido Materno" class="form-control" onkeypress=" return soloLetras(event);">
                                </div>
                                <div class="col-6">
                                    <label for="">CELULAR</label>
                                    <input type="text" id="txt_celularEditar" placeholder="Ingresar Celular" class="form-control" onkeypress="return soloNumeros(event);" maxlength="9">
                                </div>
                                <div class="col-6">
                                    <label for="">EDAD</label>
                                    <input type="text" id="txt_edadEditar" placeholder="Ingresar edad" class="form-control" onkeypress="return soloNumeros(event);">
                                </div>
                                <div class="col-6">
                                    <label for="">TIPO</label>
                                    <select class="js-example-basic-single" id="select_tipoEditar" style="width:100%">
                                        <option value="">SELECCIONAR TIPO</option>
                                        <option value="AÑOS">AÑOS</option>
                                        <option value="MESES">MESES</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="">GENERO</label>
                                    <select class="js-example-basic-single" id="select_sexoEditar" style="width:100%">
                                        <option value="">SELECCIONAR SEXO DEL PACIENTE</option>
                                        <option value="MASCULINO">MASCULINO</option>
                                        <option value="FEMENINO">FEMENINO</option>
                                    </select>
                                </div>
                                <div class="col-12" id="div_mensaje_error">
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="editar_paciente()">REGISTRAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <! FINAL MODAL -->


                <script>
                    listado_paciente();
                    $(document).ready(function() {
                        $('.js-example-basic-single').select2();

                    });
                </script>