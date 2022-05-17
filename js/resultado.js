var tbl_resultadoexamen;
function listado_resultadoexamen() {
    tbl_resultadoexamen = $("#tabla_resultadoexamen").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controlador/resultado/controlador_resultadoexamen_listar.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "paciente" },
            { "data": "paciente_dni" },
            { "data": "usu_nombre" },
            { "data": "resultado_fregistro" },
            {
                "data": "resultado_estatus",
                render: function (data, type, row) {
                    estado = data;

                    if (estado == "ENTREGADO") {
                        return "<span class='badge bg-success'>" + estado + "</span>";
                    } else {
                        return '<span class="badge bg-danger">' + estado + '</span>';
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
    tbl_resultadoexamen.on('draw.td', function () {
        var PageInfo = $("#tabla_resultadoexamen").DataTable().page.info();
        tbl_resultadoexamen.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}
function AbrirModalPaciente() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_ver_examenes").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_ver_examenes").modal('show');//abirir modal
}
var tbl_paciente_examen;
function listado_paciente_examen() {
    tbl_paciente_examen = $("#tabla_ver_paciente_examen").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controlador/resultado/controlador_reslutadopacienteexamenpendiente_listar.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "paciente_dni" },
            { "data": "paciente" },
            { "data": "edadcon" },
            {
                "data": "null",
                render: function (data, type, row) {
                    return "<button class='enviar btn btn-success '><i class='fas fa-share'></i></button>";
                }
            }
        ],
        "language": idioma_espanol,
        select: true
    });
    tbl_paciente_examen.on('draw.td', function () {
        var PageInfo = $("#tabla_ver_paciente_examen").DataTable().page.info();
        tbl_paciente_examen.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}
$('#tabla_ver_paciente_examen').on('click', '.enviar', function () {/// para editar foto se hace todo este procedimiento
    var data = tbl_paciente_examen.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio /// usamos los datos de la tabla 
    if (tbl_paciente_examen.row(this).child.isShown()) {
        var data = tbl_paciente_examen.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $("#modal_ver_examenes").modal('hide');//minimza le modal u me muestra que paciente se encuentra registrado
    document.getElementById('txt_idExamen').value = data['realizarexamen_id'];
    document.getElementById('txt_dni').value = data['paciente_dni'];
    document.getElementById('txt_paciente').value = data['paciente'];
    document.getElementById('txt_dniMedico').value = data['medico_dni'];
    document.getElementById('txt_nombreMedico').value = data['medico'];

    listado_detalle_analisis(parseInt(data['realizarexamen_id']));

})
var tbl_detalle;
function listado_detalle_analisis(id) {
    tbl_detalle = $("#tabla_realizarexamen_detalle").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controlador/resultado/controlador_realizarexamen_detalle.php",
            type: 'POST',
            data: {
                idexamen: id
            }

        },
        "columns": [
            { "data": "rdetalle_id" },
            { "data": "analisis_nombre" },
            { "data": "examen_nombre" },
            {
                "defaultContent": "<input type='file' class='archivo form-control'    >"
            }

        ],
        "language": idioma_espanol,
        select: true
    });
}
function registrar_resultado_examen() {
    
    idRealizarExamen = document.getElementById('txt_idExamen').value;
    idUsuario = document.getElementById('txt_idPrincipal').value;// esto se encuentra en la session
 

    if (idRealizarExamen.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Debe seleccionar un paciente con examenes pendiente", "warning");

    } $.ajax({
        url: '../Controlador/resultado/controlador_resultado_registro.php',
        type: 'POST',
        data: {
            idRealizarExamen: idRealizarExamen,
            idUsuario: idUsuario
        }
    }).done(function (resp) {
        alert(resp);
        if (resp > 0) {
            Registrar_detalle_realizarexamen(parseInt(resp))

        } else {
            return Swal.fire("Mensaje de Advertencia", "No se pudo registrar registro", "warning");
        }



    })

}
