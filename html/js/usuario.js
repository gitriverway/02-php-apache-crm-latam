/*********************************
 CARGAR LISTA DE USUARIO EN TABLA
 *********************************/
//  function lista1(){
//     $.ajax({

//         url:"controller/usuarios/controlador_usuario_listar.php",
//         method: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(respuesta){

//             console.log("respuesta",respuesta);

//         }
//     });
//  }

var table;
function listar_usuario() {
  table = $("#tabla_usuario").DataTable({
    ordering: false,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [5, 10, 25, 50, 100, -1],
      [5, 10, 25, 50, 100, "All"],
    ],
    pageLength: 5,
    destroy: true,
    async: false,
    processing: true,
    searchPanes: {
      layout: "columns-3",
      cascadePanes: true,
      dtOpts: {
        dom: "tp",
        paging: true,
        pagingType: "numbers",
        searching: false,
      },
    },
    dom: "Plfrtip",
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
    ajax: "controller/usuarios/controlador_usuario_listar.php",
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $($(nRow).find("td")[1]).css("text-align", "center");
      $($(nRow).find("td")[2]).css("text-align", "center");
      $($(nRow).find("td")[3]).css("text-align", "center");
      $($(nRow).find("td")[4]).css("text-align", "center");
      $($(nRow).find("td")[5]).css("text-align", "center");
      $($(nRow).find("td")[6]).css("text-align", "center");
      $($(nRow).find("td")[7]).css("text-align", "center");
    },
    language: idioma_espanol,
  });
}

/*********************************
ABRI MODAL REGISTRO DE USUARIO
*********************************/
function AbrirModalRegistro() {
  $("#modal_registro").modal({ backdrop: "static", keyboard: false });
  $("#modal_registro").modal("show");
  LimpiarRegistro();
  listar_combo_empleado();
  listar_combo_rol();
}

/*********************************
LISTAR COMBO ROLES
*********************************/
function listar_combo_rol() {
  $.ajax({
    url: "controller/usuarios/controlador_combo_rol_listar.php",
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      var cadena = "";

      if (data.length > 0) {
        cadena += "<option value=''>" + t('messages.select_option_uppercase', 'SELECT...') + "</option>";
        for (var i = 0; i < data.length; i++) {
          cadena +=
            "<option value='" +
            data[i]["rol_id"] +
            "'>" +
            data[i]["rol_nombre"] +
            "</option>";
        }
      } else {
        cadena += "<option value=''>" + t('messages.no_records_found', 'NO RECORDS FOUND') + "</option>";
      }
      $(".cbm_rol").html(cadena);
    },
  });
}

/*********************************
LISTAR COMBO EMPLEADOS
*********************************/
function listar_combo_empleado() {
  $.ajax({
    url: "controller/usuarios/controlador_combo_empleado_listar.php",
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      var cadena = "";
      if (data.length > 0) {
        cadena += "<option value='0'>" + t('messages.select_option_uppercase', 'SELECT...') + "</option>";
        for (var i = 0; i < data.length; i++) {
          cadena +=
            "<option value='" +
            data[i]["empleado_id"] +
            "'>" +
            data[i]["empleado_nombre"] +
            "</option>";
        }
      } else {
        cadena += "<option value='0'>" + t('messages.no_records_found', 'NO RECORDS FOUND') + "</option>";
      }
      $(".cbm_empleado").html(cadena);
    },
  });
}

/*=============================================
ACTIVAR USUARIO
=============================================*/
$("#tabla_usuario").on("click", ".btnActivar", function () {
  var idUsuario = $(this).attr("idUsuario");
  var estatus = $(this).attr("estadoUsuario");

  Modificar_Estatus(idUsuario, estatus);
});

function Modificar_Estatus(idUsuario, estatus) {
  var datos = new FormData();
  datos.append("activarId", idUsuario);
  datos.append("activarEstatus", estatus);

  $.ajax({
    url: "controller/usuarios/controlador_modificar_estatus_usuario.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        var statusText = t('messages.user_status_changed', 'User {status} successfully').replace('{status}', estatus.toLowerCase());
        Swal.fire(
          t('messages.confirmation', 'Confirmation Message'),
          statusText,
          "success"
        ).then((value) => {
          table.ajax.reload();
        });
      }
    },
  });
}

