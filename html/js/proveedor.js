/*********************************
 CARGAR LISTA DE EMPLEADO EN TABLA
 *********************************/
//  function lista1(){
//     $.ajax({

//         url:"controller/proveedores/controlador_proveedor_listar.php",
//         method: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(respuesta){

//             console.log("respuesta",respuesta);

//         }
//     });
//  }

if (window.matchMedia("(max-width:767px)").matches) {
  $("#tabla_proveedor").removeClass("nowrap");
  $("#tabla_proveedor").addClass("dt-responsive");
} else {
  $("#tabla_proveedor").removeClass("dt-responsive");
  $("#tabla_proveedor").addClass("nowrap");
}

var table;
function listar_proveedores() {
  table = $("#tabla_proveedor").DataTable({
    scrollX: true,
    ordering: false,
    bLengthChange: false,
    searching: { regex: false },
    // lengthMenu: [
    //   [5, 10, 25, 50, 100, -1],
    //   [5, 10, 25, 50, 100, "All"],
    // ],
    // pageLength: 5,
    destroy: true,
    async: false,
    processing: true,
    ajax: "controller/proveedores/controlador_proveedor_listar.php",
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      for (var i = 0; i <= 8; i++) {
        $($(nRow).find("td")[i]).css("text-align", "center");
      }
    },
    language: idioma_espanol,
  });
}

function validarEmail(valor) {
  if (valor.indexOf("@", 0) == -1 || valor.indexOf(".", 0) == -1) {
    return 0;
  } else {
    return 1;
  }
}

$(".listaNuevosCorreos").on("change", ".ingresar_correo", function () {
  var email = $(this).val();
  if (email.length > 0) {
    if (validarEmail(email) == 0) {
      return Swal.fire(
        t('messages.warning', 'Warning Message'),
        t('messages.check_email_format', 'Please check, email incorrectly entered'),
        "warning"
      );
    }
  }
});

/*=============================================
    AGREGANDO NUEVO CORREOS PROVEEDOR
    =============================================*/

var numNuevoCorreo = 0;

$(".btnAgregarNuevoCorreo").click(function () {
  var estado = "";

  if (numNuevoCorreo > 0) {
    estado = "d-md-none";
  } else {
    estado = "";
  }

  $(".listaNuevosCorreos").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridNuevoCorreo">' +
      '<div class="form-group col-12 col-md-3 order-1 my-1 ' +
      estado +
      '">' +
      '<label for="cbm_tipo_correo" class="control-label" style="text-align: right;">' + t('messages.email_type', 'EMAIL TYPE') + '</label>' +
      "</div>" +
      '<div class="form-group col-12 col-md-3 order-5 my-1">' +
      '<select class="form-control cbm_tipo_correo js-example-basic-single" name="state" id="cbm_tipo_correo' +
      numNuevoCorreo +
      '" style="width:100%;">' +
      '<option value="REEMBOLSOS">CORREO REEMBOLSOS</option>' +
      '<option value="SINIESTROS">CORREO SINIESTROS</option>' +
      '<option value="CREDITO HOSPITALARIO">CORREO CREDITO HOSPITALARIO</option>' +
      '<option value="CREDITO AMBULATORIO">CORREO CREDITO AMBULATORIO</option>' +
      '<option value="SINIESTROS HOGAR">CORREO SINIESTROS HOGAR</option>' +
      "</select>" +
      "</div>" +
      '<div class="form-group col-12 col-md-4 order-2 my-1 ' +
      estado +
      '">' +
      '<label for="txt_destinatario" class="control-label" style="text-align: right;">DESTINATARIO</label>' +
      "</div>" +
      '<div class="form-group col-12 col-md-4 order-6 my-1">' +
      '<input type="text" class="form-control validarNumerosLetras ingresar_destinatario" id="txt_destinatario' +
      numNuevoCorreo +
      '" placeholder="INGRESAR DESTINATARIO" autocomplete="off">' +
      "</div>" +
      '<div class="form-group col-12 col-md-4 order-3 my-1 ' +
      estado +
      '">' +
      '<label for="txt_correo" class="control-label" style="text-align: right;">CORREO ELECTRONICO</label>' +
      "</div>" +
      '<div class="form-group col-12 col-md-4 order-7 my-1">' +
      '<input type="text" class="form-control validarNumerosLetras ingresar_correo" id="txt_correo' +
      numNuevoCorreo +
      '" placeholder="INGRESAR CORREO" autocomplete="off">' +
      "</div>" +
      '<div class="my-1 col-12 col-md-1 order-4 my-1 ' +
      estado +
      '">' +
      "<label></label>" +
      "</div>" +
      '<div class="my-1 col-12 col-md-1 order-8 my-1">' +
      '<button type="button" class="form-control btn btn-danger quitarCorreo"  idCorreo="numNuevoCorreo' +
      numNuevoCorreo +
      '"><i class=" fa fa-times"></i></button>' +
      "</div>" +
      "</div>" +
      "</div>"
  );

  numNuevoCorreo++;
});

