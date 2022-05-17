var tbl_medico;
function listado_medico() {
    tbl_medico = $("#tabla_medicos").DataTable({
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
            { "data": "medico_movil" },
            { "data": "medico_direccion" },

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
    tbl_medico.on('draw.td', function () {
        var PageInfo = $("#tabla_medicos").DataTable().page.info();
        tbl_medico.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}
function abrirModalRegistroMedico() {

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_medico").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_registro_medico").modal('show');//abirir modal
    //document.getElementById('div_mensaje_error').innerHTML = "";// cada ves que abra el modal no debe mostrar,e errpr
}
function cargar_select_especialidad() {
    $.ajax({
        url: '../Controlador/medico/controlador_cargar_select_especialidad.php',
        type: 'POST'
    }).done(function (resp) {
        //alert(resp);
        let data = JSON.parse(resp);
        let llenardata = "<option value=''>SELECCIONAR ESPECIALIDAD</option>";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                //alert(llenardata);//sin el mas
            }

            document.getElementById('select_especialidad').innerHTML = llenardata;
            document.getElementById('select_especialidad_editar').innerHTML = llenardata;


        }
        else {
            llenardata = "<option value=''>No se encontraron Datos en la BD</option>";
            document.getElementById('select_especialidad').innerHTML = llenardata;
            document.getElementById('select_especialidad_editar').innerHTML = llenardata;
        }
    })
}
function cargar_select_rol() {
    $.ajax({
        url: '../Controlador/usuario/controlador_cargar_select_rol.php',
        type: 'POST'
    }).done(function (resp) {
        let data = JSON.parse(resp);
        let llenardata = "<option value=''>SELECCIONAR ROl</option>";// para poner por defecto el seelect 
        if (data.length > 0) {
            for (let
                i = 0; i < data.length; i++) {
                if (data[i][1]=="MEDICO") {
                    llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                    //alert(llenardata);//sin el mas
                }
            }

            document.getElementById('select_rol').innerHTML = llenardata;
            document.getElementById('select_rol_editar').innerHTML = llenardata;


        }
        else {
            llenardata = "<option value=''>No se encontraron Datos en la BD</option>";
            document.getElementById('select_rol').innerHTML = llenardata;
            document.getElementById('select_rol_editar').innerHTML = llenardata;
        }
    })
}
function registrar_medico() {
    let dni = document.getElementById("txt_dni").value;
    let nombre = document.getElementById("txt_nombre").value;
    let apellido_p = document.getElementById("txt_aPaterno").value;
    let apellido_m = document.getElementById("txt_aMaterno").value;
    let direc = document.getElementById("txt_direccion").value;
    let fNa = document.getElementById("txt_fecha").value;
    let celular = document.getElementById("txt_celular").value;
    let espec = document.getElementById("select_especialidad").value;

    let usuario = document.getElementById("txt_usuario").value;
    let contrasena = document.getElementById("txt_contra").value;
    let email = document.getElementById("txt_email").value;
    let rol = document.getElementById("select_rol").value;
    let foto = document.getElementById("txt_foto").value;


    if (espec.length == 0 || rol.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "El campo especialidad o rol estan vacion, verifique por favor", "warning");
    }
    if (dni.length == 0 || nombre.length == 0 || apellido_p.length == 0 || apellido_m.length == 0 || celular.length == 0 || direc.length == 0
        || fNa.length == 0 || celular.length == 0 || usuario.length == 0 || contrasena.length == 0 || email.length == 0) {
        ValidarInputMedico("txt_dni", "txt_nombre", "txt_aPaterno", "txt_aMaterno", "txt_direccion", "txt_fecha", "txt_celular", "txt_usuario", "txt_contra", "txt_email");
        return Swal.fire("Mensaje de Advertencia", "tiene algunos campos vacios", "warning");
    }

    if (validar_email(email)) {
        //return Swal.fire("Mensaje de Advertencia", "El formato email es correcto", "warning");

    } else {
        return Swal.fire("Mensaje de Advertencia", "El formato email es incorrecto", "warning");

    }

    let extesion = foto.split('.').pop();//foto12.jpg mme muestra la jpg
    let nombrefoto = "";
    let f = new Date();//horraio -fecha
    if (foto.length) {
        nombrefoto = "IMG" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMilliseconds() + "." + extesion;
    }
    let formData = new FormData();
    let fotoobject = $("#txt_foto")[0].files[0];// El objeto de la foto adjuntada
    formData.append('dni', dni);
    formData.append('nombre', nombre);
    formData.append('ape', apellido_p);
    formData.append('ama', apellido_m);
    formData.append('direc', direc);
    formData.append('fNa', fNa);
    formData.append('cel', celular);
    formData.append('espec', espec);
    formData.append('u', usuario);// deracha es de jsp-izquierda lo que enviare al controlador
    formData.append('c', contrasena);
    formData.append('e', email);
    formData.append('r', rol);
    formData.append('nombreFoto', nombrefoto);
    formData.append('foto', fotoobject);
    $.ajax({
        url: '../Controlador/medico/controlador_medico_registro.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            //alert(resp);
            if (isNaN(resp)) {
                document.getElementById('div_mensaje_error').innerHTML = '<br>' +
                    '<div class="alert alert-danger alert-dismissible">' +
                    '<h5><i class="icon fas fa-ban"></i> Revise los siguientes campos!</h5>' + resp + '</div>';
            }
            else {
                if (resp > 0) {
                    if (resp == 1) {
                        // ValidarInput("txt_usuario", "txt_contra", "txt_email");
                        limpiar_modalUsuarioMedico();

                        return Swal.fire("Mensaje de Confirmacion", "Nuevo Medico Registrado", "success").then((value) => {
                            $("#modal_registro_medico").modal('hide');
                            tbl_medico.ajax.reload();

                        });
                    }
                    else if (resp == 2) {
                        return Swal.fire("Mensaje de Advertencia", "Este DNI ya esta Registrado", "warning");
                    } else {
                        return Swal.fire("Mensaje de Advertencia", "Este usuario ya esta Registrado", "warning");
                    }

                } else {
                    return Swal.fire("Mensaje de Advertencia", "No se pudor registrar el Usuario ", "error");

                }
            }
        }
    });
    return false;

}
function validar_email(email) {

    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}