/*********************************
REGISTRAR UN NUEVO USUARIO
*********************************/
function Registrar_Usuario() {
  var usu = $("#txt_usu").val().toUpperCase();
  var contra = $("#txt_con1").val();
  var contra2 = $("#txt_con2").val();
  var email = $("#txt_email").val();
  var empleado = $("#cbm_empleado").val();
  var rol = $("#cbm_rol").val();

  if (
    usu.length == 0 ||
    contra.length == 0 ||
    contra2.length == 0 ||
    email.length == 0 ||
    empleado.length == 0 ||
    rol.length == 0
  ) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_empty_fields', 'Fill in the empty fields'),
      "warning"
    );
  }

  if (contra != contra2) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.passwords_must_match', 'Passwords must match'),
      "warning"
    );
  }

  var datos = new FormData();
  datos.append("usuario", usu);
  datos.append("contrasena", contra);
  datos.append("email", email);
  datos.append("empleado", empleado);
  datos.append("rol", rol);

  $.ajax({
    url: "controller/usuarios/controlador_usuario_registro.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data["valor"] > 0) {
        if (data["valor"] == 1) {
          $("#modal_registro").modal("hide");
          Swal.fire(
            t('messages.confirmation', 'Confirmation Message'),
            t('messages.new_user_registered', 'Data correctly, New User Registered'),
            "success"
          ).then((value) => {
            LimpiarRegistro();
            table.ajax.reload();
          });
        } else {
          return Swal.fire(
            t('messages.warning', 'Warning Message'),
            t('messages.user_email_already_exists', 'Sorry, username and/or email already exists in our database'),
            "warning"
          );
        }
      } else {
        Swal.fire(
          t('messages.error', 'Error'),
          t('messages.could_not_complete_registration', 'Sorry, could not complete registration'),
          "error"
        );
      }
    },
  });
}

/*********************************
LIMPIAR LOS REGISTROS
*********************************/
function LimpiarRegistro() {
  $("#txt_usu").val("");
  $("#txt_con1").val("");
  $("#txt_con2").val("");
  $("#txt_email").val("");
}

/*********************************
CARGAR DATOS EDITAR USUARIO
*********************************/
$("#tabla_usuario").on("click", ".btnEditar", function () {
  var idUsuario = $(this).attr("idusuario");

  $("#modal_editar").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar").modal("show");

  var datos = new FormData();
  datos.append("idUsuario", idUsuario);
  $.ajax({
    url: "controller/usuarios/controlador_traerdatos_usuario.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      $("#txtidusuario").val(data[0]["usuario_id"]);
      $("#txtusu_editar").val(data[0]["usuario_nombre"]);
      $("#txt_con_editar").val("");
      $("#passwordActual").val(data[0]["usuario_password"]);
      $("#txtusu_email").val(data[0]["usuario_email"]);
      $("#cbm_empleado_editar").val(data[0]["empleado_id"]).change();
      $("#cbm_rol_editar").val(data[0]["rol_id"]).change();
    },
  });
});

/*********************************
MODIFICAR DATOS USUARIO
*********************************/
function Modificar_Usuario() {
  var idUsuario = $("#txtidusuario").val();
  var usu = $("#txtusu_editar").val().toUpperCase();
  var contra_nueva = $("#txt_con_editar").val();
  var contra_actual = $("#passwordActual").val();
  var email = $("#txtusu_email").val();
  var empleado = $("#cbm_empleado_editar").val();
  var rol = $("#cbm_rol_editar").val();

  if (
    idUsuario.length == 0 ||
    usu.length == 0 ||
    email.length == 0 ||
    empleado.length == 0 ||
    rol.length == 0 ||
    rol == "null"
  ) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_empty_fields', 'Fill in the empty fields'),
      "warning"
    );
  }

  var datos = new FormData();
  datos.append("idUsuario", idUsuario);
  datos.append("usuario", usu);
  datos.append("contra_nueva", contra_nueva);
  datos.append("contra_actual", contra_actual);
  datos.append("email", email);
  datos.append("empleado", empleado);
  datos.append("rol", rol);

  $.ajax({
    url: "controller/usuarios/controlador_usuario_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        $("#modal_editar").modal("hide");
        Swal.fire(
          t('messages.confirmation', 'Confirmation Message'),
          t('messages.data_updated_successfully', 'Data Updated Successfully'),
          "success"
        ).then((value) => {
          table.ajax.reload();
        });
      } else {
        Swal.fire(
          t('messages.warning', 'Warning Message'),
          t('messages.user_email_already_exists', 'Sorry, username and/or email already exists in our database'),
          "warning"
        );
      }
    },
  });
}

// function TraerDatosUsuario(){
//    var idUsuario = $("#txtidprincipal").val();
//    var datos = new FormData();
//     datos.append("idUsuario", idUsuario);
//    $.ajax({

//        url:"controller/usuarios/controlador_traerdatos_usuario.php",
//        method: "POST",
//        data: datos,
//        cache: false,
//        contentType: false,
//        processData: false,
//        success: function(respuesta){

//            var data = JSON.parse(respuesta);
//            if (data.length > 0) {
//                if (data[0]["usuario_imagen"] != "") {
//                    $("#img_nav").attr("src",data[0]["usuario_imagen"]);
//                    $("#img_subnav").attr("src",data[0]["usuario_imagen"]);
//                    $("#img_lateral").attr("src",data[0]["usuario_imagen"]);
//                }else{
//                    $("#img_nav").attr("src","vistas/img/usuarios/anonymous.png");
//                    $("#img_subnav").attr("src","vistas/img/usuarios/anonymous.png");
//                    $("#img_lateral").attr("src","vistas/img/usuarios/anonymous.png");
//                }
//            }
//        }
//    });
// }
