<script src="../js/especialidad.js?rev=<?php echo time() ///para recgar el js 
                                ?>"></script>

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>MANTENIMIENTO Especialidad</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO </a></li>
                    <li class="breadcrumb-item active">ROL</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="car-title"><b>LISTADO DE Especialidad</b></h3>
            <button class="btn btn-danger btn-sm float-right " onclick="abrirModalRegistroEspecialidad()"><i class="fa fa-address-book" aria-hidden="true"></i> Nuevo Registro</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table -responsive">
                    <table id="tabla_especialidad" class="display">
                        <thead>
                            <tr>
                                <th>#</th>

                                <th>Especialidad</th>
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
    <div class="modal fade" id="modal_registro_especialidad" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro Especialidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Especialidad</label>
                            <input type="text" id="txt_especialidad" placeholder="Ingresar Especialidad" class="form-control">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="registrar_rol()">REGISTRAR</button>
                </div>
            </div>
        </div>
    </div>
    <! FINAL MODAL -->
        <! INICIO MODAL -->
            <div class="modal fade" id="modal_editar_especialidad" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Especialidad</label>
                                    <input type="text" id="txt_idEspe">
                                    <input type="text" id="txt_espeEditar" placeholder="Ingresar Especialidad" class="form-control">
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
                            <button type="button" class="btn btn-primary" onclick="editar_rol()">REGISTRAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <! FINAL MODAL -->


                <script>
                    listado_especialidad();
                    $(document).ready(function() {
                        $('.js-example-basic-single').select2();

                    });
                </script>