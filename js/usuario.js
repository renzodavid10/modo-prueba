function iniciar_sesion() {

    recuerdame();

    let usu = document.getElementById('txtUsuario').value;
    let pass = document.getElementById('txtPass').value;

    if (usu.length == 0 || pass.length == 0) {
        // return alert("Ingrese los datos de la sesion");
        return Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '!LLENE LOS CAMPOS DE LA SESSION!',
            //footer: '<a href="">Why do I have this issue?</a>'
        });



    }
    $.ajax({

        url: 'Controlador/usuario/iniciar_sesion.php',
        type: 'POST',
        data: {
            u: usu,
            p: pass,
        }

    }).done(function (resp) {
        let data = JSON.parse(resp);// Lo convierto a un objketo el json_encode

        if (data.length > 0) {
            if (data[0]["usu_status"] == 'INACTIVO') {


                return Swal.fire('OOPSS...', 'Lo sentimos el usuario ' + usu + " se encuentra" + data[0][4] + ", comuniquese con el administrador", 'warning');

            }
            $.ajax({
                url: 'Controlador/usuario/crear_sesion.php',
                type: 'POST',
                data: {
                    id_usu: data[0][0],
                    usuario: data[0][1],
                    rol: data[0][3]
                },

            }).done(function (r) {
                let timerInterval
                Swal.fire({
                    title: 'BIENVENIDO AL SISTEMA',
                    html: 'Sera redireccionado en <b></b> milliseconds.',
                    timer: 800,
                    heightAuto:false,// para que el login no se mueva hacia arriba
                    timerProgressBar: false,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        location.reload();
                    }
                })

            })



        } else {
            Swal.fire('INCORRECTO', 'Usuaio o Contraseña incorrectos', 'error');
        }
    })
}

function recuerdame() {
    if (rmcheck.checked && usuarioinput.value !== "" && passinput.value !== "") {
        localStorage.usuario = usuarioinput.value;
        localStorage.pass = passinput.value;
        localStorage.checkbox = rmcheck.value;
    } else {
        localStorage.usuario = "";
        localStorage.pass = "";
        localStorage.checkbox = "";
    }
}
var tbl_usuario_simple;
function listado_usu_simple() {
    tbl_usuario_simple = $("#tabla_usuario_simple").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controlador/usuario/controlador_usuario_listar.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "usu_nombre" },
            { "data": "usu_email" },
            { "data": "rol_nombre" },
            {
                "data": "usu_foto",
                render: function (data, type, row) {
                    ruta = data;
                    return '<img class="img-responsive" style="width:60px" src="../' + data + '">';

                }
            },
            {
                "data": "usu_status",
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
                "data": "usu_status",
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
    tbl_usuario_simple.on('draw.td', function () {
        var PageInfo = $("#tabla_usuario_simple").DataTable().page.info();
        tbl_usuario_simple.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}
function abrirModalRegistroUsuario() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_usu").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_registro_usu").modal('show');//abirir modal

}