function ValidarInputMedico(dni, nombre, apellido_p, apellido_m, direc, fna, celular, usu, contras, email) {
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
    if (direc != "") {
        Boolean(document.getElementById(direc).value.length > 0) ? $("#" + direc).removeClass("is-invalid").addClass("is-valid") : $("#" + direc).removeClass("is-valid").addClass("is-invalid");
    }
    if (fna != "") {
        Boolean(document.getElementById(fna).value.length > 0) ? $("#" + fna).removeClass("is-invalid").addClass("is-valid") : $("#" + fna).removeClass("is-valid").addClass("is-invalid");
    }
    if (celular != "") {
        Boolean(document.getElementById(celular).value.length > 0) ? $("#" + celular).removeClass("is-invalid").addClass("is-valid") : $("#" + celular).removeClass("is-valid").addClass("is-invalid");
    }
    if (usu != "") {
        Boolean(document.getElementById(usu).value.length > 0) ? $("#" + usu).removeClass("is-invalid").addClass("is-valid") : $("#" + usu).removeClass("is-valid").addClass("is-invalid");
    }
    if (contras != "") {
        Boolean(document.getElementById(contras).value.length > 0) ? $("#" + contras).removeClass("is-invalid").addClass("is-valid") : $("#" + contras).removeClass("is-valid").addClass("is-invalid");
    }
    if (email != "") {
        Boolean(document.getElementById(email).value.length > 0) ? $("#" + email).removeClass("is-invalid").addClass("is-valid") : $("#" + email).removeClass("is-valid").addClass("is-invalid");
    }
}
function limpiar_modalUsuarioMedico() {
    document.getElementById("txt_dni").value = "";
    document.getElementById("txt_nombre").value = "";
    document.getElementById("txt_aPaterno").value = "";
    document.getElementById("txt_aMaterno").value = "";
    document.getElementById("txt_direccion").value = "";
    document.getElementById("txt_fecha").value = "";
    document.getElementById("txt_celular").value = "";
    $('#select_especialidad').select2().val("").trigger('change.select2');

    document.getElementById("txt_usuario").value = "";
    document.getElementById("txt_contra").value = "";
    document.getElementById("txt_email").value = "";
    $('#select_rol').select2().val("").trigger('change.select2');
    document.getElementById("txt_foto").value = "";
}
$('#tabla_medicos').on('click', '.editar', function () {/// para editar foto se hace todo este procedimiento
    var data = tbl_medico.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio /// usamos los datos de la tabla 
    if (tbl_medico.row(this).child.isShown()) {
        var data = tbl_medico.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $("#modal_editar_medico").modal('show');// se abre modal
    document.getElementById("txt_idEditar").value = data["medico_id"];
    document.getElementById("txt_dni_editar").value = data["medico_nrodocumento"];
    document.getElementById("txt_nombre_editar").value = data["medico_nombre"];
    document.getElementById("txt_aPaterno_editar").value = data["medico_apepat"];
    document.getElementById("txt_aMaterno_editar").value = data["medico_apemat"];
    document.getElementById("txt_direccion_editar").value = data["medico_direccion"];
    document.getElementById("txt_fecha_editar").value = data["medico_fenac"];
    document.getElementById("txt_celular_editar").value = data["medico_movil"];
    $('#select_especialidad_editar').select2().val(data['especialidad_id']).trigger('change.select2');

    document.getElementById("txt_idUsu_editar").value = data["usu_id"];
    document.getElementById("txt_usuario_editar").value = data["usu_nombre"];
    document.getElementById("txt_email_editar").value = data["usu_email"];
    $('#select_rol_editar').select2().val(data["rol_id"]).trigger('change.select2');

    document.getElementById('div_mensaje_error_editar').innerHTML="";

})
function editar_medico() {
    let idmedico = document.getElementById("txt_idEditar").value;
    let dni = document.getElementById("txt_dni_editar").value;
    let nombre = document.getElementById("txt_nombre_editar").value;
    let apellido_p = document.getElementById("txt_aPaterno_editar").value;
    let apellido_m = document.getElementById("txt_aMaterno_editar").value;
    let direc = document.getElementById("txt_direccion_editar").value;
    let fNa = document.getElementById("txt_fecha_editar").value;
    let celular = document.getElementById("txt_celular_editar").value;
    let espec = document.getElementById("select_especialidad_editar").value;

    let idusuario = document.getElementById("txt_idUsu_editar").value
    let usuario = document.getElementById("txt_usuario_editar").value;
    let email = document.getElementById("txt_email_editar").value;
    let rol = document.getElementById("select_rol_editar").value;



    if (espec.length == 0 || rol.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "El campo especialidad o rol estan vacion, verifique por favor", "warning");
    }
    if (dni.length == 0 || nombre.length == 0 || apellido_p.length == 0 || apellido_m.length == 0 || celular.length == 0 || direc.length == 0
        || fNa.length == 0 || celular.length == 0 || usuario.length == 0 || email.length == 0) {
        ValidarInputMedico("txt_dni_editar", "txt_nombre_editar", "txt_aPaterno_editar", "txt_aMaterno_editar", "txt_direccion_editar", "txt_fecha_editar", "txt_celular_editar", "txt_usuario_editar", "", "txt_email_editar");
        return Swal.fire("Mensaje de Advertencia", "tiene algunos campos vacios", "warning");
    }

    if (validar_email(email)) {
        //return Swal.fire("Mensaje de Advertencia", "El formato email es correcto", "warning");

    } else {
        return Swal.fire("Mensaje de Advertencia", "El formato email es incorrecto", "warning");

    }

    let formData = new FormData();
    formData.append('idM', idmedico)
    formData.append('dni', dni);
    formData.append('nombre', nombre);
    formData.append('ape', apellido_p);
    formData.append('ama', apellido_m);
    formData.append('direc', direc);
    formData.append('fNa', fNa);
    formData.append('cel', celular);
    formData.append('espec', espec);

    formData.append('idU', idusuario);
    formData.append('u', usuario);// deracha es de jsp-izquierda lo que enviare al controlador
    formData.append('e', email);
    formData.append('r', rol);
    $.ajax({
        url: '../Controlador/medico/controlador_medico_editar.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            //alert(resp);
            if (isNaN(resp)) {
                document.getElementById('div_mensaje_error_editar').innerHTML = '<br>' +
                    '<div class="alert alert-danger alert-dismissible">' +
                    '<h5><i class="icon fas fa-ban"></i> Revise los siguientes campos!</h5>' + resp + '</div>';
            }
            else {
                if (resp > 0) {
                    if (resp == 1) {
                        // ValidarInput("txt_usuario", "txt_contra", "txt_email");
                        limpiar_modalUsuarioMedico();

                        return Swal.fire("Mensaje de Confirmacion", "Actualizacion del medico", "success").then((value) => {
                            $("#modal_registro_medico").modal('hide');
                            tbl_medico.ajax.reload();

                        });
                    }
                    else if (resp == 2) {
                        return Swal.fire("Mensaje de Advertencia", "Este DNI ya esta Registrado", "warning");
                    } else {
                        return Swal.fire("Mensaje de Advertencia", "Este usuario ya esta Registrado", "warning");
                    }

                } else {
                    return Swal.fire("Mensaje de Advertencia", "No se pudor registrar el Usuario ", "error");

                }
            }
        }
    });
    return false;

}