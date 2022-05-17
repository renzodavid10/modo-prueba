var tbl_realizarexamen;
function listado_realizarexamen() {
    tbl_realizarexamen = $("#tabla_realizarexamen").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controlador/realizarexamen/controlador_realizarexamen_listar.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "paciente" },
            { "data": "paciente_dni" },
            { "data": "medico" },
            { "data": "fecha" },
            { "data": "indica" },
            {
                "data": "estatus",
                render: function (data, type, row) {
                    estado = data;

                    if (estado == "ACTIVO") {
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
    tbl_realizarexamen.on('draw.td', function () {
        var PageInfo = $("#tabla_realizarexamen").DataTable().page.info();
        tbl_realizarexamen.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}
function AbrirModalPaciente() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_ver_paciente").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_ver_paciente").modal('show');//abirir modal
}
var tbl_paciente;
function listado_paciente_enre() {
    tbl_paciente = $("#tabla_ver_paciente").DataTable({
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
            { "data": "edadcon" },
            {
                "data": "null",
                render: function (data, type, row) {
                    return "<button class='enviarPaciente btn btn-success '><i class='fas fa-share'></i></button>";
                }
            }
        ],
        "language": idioma_espanol,
        select: true
    });
    tbl_paciente.on('draw.td', function () {
        var PageInfo = $("#tabla_ver_paciente").DataTable().page.info();
        tbl_paciente.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
} $('#tabla_ver_paciente').on('click', '.enviarPaciente', function () {/// para editar foto se hace todo este procedimiento
    var data = tbl_paciente.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio /// usamos los datos de la tabla 
    if (tbl_paciente.row(this).child.isShown()) {
        var data = tbl_paciente.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $("#modal_ver_paciente").modal('hide');//minimza le modal u me muestra que paciente se encuentra registrado
    document.getElementById('txt_idPaciente').value = data['paciente_id'];
    document.getElementById('txt_dni').value = data['paciente_dni'];
    document.getElementById('txt_paciente').value = data['paciente'];

})
var tbl_medico;
function listado_medico() {
    tbl_medico = $("#tabla_ver_medico").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controlador/medico/controlador_medico_listar.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "medico_nrodocumento" },
            { "data": "medico" },
            { "data": "especialidad_nombre" },
            {
                "data": "null",
                render: function (data, type, row) {
                    return "<button class='enviarMedico btn btn-primary'><i class='fa fa-share'></i></button>";
                }
            }

        ],
        "language": idioma_espanol,
        select: true
    });
    tbl_medico.on('draw.td', function () {
        var PageInfo = $("#tabla_ver_medico").DataTable().page.info();
        tbl_medico.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}
function AbrirModalMedico() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_ver_medico").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_ver_medico").modal('show');//abirir modal
}