function cargar_select_rol() {
    $.ajax({
        url: '../Controlador/usuario/controlador_cargar_select_rol.php',
        type: 'POST'
    }).done(function (resp) {
        let data = JSON.parse(resp);
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                if(data[i][1]!="MEDICO"){
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
function registrar_usuario() {
    let usuario = document.getElementById("txt_usuario").value;
    let contrasena = document.getElementById("txt_contra").value;
    let email = document.getElementById("txt_email").value;
    let rol = document.getElementById("select_rol").value;
    let foto = document.getElementById("txt_foto").value;

    //return alert(document.getElementById("txt_usuario").value.length);
    //return alert(document.getElementById("txt_contra").value.length);
    //return alert(document.getElementById("select_rol").value );

    if (usuario.length == 0 || contrasena.length == 0 || email.length == 0 || rol.length == 0) {
        ValidarInput("txt_usuario", "txt_contra", "txt_email");
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
    formData.append('u', usuario);// deracha es de jsp-izquierda lo que enviare al controlador
    formData.append('c', contrasena);
    formData.append('e', email);
    formData.append('r', rol);
    formData.append('nombreFoto', nombrefoto);
    formData.append('foto', fotoobject);
    $.ajax({
        url: '../Controlador/usuario/controlador_usuario_registro.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp > 0) {
                if (resp == 1) {
                    ValidarInput("txt_usuario", "txt_contra", "txt_email");
                    limpiar_modalUsuarioRegistrado();

                    return Swal.fire("Mensaje de Confirmacion", "Nuevo Usuario Registrado", "success").then((value) => {
                        $("#modal_registro_usu").modal('hide');
                        tbl_usuario_simple.ajax.reload();

                    });
                }
                return Swal.fire("Mensaje de Advertencia", "Este usuario ya esta Registrado", "warning");

            } else {
                return Swal.fire("Mensaje de Advertencia", "No se pudor registrar el Usuario ", "error");

            }

        }
    });
    return false;

}

function ValidarInput(usu, contra, email) {
    if (usu != "") {
        Boolean(document.getElementById(usu).value.length > 0) ? $("#" + usu).removeClass("is-invalid").addClass("is-valid") : $("#" + usu).removeClass("is-valid").addClass("is-invalid");
    }
    if (contra != "") {
        Boolean(document.getElementById(contra).value.length > 0) ? $("#" + contra).removeClass("is-invalid").addClass("is-valid") : $("#" + contra).removeClass("is-valid").addClass("is-invalid");
    }
    Boolean(document.getElementById(email).value.length > 0) ? $("#" + email).removeClass("is-invalid").addClass("is-valid") : $("#" + email).removeClass("is-valid").addClass("is-invalid");

}
function validar_email(email) {

    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;

}
function limpiar_modalUsuarioRegistrado() {
    document.getElementById("txt_usuario").value = "";
    document.getElementById("txt_contra").value = "";
    document.getElementById("txt_email").value = "";
    document.getElementById("txt_foto").value = "";

}
//editar
$('#tabla_usuario_simple').on('click', '.editar', function () {
    var data = tbl_usuario_simple.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio
    if (tbl_usuario_simple.row(this).child.isShown()) {
        var data = tbl_usuario_simple.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_editar_usuario").modal('show');
    document.getElementById('txt_idUsuario_editar').value = data["usu_id"];
    document.getElementById('txt_Usuario_editar').value = data["usu_nombre"];
    document.getElementById('txt_email_editar').value = data["usu_email"];
    $('#select_rol_editar').select2().val(data["rol_id"]).trigger('change.select2');
})
$('#tabla_usuario_simple').on('click', '.activar', function () {
    var data = tbl_usuario_simple.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio /// usamos los datos de la tabla 
    if (tbl_usuario_simple.row(this).child.isShown()) {
        var data = tbl_usuario_simple.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    Swal.fire({
        title: 'Estas seguro de cambiar el sttaus a activo del usuario: ' + data["usu_nombre"] + "?",
        text: "Unas vez realizado esto el usuario tendra accesos al sitsema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, confiirmar!'
    }).then((result) => {
        if (result.isConfirmed) {
            modificar_status(data['usu_id'], 'ACTIVO');

        }
    })

})
$('#tabla_usuario_simple').on('click', '.desactivar', function () {
    var data = tbl_usuario_simple.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio
    if (tbl_usuario_simple.row(this).child.isShown()) {
        var data = tbl_usuario_simple.row(this).data();
    }
    // Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    Swal.fire({
        title: 'Estas seguro de cambiar el estaus a inactivo del usuario: ' + data['usu_nombre'] + '?',
        text: "Unas vez realizado esto el usuario no tendra acceso al sitsema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, confirmar!'
    }).then((result) => {
        if (result.isConfirmed) {
            modificar_status(data['usu_id'], 'INACTIVO');

        }
    })

})


function modificar_usuario() {
    let id_usu = document.getElementById('txt_idUsuario_editar').value;
    let email = document.getElementById('txt_email_editar').value;
    let rol = document.getElementById('select_rol_editar').value;
    if (rol.length == 0 || email.length == 0 || id_usu == 0) {
        ValidarInput("", "", "txt_email_editar");
        return Swal.fire("Mensaje de Advertencia", "tiene algunos campos vacios", "warning");
    }

    if (validar_email(email)) {
        //return Swal.fire("Mensaje de Advertencia", "El formato email es correcto", "warning");

    } else {
        return Swal.fire("Mensaje de Advertencia", "El formato email es incorrecto", "warning");
    }
    $.ajax({
        url: '../Controlador/usuario/controlador_modificar_usuario.php',
        type: 'POST',
        data: {
            id: id_usu,
            email: email,
            rol: rol
        }
    }).done(function (resp) {

        if (resp > 0) {

            return Swal.fire("Mensaje de Confirmacion", "Datos de  Usuario Actualizado", "success").then((value) => {
                $("#modal_editar_usuario").modal('hide');
                tbl_usuario_simple.ajax.reload();

            });


        } else {
            return Swal.fire("Mensaje de Advertencia", "No se pudo actualizar los datos", "error");

        }

    })
}
function modificar_status(id, status) {
    $.ajax({
        url: '../Controlador/usuario/controlador_modificar_usuario_estatus.php',
        type: 'POST',
        data: {
            id: id,
            status: status

        }
    }).done(function (resp) {
        //alert(resp);

        if (resp > 0) {

            return Swal.fire("Mensaje de Confirmacion", "Estatus actualizado ", "success").then((value) => {
                $("#modal_editar_usuario").modal('hide');
                tbl_usuario_simple.ajax.reload();

            });


        } else {
            return Swal.fire("Mensaje de Advertencia", "No se pudo actualizar los datos", "error");

        }

    })
}
$('#tabla_usuario_simple').on('click', '.foto', function () {/// para editar foto se hace todo este procedimiento
    var data = tbl_usuario_simple.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio /// usamos los datos de la tabla 
    if (tbl_usuario_simple.row(this).child.isShown()) {
        var data = tbl_usuario_simple.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $("#modal_editar_foto").modal('show');
    document.getElementById('idUsuarioFoto').value = data['usu_id'];
    document.getElementById('lbl_usuario').innerHTML = data['usu_nombre'];
    document.getElementById('fotoactual').value = data['usu_foto'];

})
function modificar_foto_usuario() {
    let id = document.getElementById("idUsuarioFoto").value;
    let foto = document.getElementById("txt_foto_editar").value;

    let rutaactual = document.getElementById('fotoactual').value;

    if (id.length == 0 || foto.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "tiene algunos campos vacios", "warning");
    }
    let extesion = foto.split('.').pop();//foto12.jpg mme muestra la jpg
    let nombrefoto = "";
    let f = new Date();//horraio -fecha
    if (foto.length) {
        nombrefoto = "IMG" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMilliseconds() + "." + extesion;
    }
    let formData = new FormData();
    let fotoobject = $("#txt_foto_editar")[0].files[0];// El objeto de la foto adjuntada
    formData.append('id', id);// deracha es de jsp-izquierda lo que enviare al controlador
    formData.append('nombreFoto', nombrefoto);
    formData.append('foto', fotoobject);

    formData.append('rutaactual', rutaactual);
    $.ajax({
        url: '../Controlador/usuario/controlador_usuario_modificar_foto.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            alert(resp);
            /*if (resp > 0) {
                return Swal.fire("Mensaje de Confirmacion", "Foto Actualizada", "success").then((value) => {
                    $("#modal_editar_foto").modal('hide');
                    tbl_usuario_simple.ajax.reload();//retorna a la tabla ya que se tiene la ruta

                });



            } else {
                return Swal.fire("Mensaje de Advertencia", "No se pudo Actualizar la Foto ", "error");

            }*/

        }
    });
    return false;


}
$('#tabla_usuario_simple').on('click', '.contra', function () {/// para editar foto se hace todo este procedimiento
    var data = tbl_usuario_simple.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio /// usamos los datos de la tabla 
    if (tbl_usuario_simple.row(this).child.isShown()) {
        var data = tbl_usuario_simple.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $("#modal_editar_contra").modal('show');
    document.getElementById('idUsuarioContra').value = data['usu_id'];
    document.getElementById('lbl_usuario_contra').innerHTML = data['usu_nombre'];

})
function modificar_contra_usuario() {
    let id = document.getElementById('idUsuarioContra').value;
    let contraN = document.getElementById('txt_contra_nueva').value;
    let contraR = document.getElementById('txt_contra_repetir').value;
    if (id.length == 0 || contraN.length == 0 || contraR.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "tiene algunos campos vacios", "warning");
    }
    if (contraN != contraR) {
        return Swal.fire("Mensaje de Advertencia", "Las contraseñas no son coinciden", "warning");
    }
    $.ajax({
        url: '../Controlador/usuario/controlador_modificar_usuario_contra.php',
        type: 'POST',
        data: {
            id: id,
            nueva: contraN,


        }
    }).done(function (resp) {
        //alert(resp);

        if (resp > 0) {

            return Swal.fire("Mensaje de Confirmacion", "Contraseña actualizada ", "success").then((value) => {
                $("#modal_editar_contra").modal('hide');
                tbl_usuario_simple.ajax.reload();
                document.getElementById('txt_contra_nueva').value="";
               document.getElementById('txt_contra_repetir').value="";

            });


        } else {
            return Swal.fire("Mensaje de Advertencia", "No se pudo actualizar la contraseña", "error");

        }

    })
}


