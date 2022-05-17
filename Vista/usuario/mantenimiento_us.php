<script src="../js/usuario.js?rev=<?php echo time() ///para recgar el js 
                                    ?>"></script>

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>MANTENIMIENTO USUARIO</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>
                    <li class="breadcrumb-item active">USUARIO</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="car-title"><b>LISTADO DE USUARIO</b></h3>
            <button class="btn btn-danger btn-sm float-right " onclick="abrirModalRegistroUsuario()"><i class="fa fa-address-book" aria-hidden="true"></i> Nuevo Registro</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table -responsive">
                    <table id="tabla_usuario_simple" class="display">
                        <thead>
                            <tr>
                                <th>#</th>

                                <th>ROL</th>
                                <th>FECHA REGISTRO</th>

                                <th>Rol</th>
                                <th>FOTO</th>
                                <th>Status</th>
                                <th>Accion</th>

                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>
    </div>
</div>
<! INICIO MODAL -->
    <div class="modal fade" id="modal_registro_usu" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Usuario</label>
                            <input type="text" id="txt_usuario" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="">Contraseña</label>
                            <input type="password" id="txt_contra" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="">Email</label>
                            <input type="text" id="txt_email" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="">Rol</label>
                            <select class="js-example-basic-single" id="select_rol" style="width:100%"></select>
                        </div>
                        <div class="col-12">
                            <label for="">Foto</label>
                            <input type="file" id="txt_foto" style="width:100%">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="registrar_usuario()">REGISTRAR</button>
                </div>
            </div>
        </div>
    </div>
    <! FINAL MODAL -->
        <! INICIO MODAL -->
            <div class="modal fade" id="modal_editar_usuario" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Usuarios</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Usuario</label>
                                    <input type="text" id="txt_idUsuario_editar" hidden>
                                    <input type="text" id="txt_Usuario_editar" readonly class="form-control">

                                </div>

                                <div class="col-12">
                                    <label for="">Email</label>
                                    <input type="text" id="txt_email_editar" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="">Rol</label>
                                    <select class="js-example-basic-single" id="select_rol_editar" style="width:100%"></select>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="modificar_usuario()">MODiFICAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <! FINAL MODAL -->
                <! INICIO MODAL -->
                    <div class="modal fade" id="modal_editar_foto" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Foto del usario
                                        <label for="" id="lbl_usuario"></label>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="text" id="idUsuarioFoto" hidden>
                                            <input type="text" id="fotoactual">
                                            <label for="">Foto</label>
                                            <input type="file" id="txt_foto_editar" style="width:100%">
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="modificar_foto_usuario()">MODiFICAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <! FINAL MODAL -->
                        <div class="modal fade" id="modal_editar_contra" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar Contraseña del usuario
                                            <label for="" id="lbl_usuario_contra"></label>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" id="idUsuarioContra" hidden>

                                                <label for="">CONTRASEÑA NUEVA </label>
                                                <input type="password" id="txt_contra_nueva" class="form-control">
                                            </div>
                                            <div class="col-12">

                                                <label for="">REPETIR CONTRASEÑA </label>
                                                <input type="password" id="txt_contra_repetir" class="form-control">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="modificar_contra_usuario()">MODiFICAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            listado_usu_simple();
                            cargar_select_rol();
                            //INICIALIZO MI SELECT2-->
                            $(document).ready(function() {
                                $('.js-example-basic-single').select2();

                            });
                            document.getElementById("txt_foto_editar").addEventListener("change", () => {
                                var fileName = document.getElementById("txt_foto_editar").value;
                                var idxDot = fileName.lastIndexOf(".") + 1;
                                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                                if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                                    //TO DO
                                } else {
                                    Swal.fire("MENSAJE DE ADVERTENCIA", "SOLO SE ACEPTAN IMAGENES-USTED SUBIO UN ARCHIVO CON EXTESION " + extFile,
                                        "warning ");
                                    document.getElementById("txt_foto_editar").value = "";
                                }
                            });
                            document.getElementById("txt_foto").addEventListener("change", () => {
                                var fileName = document.getElementById("txt_foto").value;
                                var idxDot = fileName.lastIndex0f(".") + 1;
                                var extFile = fileName.substr(idxDot, fileName.length).tolowerCase();
                                if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                                    //TO DO
                                } else {
                                    Swal.fire("MENSAJE DE ADVERTENCIA", "SOLO SE ACEPTAN IMAGENES-USTED SUBIO UN ARCHIVO CON EXTESION " + extFile,
                                        "warning ");
                                    document.getElementById("txt_foto").value = "";
                                }
                            });
                        </script>