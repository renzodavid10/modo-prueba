var tbl_rol;
function listado_rol() {
    tbl_rol = $("#tabla_rol").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controlador/rol/controlador_rol_listar.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "rol_nombre" },
            { "data": "rol_fregistro" },
            {
                "data": "rol_estatus",
                render: function (data, type, row) {
                    estado = data;

                    if (estado == "ACTIVO") {
                        return "<span class='badge bg-success'>" + estado + "</span>";
                    } else {
                        return '<span class="badge bg-danger">INACTIVO</span>';
                    }
                }
            },
            {
                "data": "rol_estatus",
                render: function (data, type, row) {
                    if (data == 'ACTIVO') { /// para quer se me apague el otro botn -disabled
                        return '<button class="editar btn btn-primary"><i class="fa fa-edit"></i></button>&nbsp;<button class="disabled btn btn-success"><i class="fa fa-check-circle"></i></button>&nbsp;<button class="desactivar btn btn-danger"><i class="fa fa-trash"></i></button>&nbsp;<button class="foto btn btn-default"><i class="fa fa-image"></i></button>&nbsp;<button class="contra btn btn-secondary"><i class="fa fa-key"></i></button> ';
                    }
                    else {
                        return '<button class="editar btn btn-primary"><i class="fa fa-edit"></i></button>&nbsp;<button class="activar btn btn-success"><i class="fa fa-check-circle"></i></button>&nbsp;<button class="disabled btn btn-danger"><i class="fa fa-trash"></i></button>&nbsp;<button class="foto btn btn-default"><i class="fa fa-image"></i></button>&nbsp;<button class="contra btn btn-secondary"><i class="fa fa-key"></i></button>';

                    }
                }
            }

        ],
        "language": idioma_espanol,
        select: true
    });
    tbl_rol.on('draw.td', function () {
        var PageInfo = $("#tabla_rol").DataTable().page.info();
        tbl_rol.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}
function abrirModalRegistroRoL() {

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_rol").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_registro_rol").modal('show');//abirir modal

}
function registrar_rol() {
    let rol = document.getElementById("txt_rol").value;
    if (rol.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Tienes Algunos campos vacios", "error");

    } $.ajax({
        url: '../Controlador/rol/controlador_registrar_rol.php',
        type: 'POST',
        data: {
            rol: rol,
        }
    }).done(function (resp) {
        //alert(resp);

        if (resp == 1) {

            return Swal.fire("Mensaje de Confirmacion", "Nuevo Rol Añadido ", "success").then((value) => {
                $("#modal_registro_rol").modal('hide');// me lo cierra
                tbl_rol.ajax.reload();
                document.getElementById('txt_rol').value = "";


            });


        } else {
            return Swal.fire("Mensaje de Advertencia", "Este rol ya se encuentra", "error");

        }

    })


}
$('#tabla_rol').on('click', '.editar', function () {/// para editar foto se hace todo este procedimiento
    var data = tbl_rol.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio /// usamos los datos de la tabla 
    if (tbl_rol.row(this).child.isShown()) {
        var data = tbl_rol.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $("#modal_editar_rol").modal('show');
    document.getElementById('txt_idRol').value = data['rol_id'];
    document.getElementById('txt_rolEditar').value = data['rol_nombre'];
    $('#select_estatus').select2().val(data["rol_estatus"]).trigger('change.select2');
})
function editar_rol() {
    let idrol = document.getElementById("txt_idRol").value;
    let rol = document.getElementById("txt_rolEditar").value;
    let status = document.getElementById("select_estatus").value;
    if (rol.length == 0 || idrol.length ==0 || status.rol ==0 ) {
        return Swal.fire("Mensaje de Advertencia", "Tienes Algunos campos vacios", "error");

    } $.ajax({
        url: '../Controlador/rol/controlador_editar_rol.php',
        type: 'POST',
        data: {
            idrol: idrol,
            rol: rol,
            status: status,
        }
    }).done(function (resp) {
        //alert(resp);

        if (resp == 1) {

            return Swal.fire("Mensaje de Confirmacion", "Nuevo Rol Añadido ", "success").then((value) => {
                $("#modal_editar_rol").modal('hide');// me lo cierra
                tbl_rol.ajax.reload();
                //document.getElementById('txt_rolEditar').value ="";


            });


        } else {
            return Swal.fire("Mensaje de Advertencia", "Este rol ya se encuentra", "error");

        }

    })

}