/*=============================================
QUITAR NUEVO CORREO
=============================================*/

var idQuitarNuevoCorreo = [];

localStorage.removeItem("quitarCorreo");

$(".listaNuevosCorreos").on("click", "button.quitarCorreo", function () {
  // $(this).parent().parent().parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  // $(this).parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  $(this).parent().parent().parent().remove();

  var idCorreo = $(this).attr("idCorreo");

  /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
    =============================================*/

  if (localStorage.getItem("quitarCorreo") == null) {
    idQuitarNuevoCorreo = [];
  } else {
    idQuitarNuevoCorreo.concat(localStorage.getItem("quitarCorreo"));
  }

  idQuitarNuevoCorreo.push({
    idCorreo: idCorreo,
  });

  localStorage.setItem("quitarCorreo", JSON.stringify(idQuitarNuevoCorreo));

  numNuevoCorreo--;

  if ($(".listaNuevosCorreos").children().length == 0) {
    $("#listaCorreoReembolsos").val("");
    $("#listaCorreoSiniestros").val("");
    $("#listaCorreoOperatorios").val("");
    $("#listaCorreoCreditoAmbulatorio").val("");
  } else {
    // AGRUPAR FAMILIARES EN FORMATO JSON
    listarNuevoCorreo();
  }
});

/*=============================================
LISTAR NUEVO CORREO
=============================================*/

function listarNuevoCorreo() {
  var listaCorreoReembolsos = [];
  var listaCorreoSiniestros = [];
  var listaCorreoOperatorios = [];
  var listaCorreoCreditosAmbulatorios = [];
  var listaCorreoSiniestroHogares = [];

  var tipo = $(".cbm_tipo_correo");
  var destinatario = $(".ingresar_destinatario");
  var correo = $(".ingresar_correo");

  for (var i = 0; i < tipo.length; i++) {
    switch ($(tipo[i]).val()) {
      case "REEMBOLSOS":
        listaCorreoReembolsos.push({
          tipo: $(tipo[i]).val(),
          destinatario: $(destinatario[i]).val().trim(),
          correo: $(correo[i]).val().trim(),
        });
        break;
      case "SINIESTROS":
        listaCorreoSiniestros.push({
          tipo: $(tipo[i]).val(),
          destinatario: $(destinatario[i]).val().trim(),
          correo: $(correo[i]).val().trim(),
        });
        break;
      case "CREDITO HOSPITALARIO":
        listaCorreoOperatorios.push({
          tipo: $(tipo[i]).val(),
          destinatario: $(destinatario[i]).val().trim(),
          correo: $(correo[i]).val().trim(),
        });
        break;
      case "CREDITO AMBULATORIO":
        listaCorreoCreditosAmbulatorios.push({
          tipo: $(tipo[i]).val(),
          destinatario: $(destinatario[i]).val().trim(),
          correo: $(correo[i]).val().trim(),
        });
        break;
      case "SINIESTROS HOGAR":
        listaCorreoSiniestroHogares.push({
          tipo: $(tipo[i]).val(),
          destinatario: $(destinatario[i]).val().trim(),
          correo: $(correo[i]).val().trim(),
        });
        break;

      default:
        break;
    }
  }

  if (listaCorreoReembolsos.length == 0) {
    $("#listaCorreoReembolsos").val("");
  } else {
    $("#listaCorreoReembolsos").val(JSON.stringify(listaCorreoReembolsos));
  }

  if (listaCorreoSiniestros.length == 0) {
    $("#listaCorreoSiniestros").val("");
  } else {
    $("#listaCorreoSiniestros").val(JSON.stringify(listaCorreoSiniestros));
  }

  if (listaCorreoOperatorios.length == 0) {
    $("#listaCorreoOperatorios").val("");
  } else {
    $("#listaCorreoOperatorios").val(JSON.stringify(listaCorreoOperatorios));
  }
  if (listaCorreoCreditosAmbulatorios.length == 0) {
    $("#listaCorreoCreditoAmbulatorio").val("");
  } else {
    $("#listaCorreoCreditoAmbulatorio").val(
      JSON.stringify(listaCorreoCreditosAmbulatorios)
    );
  }

  if (listaCorreoSiniestroHogares.length == 0) {
    $("#listaCorreoSiniestrosHogar").val("");
  } else {
    $("#listaCorreoSiniestrosHogar").val(
      JSON.stringify(listaCorreoSiniestroHogares)
    );
  }
}

