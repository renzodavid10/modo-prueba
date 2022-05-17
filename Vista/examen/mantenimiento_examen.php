<script src="../js/examen.js?rev=<?php echo time() ///para recgar el js 
                                    ?>"></script>

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>MANTENIMIENTO EXAMEN</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO </a></li>
                    <li class="breadcrumb-item active">EXAMEN</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="car-title"><b>LISTADO EXAMENES</b></h3>
            <button class="btn btn-danger btn-sm float-right " onclick="abrirModalRegistro()"><i class="fa fa-address-book" aria-hidden="true"></i> Nuevo Registro</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table -responsive">
                    <table id="tabla_examen" class="display" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ANALISIS</th>
                                <th>EXAMEN</th>
                                <th>FECHA REGISTRO</th>
                                <th>STATUS</th>
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
    <div class="modal fade" id="modal_registro_examen" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro Examen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Examen</label>
                            <input type="text" id="txt_tExamen" placeholder="Ingresar Examen" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="">Analisis</label>
                            <select class="js-example-basic-single" id="select_analisis" style="width:100%"></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="registrar_examen()">REGISTRAR</button>
                </div>
            </div>
        </div>
    </div>
    <! FINAL MODAL -->
        <! INICIO MODAL -->
            <div class="modal fade" id="modal_editar_examen" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Examen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Examen</label>
                                    <input type="text" id="txt_idExamen" hidden>
                                    <input type="text" id="txt_examenEditar" placeholder="Ingresar Examenes" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="">Analisis</label>
                                    <select class="js-example-basic-single" id="select_analisis_editar" style="width:100%"></select>
                                </div>
                                <div class="col-12">
                                    <label for="">ESTATUS</label>
                                    <select class="js-example-basic-single" id="select_estatus" style="width:100%">
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="editar_examen()">REGISTRAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <! FINAL MODAL -->


                <script>
                    listado_examen();
                    $(document).ready(function() {
                        $('.js-example-basic-single').select2();

                    });
                    cargar_select_analisis()
                </script>