
var tbl_paciente;
function listado_paciente() {
    tbl_paciente = $("#tabla_paciente").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controlador/paciente/controlador_paciente_listar.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "paciente_dni" },
            { "data": "paciente" },
            { "data": "paciente_celular" },
            { "data": "edadcon" },
            { "data": "paciente_sexo" },
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
    tbl_paciente.on('draw.td', function () {
        var PageInfo = $("#tabla_paciente").DataTable().page.info();
        tbl_paciente.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}
function abrirModalRegistroPaciente() {

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_paciente").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_registro_paciente").modal('show');//abirir modal
    document.getElementById('div_mensaje_error').innerHTML = "";// cada ves que abra el modal no debe mostrar,e errpr

}
function registrar_paciente() {
    let dni = document.getElementById("txt_dni").value;
    let nombre = document.getElementById("txt_nombre").value;
    let apellido_p = document.getElementById("txt_aPaterno").value;
    let apellido_m = document.getElementById("txt_aMaterno").value;
    let celular = document.getElementById("txt_celular").value;
    let edad = document.getElementById("txt_edad").value;
    let tipo = document.getElementById("select_tipo").value;
    let genero = document.getElementById("select_sexo").value;
    if (tipo.length == 0 || genero.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Los campos tipo y genero deben ser elegidos", "warning");
    }
    if (dni.length == 0 || nombre.length == 0 || apellido_p.length == 0 || apellido_m.length == 0 || celular.length == 0 || edad.length == 0) {
        ValidarInputPaciente("txt_dni", "txt_nombre", "txt_aPaterno", "txt_aMaterno", "txt_celular", "txt_edad");
        return Swal.fire("Mensaje de Advertencia", "tiene algunos campos vacios", "warning");
    }

    $.ajax({
        url: '../Controlador/paciente/controlador_paciente_registro.php',
        type: 'POST',
        data: {
            dni: dni,
            nombre: nombre,
            aPat: apellido_p,
            aMat: apellido_m,
            celular: celular,
            edad: edad,
            tipo: tipo,
            genero: genero
        }

    }).done(function (resp) {
        if (isNaN(resp)) {
            document.getElementById('div_mensaje_error').innerHTML = '<br>' +
                '<div class="alert alert-danger alert-dismissible">' +
                '<h5><i class="icon fas fa-ban"></i> Revise los siguientes campos!</h5>' + resp + '</div>';
        }
        else {
            if (resp > 0) {
                if (resp == 1) {

                    return Swal.fire("Mensaje de Confirmacion", "Nuevo Paciente Registrado ", "success").then((value) => {
                        limpiar_datosPaciente();
                        $("#modal_registro_paciente").modal('hide');// me lo cierra
                        tbl_paciente.ajax.reload();
                    });


                } else {
                    return Swal.fire("Mensaje de Advertencia", "Este Paciente ya se encuentra", "error");

                }
            } else {
                return Swal.fire("Mensaje de Advertencia", "No se puedo registrar completo", "warning");
            }
        }
    })




}
function ValidarInputPaciente(dni, nombre, apellido_p, apellido_m, celular, edad) {
    if (dni != "") {
        Boolean(document.getElementById(dni).value.length > 0) ? $("#" + dni).removeClass("is-invalid").addClass("is-valid") : $("#" + dni).removeClass("is-valid").addClass("is-invalid");
    }
    if (nombre != "") {
        Boolean(document.getElementById(nombre).value.length > 0) ? $("#" + nombre).removeClass("is-invalid").addClass("is-valid") : $("#" + nombre).removeClass("is-valid").addClass("is-invalid");
    }
    if (apellido_p != "") {
        Boolean(document.getElementById(apellido_p).value.length > 0) ? $("#" + apellido_p).removeClass("is-invalid").addClass("is-valid") : $("#" + apellido_p).removeClass("is-valid").addClass("is-invalid");
    }
    if (apellido_m != "") {
        Boolean(document.getElementById(apellido_m).value.length > 0) ? $("#" + apellido_m).removeClass("is-invalid").addClass("is-valid") : $("#" + apellido_m).removeClass("is-valid").addClass("is-invalid");
    }
    if (celular != "") {
        Boolean(document.getElementById(celular).value.length > 0) ? $("#" + celular).removeClass("is-invalid").addClass("is-valid") : $("#" + celular).removeClass("is-valid").addClass("is-invalid");
    }
    if (edad != "") {
        Boolean(document.getElementById(edad).value.length > 0) ? $("#" + edad).removeClass("is-invalid").addClass("is-valid") : $("#" + edad).removeClass("is-valid").addClass("is-invalid");
    }
}
function limpiar_datosPaciente() {
    document.getElementById("txt_dni").value = "";
    document.getElementById("txt_nombre").value = "";
    document.getElementById("txt_aPaterno").value = "";
    document.getElementById("txt_aMaterno").value = "";
    document.getElementById("txt_celular").value = "";
    document.getElementById("txt_edad").value = "";
    $('#select_tipo').select2().val("").trigger('change.select2');
    $('#select_sexo').select2().val("").trigger('change.select2');
}
$('#tabla_paciente').on('click', '.editar', function () {/// para editar foto se hace todo este procedimiento
    var data = tbl_paciente.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio /// usamos los datos de la tabla 
    if (tbl_paciente.row(this).child.isShown()) {
        var data = tbl_paciente.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $("#modal_editar_paciente").modal('show');// se abre modal
    document.getElementById("txt_idEditar").value = data['paciente_id'];
    document.getElementById("txt_dniEditar").value = data['paciente_dni'];
    document.getElementById("txt_nombreEditar").value = data['paciente_nombres'];
    document.getElementById("txt_aPaternoEditar").value = data['paciente_apepaterno'];
    document.getElementById("txt_aMaternoEditar").value = data['paciente_apematerno'];
    document.getElementById("txt_celularEditar").value = data['paciente_celular'];
    document.getElementById("txt_edadEditar").value = data['paciente_edad'];
    $('#select_tipoEditar').select2().val(data['paciente_edadtipo']).trigger('change.select2');
    $('#select_sexoEditar').select2().val(data['paciente_sexo']).trigger('change.select2');

})
function editar_paciente() {
    let id = document.getElementById("txt_idEditar").value;
    let dni = document.getElementById("txt_dniEditar").value;
    let nombre = document.getElementById("txt_nombreEditar").value;
    let apa = document.getElementById("txt_aPaternoEditar").value;
    let ama = document.getElementById("txt_aMaternoEditar").value;
    let celular = document.getElementById("txt_celularEditar").value;
    let edad = document.getElementById("txt_edadEditar").value;
    let tipo = document.getElementById("select_tipoEditar").value;
    let sexo = document.getElementById("select_sexoEditar").value;
    if (tipo.length == 0 || sexo.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Los campos tipo y genero deben ser elegidos", "warning");
    }
    if (dni.length == 0 || nombre.length == 0 || apa.length == 0 || ama.length == 0 || celular.length == 0 || edad.length == 0) {
        ValidarInputPaciente("txt_dni", "txt_nombre", "txt_aPaterno", "txt_aMaterno", "txt_celular", "txt_edad");
        return Swal.fire("Mensaje de Advertencia", "tiene algunos campos vacios", "warning");
    }

    $.ajax({
        url: '../Controlador/paciente/controlador_paciente_editar.php',
        type: 'POST',
        data: {
            id: id,
            dni: dni,
            nombre: nombre,
            apa: apa,
            ama: ama,
            celular: celular,
            edad: edad,
            tipo: tipo,
            genero: sexo
        }

    }).done(function (resp) {
        // alert(resp);
        if (isNaN(resp)) {
            document.getElementById('div_mensaje_error').innerHTML = '<br>' +
                '<div class="alert alert-danger alert-dismissible">' +
                '<h5><i class="icon fas fa-ban"></i> Revise los siguientes campos!</h5>' + resp + '</div>';
        }
        else {
            if (resp > 0) {
                if (resp == 1) {

                    return Swal.fire("Mensaje de Confirmacion", "Nuevo Paciente Registrado ", "success").then((value) => {
                        limpiar_datosPaciente();
                        $("#modal_registro_paciente").modal('hide');// me lo cierra
                        tbl_paciente.ajax.reload();
                    });


                } else {
                    return Swal.fire("Mensaje de Advertencia", "Este Paciente ya se encuentra", "error");

                }
            } else {
                return Swal.fire("Mensaje de Advertencia", "No se puedo registrar completo", "warning");
            }
        }
    })

}


