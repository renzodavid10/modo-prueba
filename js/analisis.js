var tbl_analisis;
function listado_analisis() {
    tbl_analisis = $("#tabla_analisis").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controlador/analisis/controlador_analisis_listar.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "analisis_nombre" },
            { "data": "analisis_fregistro" },
            {
                "data": "analisis_estatus",
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
                "data": "analisis_estatus",
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
    tbl_analisis.on('draw.td', function () {
        var PageInfo = $("#tabla_analisis").DataTable().page.info();
        tbl_analisis.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}
function abrirModalRegistroAnalisis() {

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_analisis").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_registro_analisis").modal('show');//abirir modal

}
function registrar_analisis() {
    let analisis= document.getElementById("txt_tAnalisis").value;
    if (analisis.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Tienes Algunos campos vacios", "error");

    } $.ajax({
        url: '../Controlador/analisis/controlador_registrar_analisis.php',
        type: 'POST',
        data: {
            ana: analisis,
        }
    }).done(function (resp) {
        //alert(resp);

        if (resp == 1) {

            return Swal.fire("Mensaje de Confirmacion", "Nuevo Analisis Añadido ", "success").then((value) => {
                $("#modal_registro_analisis").modal('hide');// me lo cierra
                tbl_analisis.ajax.reload();
                document.getElementById('txt_tAnalisis').value = "";


            });


        } else {
            return Swal.fire("Mensaje de Advertencia", "Este Analisis ya se encuentra", "error");

        }

    })


}
$('#tabla_analisis').on('click', '.editar', function () {/// para editar foto se hace todo este procedimiento
    var data = tbl_analisis.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio /// usamos los datos de la tabla 
    if (tbl_analisis.row(this).child.isShown()) {
        var data = tbl_analisis.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $("#modal_editar_analisis").modal('show');
    document.getElementById('txt_idAnalisis').value = data['analisis_id'];
    document.getElementById('txt_analisisEditar').value = data['analisis_nombre'];
    $('#select_estatus').select2().val(data["analisis_estatus"]).trigger('change.select2');
})
function editar_analisis() {
    let idAna = document.getElementById("txt_idAnalisis").value;
    let ana = document.getElementById("txt_analisisEditar").value;
    let status = document.getElementById("select_estatus").value;
    if (ana.length == 0 || idAna.length ==0 || status.rol ==0 ) {
        return Swal.fire("Mensaje de Advertencia", "Tienes Algunos campos vacios", "error");

    } $.ajax({
        url: '../Controlador/analisis/controlador_editar_analisis.php',
        type: 'POST',
        data: {
            idAna: idAna,
            ana: ana,
            status: status,
        }
    }).done(function (resp) {
        //alert(resp);

        if (resp == 1) {

            return Swal.fire("Mensaje de Confirmacion", "Analisis Modificado ", "success").then((value) => {
                $("#modal_editar_analisis").modal('hide');// me lo cierra
                tbl_analisis.ajax.reload();
               // document.getElementById('txt_').value = "";


            });


        } else {
            return Swal.fire("Mensaje de Advertencia", "Este analisis ya se encuentra", "error");

        }

    })

}

