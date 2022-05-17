var tbl_especialidad;
function listado_especialidad() {
    tbl_especialidad = $("#tabla_especialidad").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controlador/especialidad/controlador_especialidad_listar.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "especialidad_nombre" },
            { "data": "especialidad_fregistro" },
            {
                "data": "especialidad_estatus",
                render: function (data, type, row) {
                    estado = data;

                    if (estado == "ACTIVO") {
                        return "<span class='badge bg-success'>" + estado + "</span>";
                    } else {
                        return '<span class="badge bg-danger">'+estado +'</span>';
                    }
                }
            },

            {
                "data": "null",
                render: function (data, type, row) {
                    return "<button class='editar btn btn-primary'><i class='fa fa-edit'></i></button>";
                }
            }

        ],
        "language": idioma_espanol,
        select: true
    });
    tbl_especialidad.on('draw.td', function () {
        var PageInfo = $("#tabla_especialidad").DataTable().page.info();
        tbl_especialidad.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}
function abrirModalRegistroEspecialidad() {

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_especialidad").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_registro_especialidad").modal('show');//abirir modal
    // document.getElementById('div_mensaje_error').innerHTML = "";// cada ves que abra el modal no debe mostrar,e errpr

}
function registrar_rol() {
    let espe = document.getElementById("txt_especialidad").value;
    if (espe.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Tienes Algunos campos vacios", "error");

    } $.ajax({
        url: '../Controlador/especialidad/controlador_registrar_especialidad.php',
        type: 'POST',
        data: {
            espe: espe,
        }
    }).done(function (resp) {
        //alert(resp);

        if (resp == 1) {

            return Swal.fire("Mensaje de Confirmacion", "Nuevo Especialidad Añadido ", "success").then((value) => {
                $("#modal_registro_especialidad").modal('hide');// me lo cierra
                tbl_especialidad.ajax.reload();
                document.getElementById('txt_especialidad').value = "";


            });


        } else {
            return Swal.fire("Mensaje de Advertencia", "Esta especialidad ya se encuentra", "error");

        }

    })


}
$('#tabla_especialidad').on('click', '.editar', function () {/// para editar foto se hace todo este procedimiento
    var data = tbl_especialidad.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio /// usamos los datos de la tabla 
    if (tbl_especialidad.row(this).child.isShown()) {
        var data = tbl_especialidad.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $("#modal_editar_especialidad").modal('show');
    document.getElementById('txt_idEspe').value = data['especialidad_id'];
    document.getElementById('txt_espeEditar').value = data['especialidad_nombre'];
    $('#select_estatus').select2().val(data["especialidad_estatus"]).trigger('change.select2');
})
function editar_rol() {
    let idespe = document.getElementById("txt_idEspe").value;
    let espe = document.getElementById("txt_espeEditar").value;
    let status = document.getElementById("select_estatus").value;
    if (espe.length == 0 || idespe.length == 0 || status.rol == 0) {
        return Swal.fire("Mensaje de Advertencia", "Tienes Algunos campos vacios", "error");

    } $.ajax({
        url: '../Controlador/especialidad/controlador_editar_especialidad.php',
        type: 'POST',
        data: {
            idespe: idespe,
            espe: espe,
            status: status,
        }
    }).done(function (resp) {
        //alert(resp);

        if (resp == 1) {

            return Swal.fire("Mensaje de Confirmacion", "Nueva especialidad Añadido ", "success").then((value) => {
                $("#modal_editar_especialidad").modal('hide');// me lo cierra
                tbl_especialidad.ajax.reload();
                //document.getElementById('txt_rolEditar').value ="";


            });


        } else {
            return Swal.fire("Mensaje de Advertencia", "Esta especialidad ya se encuentra", "error");

        }

    })

}
