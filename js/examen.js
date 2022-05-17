var tbl_examen;
function listado_examen() {
    tbl_examen = $("#tabla_examen").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controlador/examen/controlador_examen_listar.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "analisis_nombre" },
            { "data": "examen_nombre" },
            { "data": "examen_fregistro" },
            {
                "data": "examen_estatus",
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
                "data": "examen_estatus",
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
    tbl_examen.on('draw.td', function () {
        var PageInfo = $("#tabla_examen").DataTable().page.info();
        tbl_examen.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}
function abrirModalRegistro(){

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_examen").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_registro_examen").modal('show');//abirir modal

}
function cargar_select_analisis() {
    $.ajax({
        url: '../Controlador/examen/controlador_cargar_select_analisis.php',
        type: 'POST'
    }).done(function (resp) {

        let data = JSON.parse(resp);
        let llenardata = "";
        if (data.length > 0) {
            for (let
                i = 0; i < data.length; i++) {
                llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                //alert(llenardata);//sin el mas
            }

            document.getElementById('select_analisis_editar').innerHTML = llenardata;
            document.getElementById('select_analisis').innerHTML = llenardata;


        }
        else {
            llenardata = "<option value=''>No se encontraron Datos en la BD</option>";
            document.getElementById('select_analisis').innerHTML = llenardata;
            document.getElementById('select_analisis_editar').innerHTML = llenardata;
        }
    })
}
function registrar_examen() {
    let idanalisis = document.getElementById("select_analisis").value;
    let examen = document.getElementById("txt_tExamen").value;
    if (examen.length == 0 || idanalisis.length==0) {
        return Swal.fire("Mensaje de Advertencia", "Tienes Algunos campos vacios", "error");

    } $.ajax({
        url: '../Controlador/examen/controlador_registrar_examen.php',
        type: 'POST',
        data: {
            examen: examen,
            idAna: idanalisis
        }
    }).done(function (resp) {
        //alert(resp);

        if (resp == 1) {

            return Swal.fire("Mensaje de Confirmacion", "Nuevo Examen Añadido ", "success").then((value) => {
                $("#modal_registro_examen").modal('hide');// me lo cierra
                tbl_examen.ajax.reload();
                document.getElementById('txt_tExamen').value = "";


            });


        } else {
            return Swal.fire("Mensaje de Advertencia", "Este Examen ya se encuentra", "error");

        }

    })


}

$('#tabla_examen').on('click', '.editar', function () {/// para editar foto se hace todo este procedimiento
    var data = tbl_examen.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio /// usamos los datos de la tabla 
    if (tbl_examen.row(this).child.isShown()) {
        var data = tbl_examen.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $("#modal_editar_examen").modal('show');
    document.getElementById('txt_idExamen').value = data['examen_id'];
    document.getElementById('txt_examenEditar').value = data['examen_nombre'];
    $('#select_analisis_editar').select2().val(data["analisis_id"]).trigger('change.select2');
    $('#select_estatus').select2().val(data["examen_estatus"]).trigger('change.select2');

})
function editar_examen() {
    let idExamen = document.getElementById("txt_idExamen").value;
    let examen= (document.getElementById("txt_examenEditar").value).trim();  //limpia los espacio vacios del inicio
    let idAna= document.getElementById("select_analisis_editar").value;
    let status = document.getElementById("select_estatus").value;
    if (idAna.length == 0 || idExamen.length == 0 || status.rol == 0|| examen.rol == 0) {
        return Swal.fire("Mensaje de Advertencia", "Tienes Algunos campos vacios", "error");

    } $.ajax({
        url: '../Controlador/examen/controlador_editar_examen.php',
        type: 'POST',
        data: {
            idExamen: idExamen,
            examen: examen,
            ana: idAna,
            status: status,
        }
    }).done(function (resp) {
        //alert(resp);

       if (resp == 1) {

            return Swal.fire("Mensaje de Confirmacion", "Examen Modificado ", "success").then((value) => {
                $("#modal_editar_examen").modal('hide');// me lo cierra
                tbl_examen.ajax.reload();
                // document.getElementById('txt_').value = "";


            });


        } else {
            return Swal.fire("Mensaje de Advertencia", "Este examen ya se encuentra registrado", "error");

        }

    })

}