/*********************************
ABRIR MODAL REGISTRO DE PROVEEDOR
*********************************/
function AbrirModalRegistro() {
  $("#modal_registro").modal({ backdrop: "static", keyboard: false });
  $("#modal_registro").modal("show");
  LimpiarRegistro();
}

/*********************************
LIMPIAR LOS REGISTROS
*********************************/
function LimpiarRegistro() {
  $("#txt_proveedor").val("");
  $("#txt_direccion_proveedor").val("");
  $(".listaNuevosCorreos").empty();
}

/*********************************
REGISTRAR UN NUEVO PROVEEDOR
*********************************/
function Registrar_Proveedor() {
  listarNuevoCorreo();
  var nombre = $("#txt_proveedor").val().toUpperCase();
  var direccion = $("#txt_direccion_proveedor").val().toUpperCase();
  var listaCorreoReembolsos = $("#listaCorreoReembolsos").val();
  var listaCorreoSiniestros = $("#listaCorreoSiniestros").val();
  var listaCorreoOperatorios = $("#listaCorreoOperatorios").val();
  var listaCorreoCreditoAmbulatorio = $("#listaCorreoCreditoAmbulatorio").val();
  var listaCorreoSiniestrosHogar = $("#listaCorreoSiniestrosHogar").val();

  var cont_reembolso = 0;
  var cont_siniestro = 0;
  var cont_operatorio = 0;
  var cont_credito_ambulatorio = 0;
  var cont_siniestro_hogar = 0;

  if (listaCorreoReembolsos.length > 0) {
    var data = JSON.parse(listaCorreoReembolsos);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var destinatario = data[i]["destinatario"];
        var correo = data[i]["correo"];

        if (
          destinatario.length == 0 ||
          correo.length == 0 ||
          validarEmail(correo) == 0
        ) {
          cont_reembolso++;
        }
      }
    }
  }

  if (listaCorreoSiniestros.length > 0) {
    var data = JSON.parse(listaCorreoSiniestros);
    if (data.length > 0) {
      for (var j = 0; j < data.length; j++) {
        var destinatario = data[j]["destinatario"];
        var correo = data[j]["correo"];

        if (
          destinatario.length == 0 ||
          correo.length == 0 ||
          validarEmail(correo) == 0
        ) {
          cont_siniestro++;
        }
      }
    }
  }

  if (listaCorreoOperatorios.length > 0) {
    var data = JSON.parse(listaCorreoOperatorios);
    if (data.length > 0) {
      for (var k = 0; k < data.length; k++) {
        var destinatario = data[k]["destinatario"];
        var correo = data[k]["correo"];

        if (
          destinatario.length == 0 ||
          correo.length == 0 ||
          validarEmail(correo) == 0
        ) {
          cont_operatorio++;
        }
      }
    }
  }

  if (listaCorreoCreditoAmbulatorio.length > 0) {
    var data = JSON.parse(listaCorreoCreditoAmbulatorio);
    if (data.length > 0) {
      for (var l = 0; l < data.length; l++) {
        var destinatario = data[l]["destinatario"];
        var correo = data[l]["correo"];

        if (
          destinatario.length == 0 ||
          correo.length == 0 ||
          validarEmail(correo) == 0
        ) {
          cont_credito_ambulatorio++;
        }
      }
    }
  }

  if (listaCorreoSiniestrosHogar.length > 0) {
    var data = JSON.parse(listaCorreoSiniestrosHogar);
    if (data.length > 0) {
      for (var l = 0; l < data.length; l++) {
        var destinatario = data[l]["destinatario"];
        var correo = data[l]["correo"];

        if (
          destinatario.length == 0 ||
          correo.length == 0 ||
          validarEmail(correo) == 0
        ) {
          cont_siniestro_hogar++;
        }
      }
    }
  }

  if (nombre.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_empty_fields', 'Fill in the empty fields'),
      "warning"
    );
  }

  if (listaCorreoReembolsos.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.must_create_reimbursement_email', 'You must create email for reimbursements'),
      "warning"
    );
  }

  if (listaCorreoSiniestros.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.must_create_claims_email', 'You must create email for claims'),
      "warning"
    );
  }

  if (listaCorreoOperatorios.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.must_create_hospital_credit_email', 'You must create email for hospital credit'),
      "warning"
    );
  }

  if (listaCorreoCreditoAmbulatorio.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.must_create_ambulatory_credit_email', 'You must create email for ambulatory credit'),
      "warning"
    );
  }
  if (listaCorreoSiniestrosHogar.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.must_create_home_claims_email', 'You must create email for home claims'),
      "warning"
    );
  }

  if (
    cont_reembolso > 0 ||
    cont_siniestro > 0 ||
    cont_operatorio > 0 ||
    cont_credito_ambulatorio > 0 ||
    cont_siniestro_hogar > 0
  ) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_empty_email_fields', 'Fill in the empty email fields'),
      "warning"
    );
  }

  var datos = new FormData();
  datos.append("nombre", nombre);
  datos.append("direccion", direccion);
  datos.append("listaCorreoReembolsos", listaCorreoReembolsos);
  datos.append("listaCorreoSiniestros", listaCorreoSiniestros);
  datos.append("listaCorreoOperatorios", listaCorreoOperatorios);
  datos.append("listaCorreoCreditoAmbulatorio", listaCorreoCreditoAmbulatorio);
  datos.append("listaCorreoSiniestrosHogar", listaCorreoSiniestrosHogar);

  $.ajax({
    url: "controller/proveedores/controlador_proveedor_registro.php",
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
            t('messages.new_provider_registered', 'Data correctly, New Provider Registered'),
            "success"
          ).then((value) => {
            LimpiarRegistro();
            table.ajax.reload();
          });
        } else {
          return Swal.fire(
            t('messages.warning', 'Warning Message'),
            t('messages.provider_already_exists', 'Sorry, provider already exists in our database'),
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
CARGAR DATOS EDITAR USUARIO
*********************************/
$("#tabla_proveedor").on("click", ".btnEditar", function () {
  var idProveedor = $(this).attr("idProveedor");

  $("#modal_editar").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar").modal("show");

  var datos = new FormData();
  datos.append("idProveedor", idProveedor);
  $.ajax({
    url: "controller/proveedores/controlador_traerdatos_proveedor.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      $("#txtidproveedor").val(data[0]["proveedor_id"]);
      $("#txt_proveedor_editar").val(data[0]["proveedor_descripcion"]);
      $("#txt_direccion_proveedor_editar").val(data[0]["proveedor_direccion"]);
      $("#listaCorreoEditarReembolsos").val(
        data[0]["proveedor_correo_reembolsos"]
      );
      $("#listaCorreoEditarSiniestros").val(
        data[0]["proveedor_correo_siniestros"]
      );
      $("#listaCorreoEditarOperatorios").val(
        data[0]["proveedor_correo_operatorios"]
      );
      $("#listaCorreoEditarCreditoAmbulatorio").val(
        data[0]["proveedor_correo_creditos_ambulatorios"]
      );
      $("#listaCorreoEditarSiniestrosHogar").val(
        data[0]["proveedor_correo_siniestros_hogar"]
      );
      $(".listaEditarCorreos").empty();
      agregar_correo_auto($("#listaCorreoEditarReembolsos").val());
      agregar_correo_auto($("#listaCorreoEditarSiniestros").val());
      agregar_correo_auto($("#listaCorreoEditarOperatorios").val());
      agregar_correo_auto($("#listaCorreoEditarCreditoAmbulatorio").val());
      agregar_correo_auto($("#listaCorreoEditarSiniestrosHogar").val());
    },
  });
});

$(".listaEditarCorreos").on("change", ".ingresar_correo_editar", function () {
  var email = $(this).val();
  if (email.length > 0) {
    if (validarEmail(email) == 0) {
      return Swal.fire(
        "Mensaje De Advertencia",
        "Favor de revisar, correo mal ingresado",
        "warning"
      );
    }
  }
});

/*=============================================
   AGREGANDO CORREOS AUTOMATICO PROVEEDOR
   =============================================*/

var numEditarCorreo = 0;

function agregar_correo_auto($lista) {
  if ($lista != "") {
    var data = JSON.parse($lista);

    for (let i = 0; i < data.length; i++) {
      var estado = "";

      if (numEditarCorreo > 0) {
        estado = "d-md-none";
      } else {
        estado = "";
      }

      $(".listaEditarCorreos").append(
        '<div class="col-12 my-1">' +
          '<div class="row gridEditarCorreo">' +
          '<div class="form-group col-12 col-md-3 order-1 my-1 ' +
          estado +
          '">' +
          '<label for="cbm_tipo_correo_editar" class="control-label" style="text-align: right;">TIPO CORREO</label>' +
          "</div>" +
          '<div class="form-group col-12 col-md-3 order-5 my-1">' +
          '<select class="form-control cbm_tipo_correo_editar js-example-basic-single" name="state" id="cbm_tipo_correo_editar' +
          numEditarCorreo +
          '" style="width:100%;">' +
          '<option value="REEMBOLSOS">CORREO REEMBOLSOS</option>' +
          '<option value="SINIESTROS">CORREO SINIESTROS</option>' +
          '<option value="CREDITO HOSPITALARIO">CREDITO HOSPITALARIO</option>' +
          '<option value="CREDITO AMBULATORIO">CREDITO AMBULATORIO</option>' +
          '<option value="SINIESTROS HOGAR">CORREO SINIESTROS HOGAR</option>' +
          "</select>" +
          "</div>" +
          '<div class="form-group col-12 col-md-4 order-2 my-1 ' +
          estado +
          '">' +
          '<label for="txt_destinatario_editar" class="control-label" style="text-align: right;">DESTINATARIO</label>' +
          "</div>" +
          '<div class="form-group col-12 col-md-4 order-6 my-1">' +
          '<input type="text" class="form-control validarNumerosLetras ingresar_destinatario_editar" id="txt_destinatario_editar' +
          numEditarCorreo +
          '" placeholder="INGRESAR DESTINATARIO" autocomplete="off">' +
          "</div>" +
          '<div class="form-group col-12 col-md-4 order-3 my-1 ' +
          estado +
          '">' +
          '<label for="txt_correo_editar" class="control-label" style="text-align: right;">CORREO ELECTRONICO</label>' +
          "</div>" +
          '<div class="form-group col-12 col-md-4 order-7 my-1">' +
          '<input type="text" class="form-control validarNumerosLetras ingresar_correo_editar" id="txt_correo_editar' +
          numEditarCorreo +
          '" placeholder="INGRESAR CORREO" autocomplete="off">' +
          "</div>" +
          '<div class="my-1 col-12 col-md-1 order-4 my-1 ' +
          estado +
          '">' +
          "<label></label>" +
          "</div>" +
          '<div class="my-1 col-12 col-md-1 order-8 my-1">' +
          '<button type="button" class="form-control btn btn-danger quitarEditarCorreo"  idCorreo="numEditarCorreo' +
          numEditarCorreo +
          '"><i class=" fa fa-times"></i></button>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      $("#cbm_tipo_correo_editar" + numEditarCorreo)
        .val(data[i]["tipo"])
        .change();
      $("#txt_destinatario_editar" + numEditarCorreo).val(
        data[i]["destinatario"]
      );
      $("#txt_correo_editar" + numEditarCorreo).val(data[i]["correo"]);

      numEditarCorreo++;
    }
  }
}

$(".btnAgregarEditarCorreo").click(function () {
  var estado = "";

  if (numEditarCorreo > 0) {
    estado = "d-md-none";
  } else {
    estado = "";
  }

  $(".listaEditarCorreos").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridEditarCorreo">' +
      '<div class="form-group col-12 col-md-3 order-1 my-1 ' +
      estado +
      '">' +
      '<label for="cbm_tipo_correo_editar" class="control-label" style="text-align: right;">TIPO CORREO</label>' +
      "</div>" +
      '<div class="form-group col-12 col-md-3 order-5 my-1">' +
      '<select class="form-control cbm_tipo_correo_editar js-example-basic-single" name="state" id="cbm_tipo_correo_editar' +
      numEditarCorreo +
      '" style="width:100%;">' +
      '<option value="REEMBOLSOS">CORREO REEMBOLSOS</option>' +
      '<option value="SINIESTROS">CORREO SINIESTROS</option>' +
      '<option value="CREDITO HOSPITALARIO">CREDITO HOSPITALARIO</option>' +
      '<option value="CREDITO AMBULATORIO">CREDITO AMBULATORIO</option>' +
      '<option value="SINIESTROS HOGAR">CORREO SINIESTROS HOGAR</option>' +
      "</select>" +
      "</div>" +
      '<div class="form-group col-12 col-md-4 order-2 my-1 ' +
      estado +
      '">' +
      '<label for="txt_destinatario_editar" class="control-label" style="text-align: right;">DESTINATARIO</label>' +
      "</div>" +
      '<div class="form-group col-12 col-md-4 order-6 my-1">' +
      '<input type="text" class="form-control validarNumerosLetras ingresar_destinatario_editar" id="txt_destinatario_editar' +
      numEditarCorreo +
      '" placeholder="INGRESAR DESTINATARIO" autocomplete="off">' +
      "</div>" +
      '<div class="form-group col-12 col-md-4 order-3 my-1 ' +
      estado +
      '">' +
      '<label for="txt_correo_editar" class="control-label" style="text-align: right;">CORREO ELECTRONICO</label>' +
      "</div>" +
      '<div class="form-group col-12 col-md-4 order-7 my-1">' +
      '<input type="text" class="form-control validarNumerosLetras ingresar_correo_editar" id="txt_correo_editar' +
      numEditarCorreo +
      '" placeholder="INGRESAR CORREO" autocomplete="off">' +
      "</div>" +
      '<div class="my-1 col-12 col-md-1 order-4 my-1 ' +
      estado +
      '">' +
      "<label></label>" +
      "</div>" +
      '<div class="my-1 col-12 col-md-1 order-8 my-1">' +
      '<button type="button" class="form-control btn btn-danger quitarCorreo"  idCorreo="numEditarCorreo' +
      numEditarCorreo +
      '"><i class=" fa fa-times"></i></button>' +
      "</div>" +
      "</div>" +
      "</div>"
  );

  numEditarCorreo++;
});

/*=============================================
QUITAR NUEVO CORREO
=============================================*/

var idQuitarEditarCorreo = [];

localStorage.removeItem("quitarEditarCorreo");

$(".listaEditarCorreos").on("click", "button.quitarEditarCorreo", function () {
  // $(this).parent().parent().parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  // $(this).parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  $(this).parent().parent().parent().remove();

  var idCorreo = $(this).attr("idCorreo");

  /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
    =============================================*/

  if (localStorage.getItem("quitarEditarCorreo") == null) {
    idQuitarEditarCorreo = [];
  } else {
    idQuitarEditarCorreo.concat(localStorage.getItem("quitarEditarCorreo"));
  }

  idQuitarEditarCorreo.push({
    idCorreo: idCorreo,
  });

  localStorage.setItem(
    "quitarEditarCorreo",
    JSON.stringify(idQuitarEditarCorreo)
  );

  numNuevoCorreo--;

  if ($(".listaEditarCorreos").children().length == 0) {
    $("#listaCorreoEditarReembolsos").val("");
    $("#listaCorreoEditarSiniestros").val("");
    $("#listaCorreoEditarOperatorios").val("");
    $("#listaCorreoEditarSiniestrosHogar").val("");
  } else {
    // AGRUPAR FAMILIARES EN FORMATO JSON
    listarEditarCorreo();
  }
});

/*=============================================
LISTAR EDITAR CORREO
=============================================*/

function listarEditarCorreo() {
  var listaCorreoReembolsos = [];
  var listaCorreoSiniestros = [];
  var listaCorreoOperatorios = [];
  var listaCorreoCreditoAmbulatorio = [];
  var listaCorreoSiniestrosHogares = [];

  var tipo = $(".cbm_tipo_correo_editar");
  var destinatario = $(".ingresar_destinatario_editar");
  var correo = $(".ingresar_correo_editar");

  for (var i = 0; i < tipo.length; i++) {
    switch ($(tipo[i]).val()) {
      case "REEMBOLSOS":
        listaCorreoReembolsos.push({
          tipo: $(tipo[i]).val(),
          destinatario: $(destinatario[i]).val().trim(),
          correo: $(correo[i]).val().trim(),
        });
        break;
      case "SINIESTROS":
        listaCorreoSiniestros.push({
          tipo: $(tipo[i]).val(),
          destinatario: $(destinatario[i]).val().trim(),
          correo: $(correo[i]).val().trim(),
        });
        break;
      case "CREDITO HOSPITALARIO":
        listaCorreoOperatorios.push({
          tipo: $(tipo[i]).val(),
          destinatario: $(destinatario[i]).val().trim(),
          correo: $(correo[i]).val().trim(),
        });
        break;
      case "CREDITO AMBULATORIO":
        listaCorreoCreditoAmbulatorio.push({
          tipo: $(tipo[i]).val(),
          destinatario: $(destinatario[i]).val().trim(),
          correo: $(correo[i]).val().trim(),
        });
        break;
      case "SINIESTROS HOGAR":
        listaCorreoSiniestrosHogares.push({
          tipo: $(tipo[i]).val(),
          destinatario: $(destinatario[i]).val().trim(),
          correo: $(correo[i]).val().trim(),
        });
        break;
      default:
        break;
    }
  }

  if (listaCorreoReembolsos.length == 0) {
    $("#listaCorreoEditarReembolsos").val("");
  } else {
    $("#listaCorreoEditarReembolsos").val(
      JSON.stringify(listaCorreoReembolsos)
    );
  }

  if (listaCorreoSiniestros.length == 0) {
    $("#listaCorreoEditarSiniestros").val("");
  } else {
    $("#listaCorreoEditarSiniestros").val(
      JSON.stringify(listaCorreoSiniestros)
    );
  }

  if (listaCorreoOperatorios.length == 0) {
    $("#listaCorreoEditarOperatorios").val("");
  } else {
    $("#listaCorreoEditarOperatorios").val(
      JSON.stringify(listaCorreoOperatorios)
    );
  }

  if (listaCorreoCreditoAmbulatorio.length == 0) {
    $("#listaCorreoEditarCreditoAmbulatorio").val("");
  } else {
    $("#listaCorreoEditarCreditoAmbulatorio").val(
      JSON.stringify(listaCorreoCreditoAmbulatorio)
    );
  }

  if (listaCorreoSiniestrosHogares.length == 0) {
    $("#listaCorreoEditarSiniestrosHogar").val("");
  } else {
    $("#listaCorreoEditarSiniestrosHogar").val(
      JSON.stringify(listaCorreoSiniestrosHogares)
    );
  }
}

/*********************************
MODIFICAR DATOS PROVEEDOR
*********************************/
function Modificar_Proveedor() {
  listarEditarCorreo();
  var idProveedor = $("#txtidproveedor").val();
  var nombre = $("#txt_proveedor_editar").val().toUpperCase();
  var direccion = $("#txt_direccion_proveedor_editar").val().toUpperCase();
  var listaCorreoReembolsos = $("#listaCorreoEditarReembolsos").val();
  var listaCorreoSiniestros = $("#listaCorreoEditarSiniestros").val();
  var listaCorreoOperatorios = $("#listaCorreoEditarOperatorios").val();
  var listaCorreoCreditoAmbulatorio = $(
    "#listaCorreoEditarCreditoAmbulatorio"
  ).val();
  var listaCorreoSiniestrosHogar = $("#listaCorreoEditarSiniestrosHogar").val();

  var cont_reembolso = 0;
  var cont_siniestro = 0;
  var cont_operatorio = 0;
  var cont_credito_ambulatorio = 0;
  var cont_siniestro_hogar = 0;

  if (listaCorreoReembolsos.length > 0) {
    var data = JSON.parse(listaCorreoReembolsos);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var destinatario = data[i]["destinatario"];
        var correo = data[i]["correo"];

        if (
          destinatario.length == 0 ||
          correo.length == 0 ||
          validarEmail(correo) == 0
        ) {
          cont_reembolso++;
        }
      }
    }
  }

  if (listaCorreoSiniestros.length > 0) {
    var data = JSON.parse(listaCorreoSiniestros);
    if (data.length > 0) {
      for (var j = 0; j < data.length; j++) {
        var destinatario = data[j]["destinatario"];
        var correo = data[j]["correo"];

        if (
          destinatario.length == 0 ||
          correo.length == 0 ||
          validarEmail(correo) == 0
        ) {
          cont_siniestro++;
        }
      }
    }
  }

  if (listaCorreoOperatorios.length > 0) {
    var data = JSON.parse(listaCorreoOperatorios);
    if (data.length > 0) {
      for (var k = 0; k < data.length; k++) {
        var destinatario = data[k]["destinatario"];
        var correo = data[k]["correo"];

        if (
          destinatario.length == 0 ||
          correo.length == 0 ||
          validarEmail(correo) == 0
        ) {
          cont_operatorio++;
        }
      }
    }
  }

  if (listaCorreoCreditoAmbulatorio.length > 0) {
    var data = JSON.parse(listaCorreoCreditoAmbulatorio);
    if (data.length > 0) {
      for (var l = 0; l < data.length; l++) {
        var destinatario = data[l]["destinatario"];
        var correo = data[l]["correo"];

        if (
          destinatario.length == 0 ||
          correo.length == 0 ||
          validarEmail(correo) == 0
        ) {
          cont_credito_ambulatorio++;
        }
      }
    }
  }

  if (listaCorreoSiniestrosHogar.length > 0) {
    var data = JSON.parse(listaCorreoSiniestrosHogar);
    if (data.length > 0) {
      for (var j = 0; j < data.length; j++) {
        var destinatario = data[j]["destinatario"];
        var correo = data[j]["correo"];

        if (
          destinatario.length == 0 ||
          correo.length == 0 ||
          validarEmail(correo) == 0
        ) {
          cont_siniestro_hogar++;
        }
      }
    }
  }

  if (nombre.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios",
      "warning"
    );
  }

  if (listaCorreoReembolsos.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Debe crear correo para reembolsos",
      "warning"
    );
  }

  if (listaCorreoSiniestros.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Debe crear correo para siniestros",
      "warning"
    );
  }

  if (listaCorreoOperatorios.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Debe crear correo para credito hospitalario",
      "warning"
    );
  }

  if (listaCorreoCreditoAmbulatorio.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Debe crear correo para credito ambulatorio",
      "warning"
    );
  }

  if (listaCorreoSiniestrosHogar.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Debe crear correo para siniestros hogar",
      "warning"
    );
  }

  if (
    cont_reembolso > 0 ||
    cont_siniestro > 0 ||
    cont_operatorio > 0 ||
    cont_credito_ambulatorio > 0 ||
    cont_siniestro_hogar > 0
  ) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos de correo vacios",
      "warning"
    );
  }

  var datos = new FormData();
  datos.append("idProveedor", idProveedor);
  datos.append("nombre", nombre);
  datos.append("direccion", direccion);
  datos.append("listaCorreoReembolsos", listaCorreoReembolsos);
  datos.append("listaCorreoSiniestros", listaCorreoSiniestros);
  datos.append("listaCorreoOperatorios", listaCorreoOperatorios);
  datos.append("listaCorreoCreditoAmbulatorio", listaCorreoCreditoAmbulatorio);
  datos.append("listaCorreoSiniestrosHogar", listaCorreoSiniestrosHogar);

  $.ajax({
    url: "controller/proveedores/controlador_proveedor_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data["valor"] > 0) {
        if (data["valor"] == 1) {
          $("#modal_editar").modal("hide");
          Swal.fire(
            "Mensaje De Confirmacion",
            "Datos Actualizados Correctamente",
            "success"
          ).then((value) => {
            table.ajax.reload();
          });
        } else {
          return Swal.fire(
            "Mensaje De Advertencia",
            "Lo sentimos, el proveedor ya se encuentra en nuestra base de datos",
            "warning"
          );
        }
      } else {
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
      }
    },
  });
}
