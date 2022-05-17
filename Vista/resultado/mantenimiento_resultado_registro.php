<script src="../js/resultado.js?rev=<?php echo time() ///para recgar el js 
                                    ?>"></script>

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>REGISTRO DE RESULTADOS</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>
                    <li class="breadcrumb-item active">REGISTRO Resultado Examen</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="car-title"><b>REGISTRAR Resultado de examenes</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <input type="text" id="txt_idExamen">
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
                <div class="col-5">

                    <label for="">INDICA</label>
                    <input type="text" class="form-control" id="txt_dniMedico" disabled>
                </div>
                <div class="col-7">
                    <label for="">ESPECIALIDAD</label>
                    <input type="text" class="form-control" id="txt_nombreMedico" disabled>
                </div>
                <div class="col-12" style="text-align:center">
                    <br>
                    <button class="btn btn-success btn-lg" onclick="registrar_resultado_examen()">REGISTRAR RESULTADO EXAMENES </button>

                </div>

                <div class="col-12">
                    <br>
                    <table id="tabla_realizarexamen_detalle" style="width:100%">
                        <thead >
                            <th>ID</th>
                            <th>ANALISIS</th>
                            <th>EXAMEN</th>
                            <th widt="200px" >ARCHIVO</th>
                        </thead>
                        <tbody id="tbody_tabla_examen">
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_ver_examenes" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">LISTADO DE PACIENTES A REALIZARSE EXAMENES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <table id="tabla_ver_paciente_examen" class="display" width="100%">
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
    listado_paciente_examen();
</script>