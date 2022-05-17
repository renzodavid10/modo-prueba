<script src="../js/realizarexamen.js?rev=<?php echo time() ///para recgar el js 
                                            ?>"></script>

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>REGISTRO REALIZAR EXAMEN</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>
                    <li class="breadcrumb-item active">REGISTRO Realizar Examen</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="car-title"><b>REGISTRAR de examenes PACIENTES</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <input type="text" id="txt_idPaciente" hidden>
                    <label for="">DNI</label>
                    <input type="text" class="form-control" id="txt_dni" disabled>
                </div>
                <div class="col-7">
                    <label for="">Paciente</label>
                    <input type="text" class="form-control" id="txt_paciente" disabled>
                </div>
                <div class="col-2">
                    <label for="">&nbsp;</label>
                    <button class="btn btn-success" style="width:100%" onclick="AbrirModalPaciente()"><i class="fa fa-search">Buscar</i></button>
                </div>
                <div class="col-6">
                    <input type="text" id="txt_idMedico" hidden>
                    <label for="">MEDICO</label>
                    <input type="text" class="form-control" id="txt_medico" disabled>
                </div>
                <div class="col-4">
                    <label for="">ESPECIALIDAD</label>
                    <input type="text" class="form-control" id="txt_espec" disabled>
                </div>
                <div class="col-2">
                    <label for="">&nbsp;</label>
                    <button class="btn btn-success" style="width:100%" onclick="AbrirModalMedico()"><i class="fa fa-search">Buscar</i></button>
                </div>
                <div class="col-5">
                    <label for="">Analisis</label>
                    <select class="js-example-basic-single" id="select_analisis" style="width:100%"></select>
                </div>
                <div class="col-5">
                    <label for="">Examen</label>
                    <select class="js-example-basic-single" id="select_examen" style="width:100%" disabled></select>
                </div>
                <div class="col-2">
                    <label for="">&nbsp;</label>
                    <button class="btn btn-danger btn-sm" style="width:100%" onclick="agregarExamen()"> <i class="fa fa-plus"></i> AGREGAR</button>
                </div>

                <div class="col-12" style="text-align:center">
                    <br>
                    <button class="btn btn-success btn-lg" onclick="registrar_realizar_examen()">REGISTRAR REALIZACION EXAMENES </button>

                </div>

                <div class="col-12">
                    <br>
                    <table id="tabla_examen" style="width:100%">
                        <thead bgcolor="black" style="color:#FFFFFF;">
                            <th>ID</th>
                            <th hidden>ID ANALISIS</th>
                            <th>EXAMEN</th>
                            <th>ACCION</th>
                        </thead>
                        <tbody id="tbody_tabla_examen">
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_ver_paciente" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SELECCIONAR PACIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 ">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Listado de Paciente</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Nuevo Paciente</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="col-12 table -responsive">
                                            <table id="tabla_ver_paciente" class="display" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>DNI</th>
                                                        <th>PACIENTE</th>
                                                        <th>EDAD</th>
                                                        <th>Accion</th>

                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="">DNI</label>
                                                <input type="text" id="txt_dni_pacie" placeholder="Ingresar DNI" class="form-control" onkeypress="return soloNumeros(event);" maxlength="8">
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
                                            <div class="col-12" style="text-align:center">
                                                <button type="button" class="btn btn-primary" onclick="registrar_paciente()">REGISTRAR</button>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_ver_medico" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SELECCIONAR PACIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 ">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Listado de Paciente</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Nuevo Paciente</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="col-12 table-responsive">
                                            <table id="tabla_ver_medico" class="display" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>DNI</th>
                                                        <th>MEDICO</th>
                                                        <th>ESPECIALIDAD</th>
                                                        <th>Accion</th>

                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
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

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

    });
    listado_paciente_enre();
    listado_medico();
    cargar_select_analisis()

    $('#select_analisis').on('select2:select', function(e) { /// si seleccion un analisis me bota el id y los examenes dentro del nalisis
        let ids = document.getElementById('select_analisis').value;
        cargar_select_examen(ids);
        //alert(ids);
    });
</script>