$('#tabla_ver_medico').on('click', '.enviarMedico', function () {/// para editar foto se hace todo este procedimiento
    var data = tbl_medico.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio /// usamos los datos de la tabla 
    if (tbl_medico.row(this).child.isShown()) {
        var data = tbl_medico.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $("#modal_ver_medico").modal('hide');//minimza le modal u me muestra que paciente se encuentra registrado
    document.getElementById('txt_idMedico').value = data['medico_id'];
    document.getElementById('txt_medico').value = data['medico'];
    document.getElementById('txt_espec').value = data['especialidad_nombre'];


})
function registrar_paciente() {
    let dni = document.getElementById("txt_dni_pacie").value;
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
                        //$("#modal_ver_paciente").modal('hide');// me lo cierra
                        tbl_paciente.ajax.reload();
                        document.getElementById('div_mensaje_error').innerHTML = "";
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
    document.getElementById("txt_dni_pacie").value = "";
    document.getElementById("txt_nombre").value = "";
    document.getElementById("txt_aPaterno").value = "";
    document.getElementById("txt_aMaterno").value = "";
    document.getElementById("txt_celular").value = "";
    document.getElementById("txt_edad").value = "";
    $('#select_tipo').select2().val("").trigger('change.select2');
    $('#select_sexo').select2().val("").trigger('change.select2');
}
function cargar_select_analisis() {
    $.ajax({
        url: '../Controlador/examen/controlador_cargar_select_examen.php',
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

            //document.getElementById('select_analisis_editar').innerHTML = llenardata;
            document.getElementById('select_analisis').innerHTML = llenardata;


        }
        else {
            llenardata = "<option value=''>No se encontraron Datos en la BD</option>";
            document.getElementById('select_analisis').innerHTML = llenardata;
            //document.getElementById('select_analisis_editar').innerHTML = llenardata;
        }
    })
}
function cargar_select_analisis() {
    $.ajax({
        url: '../Controlador/examen/controlador_cargar_select_analisis.php',
        type: 'POST'
    }).done(function (resp) {

        let data = JSON.parse(resp);
        let llenardata = "<option value='0'>SELECCIONE UN ANALISIS</option>";
        if (data.length > 0) {
            for (let
                i = 0; i < data.length; i++) {
                llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                //alert(llenardata);//sin el mas
            }

            //document.getElementById('select_analisis_editar').innerHTML = llenardata;
            document.getElementById('select_analisis').innerHTML = llenardata;


        }
        else {
            llenardata = "<option value=''>No se encontraron Datos en la BD</option>";
            document.getElementById('select_analisis').innerHTML = llenardata;
            //document.getElementById('select_analisis_editar').innerHTML = llenardata;
        }
    })
} function cargar_select_examen(id) {
    $.ajax({
        url: '../Controlador/realizarexamen/controlador_realizarexamen_select_examen.php',
        type: 'POST',
        data: {
            idana: id,
        }
    }).done(function (resp) {
        //alert(resp);
        let data = JSON.parse(resp);
        let llenardata = "";
        if (data.length > 0) {
            llenardata = "<option value=''>SELECCIONE UN EXAMEN</option>";
            document.getElementById('select_examen').disabled = false;

            for (let
                i = 0; i < data.length; i++) {

                llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                //alert(llenardata);//sin el mas
            }

            //document.getElementById('select_analisis_editar').innerHTML = llenardata;
            document.getElementById('select_examen').innerHTML = llenardata;


        }
        else {
            document.getElementById('select_examen').disabled = true;
            llenardata = "<option value=''>No se encontraron Datos en la BD</option>";
            document.getElementById('select_examen').innerHTML = llenardata;
            //document.getElementById('select_analisis_editar').innerHTML = llenardata;
        }
    })
}
function agregarExamen() {
    let idexamen = document.getElementById("select_examen").value;
    let examen = $("#select_examen option:selected").text();
    let id_analisis = document.getElementById("select_analisis").value;
    //alert(id_analisis+examen+id_analisis);
    if (idexamen.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "No existe el examen seleccionado", "warning");
    }

    if (verificarid(idexamen)) {
        return Swal.fire("Mensaje de Advertencia", "El examen ya fue asignado a la tabla", "warning");

    }

    let datos_agregar = "<tr>";
    datos_agregar += "<td for='id'>" + idexamen + "</td>";
    datos_agregar += "<td hidden>" + id_analisis + "</td>";
    datos_agregar += "<td>" + examen + "</td>";
    datos_agregar += "<td><button class='btn btn-danger' onclick='remove(this)'><i class='fa fa-trash'></i></button></td>";
    datos_agregar += "</tr>";
    $("#tbody_tabla_examen").append(datos_agregar);
}
function verificarid(id) {/// para que no se pretia lo agregado
    let idverificar = document.querySelectorAll('#tabla_examen td[for="id"]');
    return [].filter.call(idverificar, td => td.textContent === id).length === 1;
}
function remove(t) {

    var td = t.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;

    table.removeChild(tr);

}
function registrar_realizar_examen() {
    let cont = 0;// para que se obligatoria que aya mas de un iten
    $("#tabla_examen tbody#tbody_tabla_examen tr").each(function () {
        cont++;// me recorre los datos que hay en la tabla// es decir el numero de columnas
    })
    //alert(cont);
    if (cont == 0) {
        return Swal.fire("Mensaje de Advertencia", "El detalle de la tabla debe tener como un minimo un examen", "warning");
    }
    idPaciente = document.getElementById('txt_idPaciente').value;
    idUsuario = document.getElementById('txt_idPrincipal').value;// esto se encuentra en la session
    idmedico = document.getElementById('txt_idMedico').value;

    if (idPaciente.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Debe seleccionar un paciente", "warning");

    } $.ajax({
        url: '../Controlador/realizarexamen/controlador_registrar_realizarexamen.php',
        type: 'POST',
        data: {
            idPaciente: idPaciente,
            idUsuario: idUsuario,
            idmedico: idmedico
        }
    }).done(function (resp) {
       // alert(resp);
        if (resp > 0) {
            Registrar_detalle_realizarexamen(parseInt(resp))

        } else {
            return Swal.fire("Mensaje de Advertencia", "No se pudo registrar registro", "warning");
        }



    })

}
function Registrar_detalle_realizarexamen(id) {
    let contador;
    let arreglo_examen = new Array();
    let arreglo_analisis = new Array();
    $("#tabla_examen tbody#tbody_tabla_examen tr").each(function () {
        arreglo_examen.push($(this).find('td').eq(0).text())
        arreglo_analisis.push($(this).find('td').eq(1).text())
        contador++;// me recorre los datos que hay en la tabla// es decir el numero de columnas
    })
    if (contador == 0) {
        return Swal.fire("Mensaje de Advertencia", "El detalle de la tabla debe tener como un minimo un examen", "warning");
    }

    let examen = arreglo_examen.toString();// me lo conivierte en una cadena
    let analisis = arreglo_analisis.toString();
    $.ajax({
        url: '../Controlador/realizarexamen/controlador_registrar_realizarexamen_detalle_registro.php',
        type: 'POST',
        data: {
            id: id,
            iexamen: examen,
            ianalisis: analisis,

        }
    }).done(function (resp) {
        //alert(resp);
        if (resp>0) {
            return Swal.fire("Mensaje de Confirmacion", "Datos registrados", "success").then((result)=>{
                if(result.value){
                    $("#contenido_principal").load("realizarexamen/mantenimiento_realizarexamen.php");
                }
            });
        }else{
            return Swal.fire("Mensaje de ERROR", "El registro no se pudo completar", "error");
        }
    })
}