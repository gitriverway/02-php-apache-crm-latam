$(document).on("hidden.bs.modal", function (event) {
  if ($(".modal:visible").length) {
    $("body").addClass("modal-open");
  }
});
// function lista1() {
//   $.ajax({
//     url: "controller/creditos-ambulatorios-clientes/controlador_credito_ambulatorio_asistencia_medica_individual_listar.php",
//     method: "POST",
//     cache: false,
//     contentType: false,
//     processData: false,
//     success: function (respuesta) {
//       console.log(respuesta);
//     },
//   });
// }

if (window.matchMedia("(max-width:767px)").matches) {
  $(
    "#tabla-listar-creditos-ambulatorios-asistencia-medica-individual"
  ).removeClass("nowrap");
  $(
    "#tabla-listar-creditos-ambulatorios-asistencia-medica-individual"
  ).addClass("dt-responsive");
} else {
  $(
    "#tabla-listar-creditos-ambulatorios-asistencia-medica-individual"
  ).removeClass("dt-responsive");
  $(
    "#tabla-listar-creditos-ambulatorios-asistencia-medica-individual"
  ).addClass("nowrap");
}

var table_listar_creditos_ambulatorios_asistencia_medica_individual;
function listar_creditos_ambulatorios_asistencia_medica_individual() {
  table_listar_creditos_ambulatorios_asistencia_medica_individual = $(
    "#tabla-listar-creditos-ambulatorios-asistencia-medica-individual"
  ).DataTable({
    scrollX: true,
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
        searching: true,
      },
    },
    // "dom": "Plfrtip",
    dom: "PBfrtip",
    columnDefs: [
      {
        searchPanes: {
          show: true,
        },
        targets: [3, 4, 9],
      },
      {
        searchPanes: {
          show: false,
        },
        targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17],
      },
    ],
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
    ajax: "controller/creditos-ambulatorios-clientes/controlador_credito_ambulatorio_asistencia_medica_individual_listar.php",
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      for (var i = 0; i <= 17; i++) {
        $($(nRow).find("td")[i]).css("text-align", "center");
      }
    },
    language: idioma_espanol,
  });
}

function fecha_actual() {
  var fecha_actual_obervacion;

  $.ajax({
    url: "controller/controlador_fecha_actual_zona_horario.php",
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    success: function (respuesta) {
      fecha_actual_obervacion = respuesta;
    },
  });
  return fecha_actual_obervacion;
}

/*********************************
 ABRIR MODAL OBSERVACIONES CREDITO AMBULATORIO
 *********************************/
var numObservacion = 0;
$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnVerObservaciones",
  function () {
    $("#modalObservaciones").modal({ backdrop: "static", keyboard: false });
    $("#modalObservaciones").modal("show");

    numObservacion = 0;

    $("#todoObservaciones").empty();

    var idCreditoAmbulatorio = $(this).attr("idCreditoAmbulatorio");
    var paciente = $(this).attr("paciente");

    $("#ObservacionesPaciente").text(paciente);

    var datos = new FormData();

    datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);

    $.ajax({
      url: "controller/creditos-ambulatorios-clientes/controlador_observacion_credito_ambulatorio_adicionales_listar.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        var data = JSON.parse(respuesta);

        if (data.length > 0) {
          $("#listaObservaciones").val(
            data[0]["credito_ambulatorio_observacion_descripcion"]
          );

          var data1 = JSON.parse($("#listaObservaciones").val());

          for (let i = 0; i < data1.length; i++) {
            numObservacion++;

            var estado = "";

            if (numObservacion > 1) {
              estado = "d-md-none";
            } else {
              estado = "";
            }

            $("#todoObservaciones").append(
              '<div class="col-12 my-1">' +
                '<div class="row col-12">' +
                "<!-- Fecha de Registro -->" +
                '<div class="col-6 col-lg-3 order-md-1 my-1 ' +
                estado +
                ' etiquetaFechaObservacion" id="etiquetaFechaObservacion' +
                numObservacion +
                '" style="padding-right:0px">' +
                "<label>Fecha Registro</label>" +
                "</div>" +
                '<div class="col-6 col-lg-3 order-md-3 my-1" style="padding-right:0px">' +
                '<div class="input-group">' +
                '<label class="fecha_registro" id="fecha_registro' +
                numObservacion +
                '" name="fecha_registro' +
                numObservacion +
                '">' +
                data1[i]["fecha_registro"] +
                "</label>" +
                "</div>" +
                "</div>" +
                "<!-- Observacion -->" +
                '<div class="col-6 col-lg-9 order-md-2 my-1 ' +
                estado +
                ' etiquetaDescripcionObservacion" id="etiquetaDescripcionObservacion' +
                numObservacion +
                '">' +
                "<label>Observaci&oacute;n</label>" +
                "</div>" +
                '<div class="col-6 col-lg-9 order-md-4 my-1">' +
                '<label class="observacion" id="observacion' +
                numObservacion +
                '" name="observacion' +
                numObservacion +
                '">' +
                data1[i]["observaciones"] +
                "</label>" +
                "</div>" +
                "</div>" +
                "</div>"
            );
          }
        } else {
          $("#todoObservaciones").append(
            '<div class="col-12 my-1">' + "<p>SIN REGISTROS</p>" + '</div">'
          );
        }
      },
    });
  }
);

$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnVerDocumento",
  function () {
    var documentoRuta = $(this).attr("ruta");
    window.open(documentoRuta, "Documento", "width=1024,height=1024");
  }
);

$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnVerDocumentoAdicional",
  function () {
    var documentoRuta = $(this).attr("ruta");
    window.open(documentoRuta, "Documento Adicional", "width=1024,height=1024");
  }
);

$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnVerDocumentoSeguimiento",
  function () {
    var documentoRuta = $(this).attr("ruta");
    window.open(
      documentoRuta,
      "Documento Seguimiento",
      "width=1024,height=1024"
    );
  }
);

$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnVerDocumentoAutorizacion",
  function () {
    var documentoRuta = $(this).attr("ruta");
    window.open(
      documentoRuta,
      "Documento Autorización",
      "width=1024,height=1024"
    );
  }
);

$(".subirDocumento").change(function () {
  var documento = this.files[0];

  // Tamaño correcto en bytes (25MB reales)
  var maxSizeMB = 25;
  var maxSizeBytes = maxSizeMB * 1024 * 1024;
  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

  if (documento["type"] != "application/pdf") {
    $(".subirDocumento").val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir el documento",
      text: "¡El documento debe estar en formato PDF!",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (documento["size"] > maxSizeBytes) {
    $(".subirDocumento").val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir el documento",
      text: "¡El documento no debe pesar más de " + maxSizeMB + "MB!",
      confirmButtonText: "¡Cerrar!",
    });
  }
});

/*=============================================
    LISTAR VALIDAR DATOS CREDITO AMBULATORIO
  =============================================*/

function listarValidaDatosCreditoAmbulatorio() {
  var listaValidarDatosCreditoAmbulatorio = [];

  var etiquetas = $(".etiquetaRadioValidar");

  for (var i = 1; i <= etiquetas.length; i++) {
    var documento = $("#etiquetaRadioValidar" + i).val();
    var radio = $("input:radio[name=radio_" + i + "]:checked").val();

    listaValidarDatosCreditoAmbulatorio.push({
      documento: documento,
      estado: radio,
    });
  }

  $("#listaValidarDatosCreditoAmbulatorio").val(
    JSON.stringify(listaValidarDatosCreditoAmbulatorio)
  );
}

/*=============================================
    LISTAR OBSERVACIONES VALIDAR DATOS CREDITO AMBULATORIO
  =============================================*/

function listarObservacionesvalidarDatosCreditoAmbulatorio() {
  var listaObservacionesDatosCreditoAmbulatorio = [];

  var observaciones = $("#txt_observaciones_credito_ambulatorio")
    .val()
    .toUpperCase();

  listaObservacionesDatosCreditoAmbulatorio.push({
    fecha_registro: fecha_actual(),
    observaciones: observaciones,
  });

  $("#listaObservacionesDatosCreditoAmbulatorio").val(
    JSON.stringify(listaObservacionesDatosCreditoAmbulatorio)
  );

  const reg = /\\n/g;
  var str = $("#listaObservacionesDatosCreditoAmbulatorio").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesDatosCreditoAmbulatorio").val(newStr);
}
/*=============================================
  ACTUALIZAR LISTADO DATOS CREDITO AMBULATORIO
  =============================================*/

/*=============================================
  CAMBIOS EN RADIO VALIDAR
  =============================================*/
$(".validarDatosCreditoAmbulatorio").on(
  "change",
  "input.radio_validacion",
  function () {
    listarValidaDatosCreditoAmbulatorio();
  }
);

/*=============================================
  CAMBIOS EN FECHA DE SEGUIMIENTO
  =============================================*/
$(".validarDatosCreditoAmbulatorio").on(
  "change",
  "input.fecha_seguimiento_validar",
  function () {
    listarValidaDatosCreditoAmbulatorio();
  }
);

/*=============================================
  CAMBIOS EN OBSERVACIONES
  =============================================*/
$(".validarDatosCreditoAmbulatorio").on(
  "keyup",
  "textarea.observaciones_credito_ambulatorio",
  function () {
    listarValidaDatosCreditoAmbulatorio();
  }
);

/*********************************
 ABRI MODAL VALIDAR CREDITO AMBULATORIO
 *********************************/
$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnValidarDocumentosCreditoAmbulatorio",
  function () {
    var idCreditoAmbulatorio = $(this).attr("idCreditoAmbulatorio");
    var idContrato = $(this).attr("idContrato");

    $("#txt_idCreditoAmbulatorio").val(idCreditoAmbulatorio);
    $("#txt_idContrato").val(idContrato);

    var paciente = $(this).attr("paciente");

    $("#modificarCreditoAmbulatorioPaciente").text(paciente);

    $("#modalModificarCreditoAmbulatorio").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalModificarCreditoAmbulatorio").modal("show");
    Limpiar_Validar_Credito_Ambulatorio();
    listarValidaDatosCreditoAmbulatorio();
  }
);

function Limpiar_Validar_Credito_Ambulatorio() {
  $("#radio_solicitud_2").prop("checked", true);
  $("#radio_pedido_examenes_2").prop("checked", true);
  $("#radio_pedido_rehabilitacion_2").prop("checked", true);
  $("#txt_fecha_seguimiento_validar").val("");
  $("#txt_observaciones_credito_ambulatorio").val("");
  $("#listaObservacionesDatosCreditoAmbulatorio").val("");
}

function crear_overlay_validar_credito_ambulatorio_asistencia_medica() {
  $("#modalValidarDocumentosCreditoAmbulatorio").append(
    '<div class="overlay dark" id="overlayValidarDocumentoCreditoAmbulatorio"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_validar_credito_ambulatorio_asistencia_medica() {
  $("#overlayValidarDocumentoCreditoAmbulatorio").remove();
}

/*********************************
   MODIFICAR VALIDAR CREDITO AMBULATORIO
   *********************************/
function Modificar_Validar_Credito_Ambulatorio() {
  listarObservacionesvalidarDatosCreditoAmbulatorio();

  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();
  var listaValidarDatosCreditoAmbulatorio = $(
    "#listaValidarDatosCreditoAmbulatorio"
  ).val();
  var fecha_seguimiento_validar = $("#txt_fecha_seguimiento_validar").val();
  var listaObservacionesDatosCreditoAmbulatorio = $(
    "#listaObservacionesDatosCreditoAmbulatorio"
  ).val();
  var cont = 0;
  var cont1 = 0;

  if (listaValidarDatosCreditoAmbulatorio.length > 0) {
    var data = JSON.parse(listaValidarDatosCreditoAmbulatorio);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var estado = data[i]["estado"];
        if (estado == "NO") {
          cont++;
        }
      }
    }
  }
  if (listaObservacionesDatosCreditoAmbulatorio.length > 0) {
    var data1 = JSON.parse(listaObservacionesDatosCreditoAmbulatorio);
    if (data1.length > 0) {
      for (var i = 0; i < data1.length; i++) {
        var observacion = data1[i]["observaciones"];

        if (observacion.length > 0) {
          cont1++;
        }
      }
    }
  }

  if (listaValidarDatosCreditoAmbulatorio.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Selecciones los distintos documentos",
      "warning"
    );
  }

  if (fecha_seguimiento_validar.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Selecciones la fecha de seguimiento",
      "warning"
    );
  }

  if (cont1 == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar una observaci&oacute;n",
      "warning"
    );
  }

  crear_overlay_validar_credito_ambulatorio_asistencia_medica();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);
  datos.append(
    "listaValidarDatosCreditoAmbulatorio",
    listaValidarDatosCreditoAmbulatorio
  );
  datos.append("fecha_seguimiento_validar", fecha_seguimiento_validar);
  datos.append(
    "listaObservacionesDatosCreditoAmbulatorio",
    listaObservacionesDatosCreditoAmbulatorio
  );
  datos.append("contar_validar", cont);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_credito_ambulatorio_asistencia_medica_individual_validar_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Validar Credito Ambulatorio Modificado Exitosamente",
          "success"
        ).then((value) => {
          $("#modalModificarCreditoAmbulatorio").modal("hide");
          table_listar_creditos_ambulatorios_asistencia_medica_individual.ajax.reload();
        });
      }
      eliminar_overlay_validar_credito_ambulatorio_asistencia_medica();
    },
  });
}

/*********************************
 ABRIR MODAL OBSERVACIONES ADICIONALES SEGUIMIENTO CREDITO AMBULATORIO
 *********************************/
$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnAgregarObservacionesAdicionales",
  function () {
    var idCreditoAmbulatorio = $(this).attr("idCreditoAmbulatorio");
    var idContrato = $(this).attr("idContrato");
    $("#txt_idCreditoAmbulatorio").val(idCreditoAmbulatorio);
    $("#txt_idContrato").val(idContrato);

    var paciente = $(this).attr("paciente");

    $("#agregarObservacionAdicionalCreditoAmbulatorioPaciente").text(paciente);

    $("#modalAgregarObservacionAdicionalCreditoAmbulatorio").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarObservacionAdicionalCreditoAmbulatorio").modal("show");

    $("#txt_fecha_seguimiento_observacion_adicional").val("");
    $("#txt_observaciones_adicionales_seguimiento_credito_ambulatorio").val("");

    Cargar_Observaciones_Adicionales_Seguimientos_Creditos_Ambulatorios();
  }
);

function Cargar_Observaciones_Adicionales_Seguimientos_Creditos_Ambulatorios() {
  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_observacion_credito_ambulatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $(
          "#listaObservacionesAdicionalesSeguimientosCreditoAmbulatorioAnterior"
        ).val(data[0]["credito_ambulatorio_observacion_descripcion"]);
      } else {
        $(
          "#listaObservacionesAdicionalesSeguimientosCreditoAmbulatorioAnterior"
        ).val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES SEGUIMIENTOS PEDIDO CREDITO AMBULATORIO
    =============================================*/

function listarObservacionesAdicionalesSeguimientoCreditoAmbulatorio() {
  if (
    $("#txt_observaciones_adicionales_seguimiento_credito_ambulatorio").val()
      .length > 0
  ) {
    var listaObservacionesAdicionalesSeguimientosCreditoAmbulatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesAdicionalesSeguimientosCreditoAmbulatorioAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $(
          "#listaObservacionesAdicionalesSeguimientosCreditoAmbulatorioAnterior"
        ).val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesAdicionalesSeguimientosCreditoAmbulatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $(
      "#txt_observaciones_adicionales_seguimiento_credito_ambulatorio"
    )
      .val()
      .toUpperCase();

    listaObservacionesAdicionalesSeguimientosCreditoAmbulatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesAdicionalesSeguimientosCreditoAmbulatorio").val(
      JSON.stringify(
        listaObservacionesAdicionalesSeguimientosCreditoAmbulatorio
      )
    );
  } else {
    $("#listaObservacionesAdicionalesSeguimientosCreditoAmbulatorio").val(
      $(
        "#listaObservacionesAdicionalesSeguimientosCreditoAmbulatorioAnterior"
      ).val()
    );
  }

  const reg = /\\n/g;
  var str = $(
    "#listaObservacionesAdicionalesSeguimientosCreditoAmbulatorio"
  ).val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesAdicionalesSeguimientosCreditoAmbulatorio").val(newStr);
}

function Modificar_Observaciones_adicionales_Seguimiento_Credito_Ambulatorio() {
  listarObservacionesAdicionalesSeguimientoCreditoAmbulatorio();

  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();
  var fecha_seguimiento = $(
    "#txt_fecha_seguimiento_observacion_adicional"
  ).val();
  var observacion = $(
    "#txt_observaciones_adicionales_seguimiento_credito_ambulatorio"
  ).val();
  var lista_observaciones_adicionales = $(
    "#listaObservacionesAdicionalesSeguimientosCreditoAmbulatorio"
  ).val();

  if (fecha_seguimiento.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Selecciones la fecha de seguimiento",
      "warning"
    );
  }

  if (observacion.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar una observaci&oacute;n",
      "warning"
    );
  }

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "lista_observaciones_adicionales",
    lista_observaciones_adicionales
  );

  $.ajax({
    url: "controller/creditos-ambulatorios-observaciones/controlador_credito_ambulatorio_asistencia_medica_individual_observaciones_adicionales_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Nueva Observación agregada",
          "success"
        ).then((value) => {
          $("#modalAgregarObservacionAdicionalCreditoAmbulatorio").modal(
            "hide"
          );
          table_listar_creditos_ambulatorios_asistencia_medica_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRAR SOLICTAR DOCUMENTOS FALTANTES SEGUIMIENTO
 *********************************/
$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnSeguimientoCreditoAmbulatorioAseguradora",
  function () {
    $("#modalAgregarSeguimientoCreditoAmbulatorio").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarSeguimientoCreditoAmbulatorio").modal("show");
    var idCreditoAmbulatorio = $(this).attr("idCreditoAmbulatorio");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarSeguimientoCreditoAmbulatorioPaciente").text(paciente);
    $("#txt_idCreditoAmbulatorio").val(idCreditoAmbulatorio);
    $("#txt_idContrato").val(idContrato);
    $("#enviarEmail").prop("checked", true);
    $("#txt_fecha_seguimiento").val("");
    $("#listaDocumentosSolicitadosAseguradora").val("");
    $(".seguimientoDatosCreditoAmbulatorio").empty();
    Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos();
    Cargar_Observaciones_Seguimientos();
    listarObservacionesSeguimientoCreditoAmbulatorio();
  }
);

function Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos() {
  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_documentos_adicionales_solictados_aseguradora_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaDocumentosSolicitadosAseguradoraAnterior").val(
          data[0]["credito_ambulatorio_documentos_seguimiento"]
        );
      } else {
        $("#listaDocumentosSolicitadosAseguradoraAnterior").val("");
      }
      cargar_auto_documentos_aseguradora();
    },
  });
}

function cargar_auto_documentos_aseguradora() {
  numDocumentosRequeridosAseguradora = 0;

  var lista_documentos_adicionales = $(
    "#listaDocumentosSolicitadosAseguradoraAnterior"
  ).val();

  if (lista_documentos_adicionales.length > 0) {
    lista_documentos_adicionales = JSON.parse(
      $("#listaDocumentosSolicitadosAseguradoraAnterior").val()
    );

    for (let i = 0; i < lista_documentos_adicionales.length; i++) {
      var estado = "";
      var estado_si = "";
      var estado_no = "";

      if (numDocumentosRequeridosAseguradora > 0) {
        estado = "d-md-none";
      } else {
        estado = "";
      }

      if (lista_documentos_adicionales[i]["estado"] == "SI") {
        estado_si = "checked";
        estado_no = "";
      } else {
        estado_si = "";
        estado_no = "checked";
      }

      $(".seguimientoDatosCreditoAmbulatorio").append(
        '<div class="col-12 my-1">' +
          '<div class="row gridSeguimientoCreditoAmbulatorio">' +
          "<!-- Documento -->" +
          '<div class="my-1 col-12 col-md-6 order-md-1 ' +
          estado +
          '">' +
          "<label>Documento</label>" +
          "</div>" +
          '<div class="my-1 col-12 col-md-6 order-md-5">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras documentoRequerido" id="documentoRequerido' +
          numDocumentosRequeridosAseguradora +
          '" name="documentoRequerido' +
          numDocumentosRequeridosAseguradora +
          '" placeholder="DOCUMENTO REQUERIDO" autocomplete="off" style="text-transform: uppercase" value = "' +
          lista_documentos_adicionales[i]["documento"] +
          '"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Confirmacion SI -->" +
          '<div class="my-1 col-6 col-md-2 order-md-2 ' +
          estado +
          '">' +
          "<label>SI</label>" +
          "</div>" +
          '<div class="my-1 col-6 col-md-2 order-md-6">' +
          '<div class="form-check">' +
          '<input class="form-check-input radio_seguimiento_si" type="radio" name="radio_seguimiento_' +
          numDocumentosRequeridosAseguradora +
          '" value="SI" ' +
          estado_si +
          ">" +
          "</div>" +
          "</div>" +
          "<!-- Confirmacion NO -->" +
          '<div class="my-1 col-6 col-md-2 order-md-3 ' +
          estado +
          '">' +
          "<label>NO</label>" +
          "</div>" +
          '<div class="my-1 col-6 col-md-2 order-md-7">' +
          '<div class="form-check">' +
          '<input class="form-check-input radio_seguimiento_no" type="radio" name="radio_seguimiento_' +
          numDocumentosRequeridosAseguradora +
          '" value="NO" ' +
          estado_no +
          ">" +
          "</div>" +
          "</div>" +
          "<!-- Acciones -->" +
          '<div class="my-1 col-12 col-md-2 order-md-4 ' +
          estado +
          '">' +
          "<label></label>" +
          "</div>" +
          '<div class="my-1 col-12 col-md-2 order-md-8">' +
          '<button type="button" class="form-control btn btn-danger quitarDocumento idDocumento="' +
          numDocumentosRequeridosAseguradora +
          '"><i class="fa fa-times"></i></button>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      numDocumentosRequeridosAseguradora++;
    }

    listarDocumentosAseguradora();
  }
}

function listarDocumentosAseguradora() {
  var listaDocumentosSolicitadosAseguradora = [];

  var documento = $(".documentoRequerido");
  var estado = $(".radio_seguimiento_si");
  var valor = "";

  for (var i = 0; i < documento.length; i++) {
    if ($(estado[i]).is(":checked")) {
      valor = "SI";
    } else {
      valor = "NO";
    }

    listaDocumentosSolicitadosAseguradora.push({
      documento: $(documento[i]).val().toUpperCase(),
      estado: valor,
    });
  }

  $("#listaDocumentosSolicitadosAseguradora").val(
    JSON.stringify(listaDocumentosSolicitadosAseguradora)
  );
}

function Cargar_Observaciones_Seguimientos() {
  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_observacion_credito_ambulatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesSeguimientosCreditoAmbulatorioAnterior").val(
          data[0]["credito_ambulatorio_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesSeguimientosCreditoAmbulatorioAnterior").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES SEGUIMIENTOS CREDITO AMBULATORIO
    =============================================*/

function listarObservacionesSeguimientoCreditoAmbulatorio() {
  if (
    $("#txt_observaciones_seguimiento_credito_ambulatorio").val().length > 0
  ) {
    var listaObservacionesSeguimientosCreditoAmbulatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesSeguimientosCreditoAmbulatorioAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesSeguimientosCreditoAmbulatorioAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesSeguimientosCreditoAmbulatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_seguimiento_credito_ambulatorio")
      .val()
      .toUpperCase();

    listaObservacionesSeguimientosCreditoAmbulatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesSeguimientosCreditoAmbulatorio").val(
      JSON.stringify(listaObservacionesSeguimientosCreditoAmbulatorio)
    );
  } else {
    $("#listaObservacionesSeguimientosCreditoAmbulatorio").val(
      $("#listaObservacionesSeguimientosCreditoAmbulatorioAnterior").val()
    );
  }
  const reg = /\\n/g;
  var str = $("#listaObservacionesSeguimientosCreditoAmbulatorio").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesSeguimientosCreditoAmbulatorio").val(newStr);
}

/*=============================================
    AGREGANDO DOCUMENTOS REQUERIDOS ASEGURADORA
    =============================================*/

var numDocumentosRequeridosAseguradora = 0;

$(".btnAgregarDocumentoRequeridoAseguradora").click(function () {
  var estado = "";

  if (numDocumentosRequeridosAseguradora > 0) {
    estado = "d-md-none";
  } else {
    estado = "";
  }

  $(".seguimientoDatosCreditoAmbulatorio").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridSeguimientoCreditoAmbulatorio">' +
      "<!-- Documento -->" +
      '<div class="my-1 col-12 col-md-6 order-md-1 ' +
      estado +
      '">' +
      "<label>Documento</label>" +
      "</div>" +
      '<div class="my-1 col-12 col-md-6 order-md-5">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumerosLetras documentoRequerido" id="documentoRequerido' +
      numDocumentosRequeridosAseguradora +
      '" name="documentoRequerido' +
      numDocumentosRequeridosAseguradora +
      '" placeholder="DOCUMENTO REQUERIDO" autocomplete="off" style="text-transform: uppercase"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Confirmacion SI -->" +
      '<div class="my-1 col-6 col-md-2 order-md-2 ' +
      estado +
      '">' +
      "<label>SI</label>" +
      "</div>" +
      '<div class="my-1 col-6 col-md-2 order-md-6">' +
      '<div class="form-check">' +
      '<input class="form-check-input radio_seguimiento_si" type="radio" name="radio_seguimiento_' +
      numDocumentosRequeridosAseguradora +
      '" value="SI" checked>' +
      "</div>" +
      "</div>" +
      "<!-- Confirmacion NO -->" +
      '<div class="my-1 col-6 col-md-2 order-md-3 ' +
      estado +
      '">' +
      "<label>NO</label>" +
      "</div>" +
      '<div class="my-1 col-6 col-md-2 order-md-7">' +
      '<div class="form-check">' +
      '<input class="form-check-input radio_seguimiento_no" type="radio" name="radio_seguimiento_' +
      numDocumentosRequeridosAseguradora +
      '" value="NO">' +
      "</div>" +
      "</div>" +
      "<!-- Acciones -->" +
      '<div class="my-1 col-12 col-md-2 order-md-4 ' +
      estado +
      '">' +
      "<label></label>" +
      "</div>" +
      '<div class="my-1 col-12 col-md-2 order-md-8">' +
      '<button type="button" class="form-control btn btn-danger quitarDocumento idDocumento="' +
      numDocumentosRequeridosAseguradora +
      '"><i class="fa fa-times"></i></button>' +
      "</div>" +
      "</div>" +
      "</div>"
  );

  numDocumentosRequeridosAseguradora++;

  listarDocumentosAseguradora();
});

$(".seguimientoDatosCreditoAmbulatorio").on(
  "keyup",
  "input.documentoRequerido",
  function () {
    listarDocumentosAseguradora();
  }
);
/*=============================================
    CAMBIOS EN RADIO SEGUIMIENTO
    =============================================*/
$(".seguimientoDatosCreditoAmbulatorio").on(
  "change",
  "input.radio_seguimiento_si",
  function () {
    listarDocumentosAseguradora();
  }
);
$(".seguimientoDatosCreditoAmbulatorio").on(
  "change",
  "input.radio_seguimiento_no",
  function () {
    listarDocumentosAseguradora();
  }
);

/*=============================================
    CAMBIOS EN FECHA DE SEGUIMIENTO
    =============================================*/

$("#txt_fecha_seguimiento").change(function () {
  listarDocumentosAseguradora();
});

/*=============================================
    CAMBIOS EN OBSERVACIONES
    =============================================*/
$("#txt_observaciones_seguimiento_credito_ambulatorio").keyup(function () {
  listarDocumentosAseguradora();
});

/*=============================================
    QUITAR DOCUMENTOS SOLICITADOS POR ASEGURADORA
    =============================================*/

var idQuitarDocumento = [];

localStorage.removeItem("quitarDocumento");

$(".seguimientoDatosCreditoAmbulatorio").on(
  "click",
  "button.quitarDocumento",
  function () {
    // $(this).parent().parent().parent().parent().parent().css({"color": "red", "border": "2px solid red"});
    // $(this).parent().parent().parent().css({"color": "red", "border": "2px solid red"});
    $(this).parent().parent().parent().remove();

    var idDocumento = $(this).attr("idDocumento");

    /*=============================================
      ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
      =============================================*/

    if (localStorage.getItem("quitarDocumento") == null) {
      idQuitarDocumento = [];
    } else {
      idQuitarDocumento.concat(localStorage.getItem("quitarDocumento"));
    }

    idQuitarDocumento.push({
      idDocumento: idDocumento,
    });

    localStorage.setItem("quitarDocumento", JSON.stringify(idQuitarDocumento));

    numDocumentosRequeridosAseguradora--;

    if ($(".seguimientoDatosCreditoAmbulatorio").children().length == 0) {
      $("#listaDocumentosSolicitadosAseguradora").val("");
    } else {
      // AGRUPAR FAMILIARES EN FORMATO JSON
      listarDocumentosAseguradora();
    }
  }
);

function crear_overlay_seguimiento_credito_ambulatorio_asistencia_medica() {
  $("#modalSeguimientoCreditoAmbulatorio").append(
    '<div class="overlay dark" id="overlaySeguimientoCreditoAmbulatorioAsistenciaMedica"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_seguimiento_credito_ambulatorio_asistencia_medica() {
  $("#overlaySeguimientoCreditoAmbulatorioAsistenciaMedica").remove();
}

function Modificar_Seguimiento_Credito_Ambulatorio() {
  listarObservacionesSeguimientoCreditoAmbulatorio();

  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();
  var listaDocumentosSolicitadosAseguradora = $(
    "#listaDocumentosSolicitadosAseguradora"
  ).val();
  var enviar_mail = "";
  var fecha_seguimiento = $("#txt_fecha_seguimiento").val();
  var observaciones = $(
    "#txt_observaciones_seguimiento_credito_ambulatorio"
  ).val();
  var listaObservacionesSeguimientosCreditoAmbulatorio = $(
    "#listaObservacionesSeguimientosCreditoAmbulatorio"
  ).val();

  var documento;

  var estado_caducado = "";

  if ($("#enviarEmail").is(":checked")) {
    enviar_mail = "SI";
  } else {
    enviar_mail = "NO";
  }

  if ($("#estadoCaducado").is(":checked")) {
    estado_caducado = "SI";
  } else {
    estado_caducado = "NO";
  }

  var cont = 0;
  var cont1 = 0;

  if (listaDocumentosSolicitadosAseguradora.length > 0) {
    var data = JSON.parse(listaDocumentosSolicitadosAseguradora);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var documento1 = data[i]["documento"];

        if (documento1.length == 0) {
          cont++;
        }
      }
    }
  }

  if (listaObservacionesSeguimientosCreditoAmbulatorio.length > 0) {
    var data1 = JSON.parse(listaObservacionesSeguimientosCreditoAmbulatorio);
    if (data1.length > 0) {
      for (var i = 0; i < data1.length; i++) {
        var observacion = data1[i]["observaciones"];

        if (observacion.length > 0) {
          cont1++;
        }
      }
    }
  }

  if (listaDocumentosSolicitadosAseguradora.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Agregue los documentos a solicitar",
      "warning"
    );
  }

  if (cont > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar la descripcion del Documento",
      "warning"
    );
  }

  if (fecha_seguimiento.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Selecciones la fecha de seguimiento",
      "warning"
    );
  }

  if (cont1 == 0 || observaciones.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar una observaci&oacute;n",
      "warning"
    );
  }

  var archivo = $(
    "#txt_documento_credito_ambulatorio_documento_pedido_aseguradora"
  ).val();
  var extension = archivo.split(".").pop();
  documento = $(
    "#txt_documento_credito_ambulatorio_documento_pedido_aseguradora"
  )[0].files[0];

  crear_overlay_seguimiento_credito_ambulatorio_asistencia_medica();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);
  datos.append(
    "listaDocumentosSolicitadosAseguradora",
    listaDocumentosSolicitadosAseguradora
  );
  datos.append("enviar_mail", enviar_mail);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesSeguimientosCreditoAmbulatorio",
    listaObservacionesSeguimientosCreditoAmbulatorio
  );
  datos.append("estado_caducado", estado_caducado);
  datos.append("documento", documento);
  datos.append("extension", extension);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_credito_ambulatorio_asistencia_medica_individual_seguimiento_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Seguimiento Credito Ambulatorio Modificado Exitosamente",
          "success"
        ).then((value) => {
          eliminar_overlay_seguimiento_credito_ambulatorio_asistencia_medica();
          $("#modalAgregarSeguimientoCreditoAmbulatorio").modal("hide");
          table_listar_creditos_ambulatorios_asistencia_medica_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRAR DOCUMENTO ADICIONAL
 *********************************/
$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnAgregarDocumentoSeguimiento",
  function () {
    $("#modalAgregarDocumentoSeguimientoCreditoAmbulatorio").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarDocumentoSeguimientoCreditoAmbulatorio").modal("show");

    var idCreditoAmbulatorio = $(this).attr("idCreditoAmbulatorio");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarDocumentoSeguimientoCreditoAmbulatorioPaciente").text(paciente);
    $("#txt_idCreditoAmbulatorio").val(idCreditoAmbulatorio);
    $("#txt_idContrato").val(idContrato);
    $("#txt_fecha_documento_seguimiento_aseguradora").val("");
    $("#txt_observaciones_documento_seguimiento_credito_ambulatorio").val("");
    $("#txt_documento_credito_ambulatorio_documento_seguimiento").val("");
    Cargar_Observaciones_Documentos_Seguimientos();
  }
);

/*=============================================
    CARGAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS PEDIDO CREDITO AMBULATORIO
  =============================================*/

function Cargar_Observaciones_Documentos_Seguimientos() {
  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_observacion_credito_ambulatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $(
          "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorioAnterior"
        ).val(data[0]["credito_ambulatorio_observacion_descripcion"]);
      } else {
        $(
          "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorioAnterior"
        ).val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS PEDIDO CREDITO AMBULATORIO
    =============================================*/

function listarObservacionesDocumentosSeguimientoCreditoAmbulatorio() {
  if (
    $("#txt_observaciones_documento_seguimiento_credito_ambulatorio").val()
      .length > 0
  ) {
    var listaObservacionesDocumentoSeguimientosCreditoAmbulatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorioAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $(
          "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorioAnterior"
        ).val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesDocumentoSeguimientosCreditoAmbulatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $(
      "#txt_observaciones_documento_seguimiento_credito_ambulatorio"
    )
      .val()
      .toUpperCase();

    listaObservacionesDocumentoSeguimientosCreditoAmbulatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesDocumentoSeguimientosCreditoAmbulatorio").val(
      JSON.stringify(listaObservacionesDocumentoSeguimientosCreditoAmbulatorio)
    );
  } else {
    $("#listaObservacionesDocumentoSeguimientosCreditoAmbulatorio").val(
      $(
        "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorioAnterior"
      ).val()
    );
  }

  const reg = /\\n/g;
  var str = $(
    "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorio"
  ).val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesDocumentoSeguimientosCreditoAmbulatorio").val(newStr);
}

function crear_overlay_documento_seguimiento_credito_ambulatorio_asistencia_medica() {
  $("#modalDocumentoSeguimientoCreditoAmbulatorio").append(
    '<div class="overlay dark" id="overlayDocumentoSeguimientoAsistenciaMedica"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_documento_seguimiento_credito_ambulatorio_asistencia_medica() {
  $("#overlayDocumentoSeguimientoAsistenciaMedica").remove();
}

/*****************************************************
   REGISTRAR UN NUEVO DOCUMENTO SEGUIMIENTO PEDIDO CREDITO AMBULATORIO
   ***************************************************/
function Registrar_Documento_Seguimiento_Credito_Ambulatorio() {
  listarObservacionesDocumentosSeguimientoCreditoAmbulatorio();

  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val().toUpperCase();
  var idContrato = $("#txt_idContrato").val().toUpperCase();
  var fecha_seguimiento = $(
    "#txt_fecha_documento_seguimiento_aseguradora"
  ).val();
  var observaciones = $(
    "#txt_observaciones_documento_seguimiento_credito_ambulatorio"
  ).val();
  var listaObservacionesDocumentoSeguimientosCreditoAmbulatorio = $(
    "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorio"
  ).val();

  var documento;

  var cont1 = 0;

  if (listaObservacionesDocumentoSeguimientosCreditoAmbulatorio.length > 0) {
    var data1 = JSON.parse(
      listaObservacionesDocumentoSeguimientosCreditoAmbulatorio
    );
    if (data1.length > 0) {
      for (var i = 0; i < data1.length; i++) {
        var observacion = data1[i]["observaciones"];

        if (observacion.length > 0) {
          cont1++;
        }
      }
    }
  }

  if (fecha_seguimiento.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione una fecha de seguimento",
      "warning"
    );
  }

  if (cont1 == 0 || observaciones.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar una observaci&oacute;n",
      "warning"
    );
  }

  if (
    $("#txt_documento_credito_ambulatorio_documento_seguimiento").val()
      .length == 0
  ) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $(
    "#txt_documento_credito_ambulatorio_documento_seguimiento"
  ).val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_credito_ambulatorio_documento_seguimiento")[0]
    .files[0];

  crear_overlay_documento_seguimiento_credito_ambulatorio_asistencia_medica();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesDocumentoSeguimientosCreditoAmbulatorio",
    listaObservacionesDocumentoSeguimientosCreditoAmbulatorio
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_credito_ambulatorio_asistencia_medica_individual_documento_seguimiento_registro.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Nuevo Documento Seguimiento Registrado",
          "success"
        ).then((value) => {
          eliminar_overlay_documento_seguimiento_credito_ambulatorio_asistencia_medica();
          $("#modalAgregarDocumentoSeguimientoCreditoAmbulatorio").modal(
            "hide"
          );
          table_listar_creditos_ambulatorios_asistencia_medica_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_documento_seguimiento_credito_ambulatorio_asistencia_medica();
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
      }
    },
  });
}

/*********************************
 ABRI MODAL REGISTRAR AUTORIZACION
 *********************************/
$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnAgregarAutorizacion",
  function () {
    $("#modalAgregarDocumentoAutorizacionCreditoAmbulatorio").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarDocumentoAutorizacionCreditoAmbulatorio").modal("show");
    var idCreditoAmbulatorio = $(this).attr("idCreditoAmbulatorio");
    var idBayer = $(this).attr("idBayer");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarDocumentoAutorizacionCreditoAmbulatorioPaciente").text(paciente);
    $("#txt_idCreditoAmbulatorio").val(idCreditoAmbulatorio);
    $("#txt_idBayer").val(idBayer);
    $("#txt_idContrato").val(idContrato);

    LimpiarRegistroDocumentoAutorizacion();
    cargar_datos_dependiente_credito_ambulatorio();
    Cargar_Observaciones_Autorizacion_Seguimientos();
  }
);

function LimpiarRegistroDocumentoAutorizacion() {
  $("#txt_observaciones_autorizacion_credito_ambulatorio").val("");
  $("#txt_documento_credito_ambulatorio_documento_autorizacion").val("");
}

function cargar_datos_dependiente_credito_ambulatorio() {
  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_traer_credito_ambulatorio_asistencia_medica_individual.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        for (let i = 0; i < data.length; i++) {
          var lista_credito_ambulatorio = JSON.parse(
            data[i]["credito_ambulatorio_descripcion"]
          );
          var paciente = lista_credito_ambulatorio[0]["nombre_paciente"];
          $("#txt_paciente_credito_ambulatorio").val(paciente);
        }
      }
    },
  });
}

/*=============================================
    CARGAR OBSERVACIONES AUTORIZACION PEDIDO CREDITO AMBULATORIO
  =============================================*/

function Cargar_Observaciones_Autorizacion_Seguimientos() {
  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_observacion_credito_ambulatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesLiquidacionCreditoAmbulatorioAnterior").val(
          data[0]["credito_ambulatorio_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesLiquidacionCreditoAmbulatorioAnterior").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS PEDIDO CREDITO AMBULATORIO
    =============================================*/

function listarObservacionesAutorizacionCreditoAmbulatorio() {
  if (
    $("#txt_observaciones_autorizacion_credito_ambulatorio").val().length > 0
  ) {
    var listaObservacionesAutorizacionCreditoAmbulatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesAutorizacionCreditoAmbulatorioAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesAutorizacionCreditoAmbulatorioAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesAutorizacionCreditoAmbulatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_autorizacion_credito_ambulatorio")
      .val()
      .trim()
      .toUpperCase();

    listaObservacionesAutorizacionCreditoAmbulatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesAutorizacionCreditoAmbulatorio").val(
      JSON.stringify(listaObservacionesAutorizacionCreditoAmbulatorio)
    );
  } else {
    $("#listaObservacionesAutorizacionCreditoAmbulatorio").val(
      $("#listaObservacionesAutorizacionCreditoAmbulatorioAnterior").val()
    );
  }

  const reg = /\\n/g;
  var str = $("#listaObservacionesAutorizacionCreditoAmbulatorio").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesAutorizacionCreditoAmbulatorio").val(newStr);
}

function crear_overlay_documento_autorizacion_credito_ambulatorio_asistencia_medica() {
  $("#modalDocumentoAutorizacionCreditoAmbulatorio").append(
    '<div class="overlay dark" id="overlayDocumentoAutorizacionCreditoAmbulatorioAsistenciaMedica"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_documento_autorizacion_credito_ambulatorio_asistencia_medica() {
  $("#overlayDocumentoAutorizacionCreditoAmbulatorioAsistenciaMedica").remove();
}

/*********************************
   REGISTRAR AUTORIZACION PEDIDO CREDITO AMBULATORIO
   *********************************/
function Registrar_Documento_Autorizacion_Credito_Ambulatorio() {
  listarObservacionesAutorizacionCreditoAmbulatorio();

  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();
  var listaObservacionesAutorizacionCreditoAmbulatorio = $(
    "#listaObservacionesAutorizacionCreditoAmbulatorio"
  ).val();

  var documento;

  if (
    $("#txt_observaciones_autorizacion_credito_ambulatorio").val().length == 0
  ) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingrese una observación para cargar la autorización del credito ambulatorio",
      "warning"
    );
  }

  if (
    $("#txt_documento_credito_ambulatorio_documento_autorizacion").val()
      .length == 0
  ) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $(
    "#txt_documento_credito_ambulatorio_documento_autorizacion"
  ).val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_credito_ambulatorio_documento_autorizacion")[0]
    .files[0];

  crear_overlay_documento_autorizacion_credito_ambulatorio_asistencia_medica();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);
  datos.append(
    "listaObservacionesAutorizacionCreditoAmbulatorio",
    listaObservacionesAutorizacionCreditoAmbulatorio
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_credito_ambulatorio_asistencia_medica_individual_documento_autorizacion_registro.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta == 1) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Nueva Autorización Registrada",
          "success"
        ).then((value) => {
          eliminar_overlay_documento_autorizacion_credito_ambulatorio_asistencia_medica();
          $("#modalAgregarDocumentoAutorizacionCreditoAmbulatorio").modal(
            "hide"
          );
          table_listar_creditos_ambulatorios_asistencia_medica_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_documento_autorizacion_credito_ambulatorio_asistencia_medica();
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
      }
    },
  });
}

/*********************************
 ABRIR MODAL OBSERVACIONES ADICIONALES SEGUIMIENTO CREDITO AMBULATORIO
 *********************************/
$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnAgregarAnulacion",
  function () {
    var idCreditoAmbulatorio = $(this).attr("idCreditoAmbulatorio");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarObservacionAnulacionAmbulatorioPaciente").text(paciente);
    $("#txt_idCreditoAmbulatorio").val(idCreditoAmbulatorio);
    $("#txt_idContrato").val(idContrato);

    $("#modalAgregarObservacionAnulacionAmbulatorio").modal({
      backdrop: "static",
      keyboard: false,
    });

    $("#modalAgregarObservacionAnulacionAmbulatorio").modal("show");

    $("#txt_observaciones_anulacion_ambulatorio").val("");

    Cargar_Observaciones_Anulacion_Creditos_Ambulatorios();
  }
);

function Cargar_Observaciones_Anulacion_Creditos_Ambulatorios() {
  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_observacion_credito_ambulatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesAnulacionAmbulatorioAnterior").val(
          data[0]["credito_ambulatorio_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesAnulacionAmbulatorioAnterior").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES SEGUIMIENTOS PEDIDO CREDITO AMBULATORIO
    =============================================*/

function listarObservacionesAnulacionCreditoAmbulatorio() {
  if ($("#txt_observaciones_anulacion_ambulatorio").val().length > 0) {
    var listaObservacionesAnulacionAmbulatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesAnulacionAmbulatorioAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesAnulacionAmbulatorioAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesAnulacionAmbulatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_anulacion_ambulatorio")
      .val()
      .toUpperCase();

    listaObservacionesAnulacionAmbulatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesAnulacionAmbulatorio").val(
      JSON.stringify(listaObservacionesAnulacionAmbulatorio)
    );
  } else {
    $("#listaObservacionesAnulacionAmbulatorio").val(
      $("#listaObservacionesAnulacionAmbulatorioAnterior").val()
    );
  }

  const reg = /\\n/g;
  var str = $("#listaObservacionesAnulacionAmbulatorio").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesAnulacionAmbulatorio").val(newStr);
}

function Modificar_Observaciones_Anulacion_Credito_Ambulatorio() {
  listarObservacionesAnulacionCreditoAmbulatorio();

  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();
  var observacion = $("#txt_observaciones_anulacion_ambulatorio").val();
  var lista_observaciones_anulacion = $(
    "#listaObservacionesAnulacionAmbulatorio"
  ).val();

  if (observacion.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar una observaci&oacute;n",
      "warning"
    );
  }

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);
  datos.append("lista_observaciones_anulacion", lista_observaciones_anulacion);

  $.ajax({
    url: "controller/creditos-ambulatorios-observaciones/controlador_credito_ambulatorio_asistencia_medica_individual_observaciones_anulacion_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Nueva Observación agregada",
          "success"
        ).then((value) => {
          $("#modalAgregarObservacionAnulacionAmbulatorio").modal("hide");
          table_listar_creditos_ambulatorios_asistencia_medica_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRO DE OPERATORIO
 *********************************/
function AbrirModalRegistro() {
  $("#modalAgregarCreditoAmbulatorio").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modalAgregarCreditoAmbulatorio").modal("show");
  LimpiarRegistro();
}

function LimpiarRegistro() {
  $("#txt_idBayer").val("");
  $("#txt_contrato_aplicar").val("");
  $("#cbm_nombre_paciente").empty();
  $("#cbm_nombre_paciente").append("<option value=''>SIN REGISTROS</option>");
  $("#txt_fecha_operacion").val("");
  // $("#txt_valor_presentado_credito_ambulatorio").val("");
  $("#txt_diagnostico_credito_ambulatorio").val("");
  $("#txt_documento_credito_ambulatorio").val("");
}

/*=============================================
  LISTAR CONTRATOS EXISTENTES
  =============================================*/

$(".btnListarContratos").click(function () {
  $("#modalListarContratosClientes").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modalListarContratosClientes").modal("show");

  listar_contratos_para_seleccionar();
});

var table_listar_contratos_cliente;
function listar_contratos_para_seleccionar() {
  var f = new Date();
  fecha = f.getFullYear() + "-" + f.getMonth() + "-" + f.getDate();

  var fecha_actual = $("#txt_fecha_credito_ambulatorio").val();

  if (fecha_actual == "") {
    fecha_envio = fecha;
  } else {
    fecha_envio = fecha_actual;
  }

  table_listar_contratos_cliente = $(
    "#table_listar_contratos_cliente"
  ).DataTable({
    ordering: false,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax:
      "controller/contratos-clientes/controlador_contrato_cliente_asistencia_medica_individual_listar_todos.php?fecha=" +
      fecha_envio,
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $($(nRow).find("td")[0]).css("text-align", "center");
      $($(nRow).find("td")[1]).css("text-align", "center");
      $($(nRow).find("td")[2]).css("text-align", "center");
      $($(nRow).find("td")[3]).css("text-align", "center");
      $($(nRow).find("td")[4]).css("text-align", "center");
    },
    language: idioma_espanol,
  });
}

$("#table_listar_contratos_cliente").on(
  "click",
  ".btnSeleccionarContrato",
  function () {
    var idCliente = $(this).attr("idCliente");
    var idContrato = $(this).attr("idContrato");
    var numeroContrato = $(this).attr("numeroContrato");

    $("#txt_idBayer").val(idCliente);
    $("#txt_idContrato").val(idContrato);
    $("#txt_contrato_aplicar").val(numeroContrato);

    $("#modalListarContratosClientes").modal("hide");

    listar_combo_dependientes();
  }
);

/*********************************
  LISTAR COMBO DEPENDIENTES
  *********************************/
function listar_combo_dependientes() {
  var idBayer = $("#txt_idBayer").val();
  var idContrato = $("#txt_idContrato").val();

  var datos = new FormData();
  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);

  $.ajax({
    url: "controller/bayer_persona/controlador_combo_dependientes_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta != "") {
        var data = JSON.parse(respuesta);
        var cadena = "";
        if (data.length > 0) {
          cadena += "<option value=''>Seleccione..</option>";
          for (var i = 0; i < data.length; i++) {
            cadena +=
              "<option  value='" +
              data[i]["nombre"] +
              "'>" +
              data[i]["nombre"] +
              "</option>";
          }
        } else {
          cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
      } else {
        cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
      }
      $(".cbm_nombre_paciente").html(cadena);
    },
  });
}

$("#txt_documento_credito_ambulatorio").change(function () {
  var documento = this.files[0];

  // Tamaño correcto en bytes (25MB reales)
  var maxSizeMB = 25;
  var maxSizeBytes = maxSizeMB * 1024 * 1024;
  /*=============================================
      VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
      =============================================*/

  if (documento["type"] != "application/pdf") {
    $("#txt_documento_credito_ambulatorio").val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir el documento",
      text: "¡El documento debe estar en formato PDF!",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (documento["size"] > maxSizeBytes) {
    $("#txt_documento_credito_ambulatorio").val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir el documento",
      text: "¡El documento no debe pesar más de " + maxSizeMB + "MB!",
      confirmButtonText: "¡Cerrar!",
    });
  }
});

function listarDatosCreditoAmbulatorio() {
  var listaDatosCreditoAmbulatorio = [];

  var nombre_paciente = $(".cbm_nombre_paciente");
  var fecha_atencion = $(".fecha_credito_ambulatorio");
  // var valor_presentado = $(".valor_presentado");
  var diagnostico = $(".diagnostico_credito_ambulatorio");
  var tipo_examen_credito_ambulatorio = $(".tipo_examen_credito_ambulatorio");
  var lugar_procedimiento_credito_ambulatorio = $(
    ".lugar_procedimiento_credito_ambulatorio"
  );
  var fecha_procedimiento_credito_ambulatorio = $(
    ".fecha_procedimiento_credito_ambulatorio"
  );

  for (var i = 0; i < nombre_paciente.length; i++) {
    listaDatosCreditoAmbulatorio.push({
      nombre_paciente: $(nombre_paciente[i]).val().toUpperCase(),
      fecha_atencion: $(fecha_atencion[i]).val(),
      valor_presentado: 0,
      diagnostico: $(diagnostico[i]).val().toUpperCase(),
      tipo_examen_credito_ambulatorio: $(tipo_examen_credito_ambulatorio[i])
        .val()
        .toUpperCase(),
      lugar_procedimiento_credito_ambulatorio: $(
        lugar_procedimiento_credito_ambulatorio[i]
      )
        .val()
        .toUpperCase(),
      fecha_procedimiento_credito_ambulatorio: $(
        fecha_procedimiento_credito_ambulatorio[i]
      ).val(),
    });
  }

  $("#listaDatosCreditoAmbulatorio").val(
    JSON.stringify(listaDatosCreditoAmbulatorio)
  );
  const reg = /\\n/g;
  var str = $("#listaDatosCreditoAmbulatorio").val();
  const newStr = str.replace(reg, " ");
  $("#listaDatosCreditoAmbulatorio").val(newStr);
}

function crear_overlay_credito_ambulatorio_cliente_asistencia_medica() {
  $("#modalNuevoCreditoAmbulatorio").append(
    '<div class="overlay dark" id="overlayNuevoCreditoAmbulatorio"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}

function eliminar_overlay_credito_ambulatorio_cliente_asistencia_medica() {
  $("#overlayNuevoCreditoAmbulatorio").remove();
}

/*********************************
   REGISTRAR UN NUEVO CREDITO AMBULATORIO
   *********************************/
function Registrar_Credito_Ambulatorio() {
  listarDatosCreditoAmbulatorio();
  var idBayer = $("#txt_idBayer").val().toUpperCase();
  var idContrato = $("#txt_idContrato").val().toUpperCase();
  var listaDatosCreditoAmbulatorio = $("#listaDatosCreditoAmbulatorio").val();
  var documento;

  var cont = 0;

  if (listaDatosCreditoAmbulatorio.length > 0) {
    var data = JSON.parse(listaDatosCreditoAmbulatorio);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var nombre_paciente = data[i]["nombre_paciente"];
        var fecha_atencion = data[i]["fecha_atencion"];
        var valor_presentado = data[i]["valor_presentado"];
        var diagnostico = data[i]["diagnostico"];
        var tipo_examen_credito_ambulatorio =
          data[i]["tipo_examen_credito_ambulatorio"];
        var lugar_procedimiento_credito_ambulatorio =
          data[i]["lugar_procedimiento_credito_ambulatorio"];
        var fecha_procedimiento_credito_ambulatorio =
          data[i]["fecha_procedimiento_credito_ambulatorio"];

        if (
          nombre_paciente.length == 0 ||
          fecha_atencion.length == 0 ||
          valor_presentado.length == 0 ||
          diagnostico.length == 0 ||
          tipo_examen_credito_ambulatorio.length == 0 ||
          lugar_procedimiento_credito_ambulatorio.length == 0 ||
          fecha_procedimiento_credito_ambulatorio.length == 0
        ) {
          cont++;
        }
      }
    }
  }

  if (idBayer.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un contrato valido",
      "warning"
    );
  }

  if (listaDatosCreditoAmbulatorio.length == 0 || cont > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios para la petición credito ambulatorio",
      "warning"
    );
  }

  if ($("#txt_documento_credito_ambulatorio").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $("#txt_documento_credito_ambulatorio").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_credito_ambulatorio")[0].files[0];

  crear_overlay_credito_ambulatorio_cliente_asistencia_medica();

  var datos = new FormData();

  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);
  datos.append("listaDatosCreditoAmbulatorio", listaDatosCreditoAmbulatorio);
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_credito_ambulatorio_asistencia_medica_individual_registro.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Nueva Credito Ambulatorio Registrado",
          "success"
        ).then((value) => {
          eliminar_overlay_credito_ambulatorio_cliente_asistencia_medica();
          $("#modalAgregarCreditoAmbulatorio").modal("hide");
          table_listar_creditos_ambulatorios_asistencia_medica_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_credito_ambulatorio_cliente_asistencia_medica();
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRAR SOLICTAR DOCUMENTOS FALTANTES SEGUIMIENTO1
 *********************************/
$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnSeguimientoCreditoAmbulatorioAseguradora1",
  function () {
    $("#modalAgregarSeguimientoCreditoAmbulatorio1").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarSeguimientoCreditoAmbulatorio1").modal("show");
    var idCreditoAmbulatorio = $(this).attr("idCreditoAmbulatorio");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarSeguimientoCreditoAmbulatorioPaciente1").text(paciente);
    $("#txt_idCreditoAmbulatorio").val(idCreditoAmbulatorio);
    $("#txt_idContrato").val(idContrato);
    $("#enviarEmail1").prop("checked", true);
    $("#txt_fecha_seguimiento1").val("");
    $("#listaDocumentosSolicitadosAseguradora1").val("");
    $(".seguimientoDatosCreditoAmbulatorio1").empty();
    Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos_1();
    Cargar_Observaciones_Seguimientos_1();
    listarObservacionesSeguimientoCreditoAmbulatorio_1();
  }
);

function Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos_1() {
  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_documentos_adicionales_solictados_aseguradora_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaDocumentosSolicitadosAseguradoraAnterior1").val(
          data[0]["credito_ambulatorio_documentos_seguimiento_1"]
        );
      } else {
        $("#listaDocumentosSolicitadosAseguradoraAnterior1").val("");
      }
      cargar_auto_documentos_aseguradora_1();
    },
  });
}

function cargar_auto_documentos_aseguradora_1() {
  numDocumentosRequeridosAseguradora = 0;

  var lista_documentos_adicionales = $(
    "#listaDocumentosSolicitadosAseguradoraAnterior1"
  ).val();

  if (lista_documentos_adicionales.length > 0) {
    lista_documentos_adicionales = JSON.parse(
      $("#listaDocumentosSolicitadosAseguradoraAnterior1").val()
    );

    for (let i = 0; i < lista_documentos_adicionales.length; i++) {
      var estado = "";
      var estado_si = "";
      var estado_no = "";

      if (numDocumentosRequeridosAseguradora > 0) {
        estado = "d-md-none";
      } else {
        estado = "";
      }

      if (lista_documentos_adicionales[i]["estado"] == "SI") {
        estado_si = "checked";
        estado_no = "";
      } else {
        estado_si = "";
        estado_no = "checked";
      }

      $(".seguimientoDatosCreditoAmbulatorio1").append(
        '<div class="col-12 my-1">' +
          '<div class="row gridSeguimientoCreditoAmbulatorio1">' +
          "<!-- Documento -->" +
          '<div class="my-1 col-12 col-md-6 order-md-1 ' +
          estado +
          '">' +
          "<label>Documento</label>" +
          "</div>" +
          '<div class="my-1 col-12 col-md-6 order-md-5">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras documentoRequerido1" id="documentoRequerido1' +
          numDocumentosRequeridosAseguradora +
          '" name="documentoRequerido1' +
          numDocumentosRequeridosAseguradora +
          '" placeholder="DOCUMENTO REQUERIDO" autocomplete="off" style="text-transform: uppercase" value = "' +
          lista_documentos_adicionales[i]["documento"] +
          '"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Confirmacion SI -->" +
          '<div class="my-1 col-6 col-md-2 order-md-2 ' +
          estado +
          '">' +
          "<label>SI</label>" +
          "</div>" +
          '<div class="my-1 col-6 col-md-2 order-md-6">' +
          '<div class="form-check">' +
          '<input class="form-check-input radio_seguimiento_si" type="radio" name="radio_seguimiento_' +
          numDocumentosRequeridosAseguradora +
          '" value="SI" ' +
          estado_si +
          ">" +
          "</div>" +
          "</div>" +
          "<!-- Confirmacion NO -->" +
          '<div class="my-1 col-6 col-md-2 order-md-3 ' +
          estado +
          '">' +
          "<label>NO</label>" +
          "</div>" +
          '<div class="my-1 col-6 col-md-2 order-md-7">' +
          '<div class="form-check">' +
          '<input class="form-check-input radio_seguimiento_no" type="radio" name="radio_seguimiento_' +
          numDocumentosRequeridosAseguradora +
          '" value="NO" ' +
          estado_no +
          ">" +
          "</div>" +
          "</div>" +
          "<!-- Acciones -->" +
          '<div class="my-1 col-12 col-md-2 order-md-4 ' +
          estado +
          '">' +
          "<label></label>" +
          "</div>" +
          '<div class="my-1 col-12 col-md-2 order-md-8">' +
          '<button type="button" class="form-control btn btn-danger quitarDocumento1 idDocumento="' +
          numDocumentosRequeridosAseguradora +
          '"><i class="fa fa-times"></i></button>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      numDocumentosRequeridosAseguradora++;
    }

    listarDocumentosAseguradora_1();
  }
}

function listarDocumentosAseguradora_1() {
  var listaDocumentosSolicitadosAseguradora = [];

  var documento = $(".documentoRequerido1");
  var estado = $(".radio_seguimiento_si");
  var valor = "";

  for (var i = 0; i < documento.length; i++) {
    if ($(estado[i]).is(":checked")) {
      valor = "SI";
    } else {
      valor = "NO";
    }

    listaDocumentosSolicitadosAseguradora.push({
      documento: $(documento[i]).val().toUpperCase(),
      estado: valor,
    });
  }

  $("#listaDocumentosSolicitadosAseguradora1").val(
    JSON.stringify(listaDocumentosSolicitadosAseguradora)
  );
}

function Cargar_Observaciones_Seguimientos_1() {
  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_observacion_credito_ambulatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesSeguimientosCreditoAmbulatorioAnterior1").val(
          data[0]["credito_ambulatorio_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesSeguimientosCreditoAmbulatorioAnterior1").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES SEGUIMIENTOS CREDITO AMBULATORIO 1
    =============================================*/

function listarObservacionesSeguimientoCreditoAmbulatorio_1() {
  if (
    $("#txt_observaciones_seguimiento_credito_ambulatorio1").val().length > 0
  ) {
    var listaObservacionesSeguimientosCreditoAmbulatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesSeguimientosCreditoAmbulatorioAnterior1"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesSeguimientosCreditoAmbulatorioAnterior1").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesSeguimientosCreditoAmbulatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_seguimiento_credito_ambulatorio1")
      .val()
      .toUpperCase();

    listaObservacionesSeguimientosCreditoAmbulatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesSeguimientosCreditoAmbulatorio1").val(
      JSON.stringify(listaObservacionesSeguimientosCreditoAmbulatorio)
    );
  } else {
    $("#listaObservacionesSeguimientosCreditoAmbulatorio1").val(
      $("#listaObservacionesSeguimientosCreditoAmbulatorioAnterior1").val()
    );
  }
  const reg = /\\n/g;
  var str = $("#listaObservacionesSeguimientosCreditoAmbulatorio1").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesSeguimientosCreditoAmbulatorio1").val(newStr);
}

$(".btnAgregarDocumentoRequeridoAseguradora1").click(function () {
  var estado = "";

  if (numDocumentosRequeridosAseguradora > 0) {
    estado = "d-md-none";
  } else {
    estado = "";
  }

  $(".seguimientoDatosCreditoAmbulatorio1").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridSeguimientoCreditoAmbulatorio1">' +
      "<!-- Documento -->" +
      '<div class="my-1 col-12 col-md-6 order-md-1 ' +
      estado +
      '">' +
      "<label>Documento</label>" +
      "</div>" +
      '<div class="my-1 col-12 col-md-6 order-md-5">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumerosLetras documentoRequerido1" id="documentoRequerido' +
      numDocumentosRequeridosAseguradora +
      '" name="documentoRequerido' +
      numDocumentosRequeridosAseguradora +
      '" placeholder="DOCUMENTO REQUERIDO" autocomplete="off" style="text-transform: uppercase"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Confirmacion SI -->" +
      '<div class="my-1 col-6 col-md-2 order-md-2 ' +
      estado +
      '">' +
      "<label>SI</label>" +
      "</div>" +
      '<div class="my-1 col-6 col-md-2 order-md-6">' +
      '<div class="form-check">' +
      '<input class="form-check-input radio_seguimiento_si" type="radio" name="radio_seguimiento_' +
      numDocumentosRequeridosAseguradora +
      '" value="SI" checked>' +
      "</div>" +
      "</div>" +
      "<!-- Confirmacion NO -->" +
      '<div class="my-1 col-6 col-md-2 order-md-3 ' +
      estado +
      '">' +
      "<label>NO</label>" +
      "</div>" +
      '<div class="my-1 col-6 col-md-2 order-md-7">' +
      '<div class="form-check">' +
      '<input class="form-check-input radio_seguimiento_no" type="radio" name="radio_seguimiento_' +
      numDocumentosRequeridosAseguradora +
      '" value="NO">' +
      "</div>" +
      "</div>" +
      "<!-- Acciones -->" +
      '<div class="my-1 col-12 col-md-2 order-md-4 ' +
      estado +
      '">' +
      "<label></label>" +
      "</div>" +
      '<div class="my-1 col-12 col-md-2 order-md-8">' +
      '<button type="button" class="form-control btn btn-danger quitarDocumento1 idDocumento="' +
      numDocumentosRequeridosAseguradora +
      '"><i class="fa fa-times"></i></button>' +
      "</div>" +
      "</div>" +
      "</div>"
  );

  numDocumentosRequeridosAseguradora++;

  listarDocumentosAseguradora_1();
});

/*=============================================
    QUITAR DOCUMENTOS SOLICITADOS POR ASEGURADORA 1
    =============================================*/

var idQuitarDocumento1 = [];

localStorage.removeItem("quitarDocumento1");

$(".seguimientoDatosCreditoAmbulatorio1").on(
  "click",
  "button.quitarDocumento1",
  function () {
    // $(this).parent().parent().parent().parent().parent().css({"color": "red", "border": "2px solid red"});
    // $(this).parent().parent().parent().css({"color": "red", "border": "2px solid red"});
    $(this).parent().parent().parent().remove();

    var idDocumento = $(this).attr("idDocumento");

    /*=============================================
          ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
          =============================================*/

    if (localStorage.getItem("quitarDocumento1") == null) {
      idQuitarDocumento1 = [];
    } else {
      idQuitarDocumento1.concat(localStorage.getItem("quitarDocumento1"));
    }

    idQuitarDocumento1.push({
      idDocumento: idDocumento,
    });

    localStorage.setItem(
      "quitarDocumento1",
      JSON.stringify(idQuitarDocumento1)
    );

    numDocumentosRequeridosAseguradora--;

    if ($(".seguimientoDatosCreditoAmbulatorio1").children().length == 0) {
      $("#listaDocumentosSolicitadosAseguradora1").val("");
    } else {
      // AGRUPAR FAMILIARES EN FORMATO JSON
      listarDocumentosAseguradora_1();
    }
  }
);

function crear_overlay_seguimiento_credito_ambulatorio_asistencia_medica_1() {
  $("#modalSeguimientoCreditoAmbulatorio1").append(
    '<div class="overlay dark" id="overlaySeguimientoCreditoAmbulatorioAsistenciaMedica1"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_seguimiento_credito_ambulatorio_asistencia_medica_1() {
  $("#overlaySeguimientoCreditoAmbulatorioAsistenciaMedica1").remove();
}

function Modificar_Seguimiento_Credito_Ambulatorio_1() {
  listarDocumentosAseguradora_1();
  listarObservacionesSeguimientoCreditoAmbulatorio_1();

  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();
  var listaDocumentosSolicitadosAseguradora = $(
    "#listaDocumentosSolicitadosAseguradora1"
  ).val();
  var enviar_mail = "";
  var fecha_seguimiento = $("#txt_fecha_seguimiento1").val();
  var observaciones = $(
    "#txt_observaciones_seguimiento_credito_ambulatorio1"
  ).val();
  var listaObservacionesSeguimientosCreditoAmbulatorio = $(
    "#listaObservacionesSeguimientosCreditoAmbulatorio1"
  ).val();

  var documento;

  var estado_caducado = "";

  if ($("#enviarEmail1").is(":checked")) {
    enviar_mail = "SI";
  } else {
    enviar_mail = "NO";
  }

  if ($("#estadoCaducado1").is(":checked")) {
    estado_caducado = "SI";
  } else {
    estado_caducado = "NO";
  }

  var cont = 0;
  var cont1 = 0;

  if (listaDocumentosSolicitadosAseguradora.length > 0) {
    var data = JSON.parse(listaDocumentosSolicitadosAseguradora);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var documento1 = data[i]["documento"];

        if (documento1.length == 0) {
          cont++;
        }
      }
    }
  }

  if (listaObservacionesSeguimientosCreditoAmbulatorio.length > 0) {
    var data1 = JSON.parse(listaObservacionesSeguimientosCreditoAmbulatorio);
    if (data1.length > 0) {
      for (var i = 0; i < data1.length; i++) {
        var observacion = data1[i]["observaciones"];

        if (observacion.length > 0) {
          cont1++;
        }
      }
    }
  }

  if (listaDocumentosSolicitadosAseguradora.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Agregue los documentos a solicitar",
      "warning"
    );
  }

  if (cont > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar la descripcion del Documento",
      "warning"
    );
  }

  if (fecha_seguimiento.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Selecciones la fecha de seguimiento",
      "warning"
    );
  }

  if (cont1 == 0 || observaciones.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar una observaci&oacute;n",
      "warning"
    );
  }

  var archivo = $(
    "#txt_documento_credito_ambulatorio_documento_pedido_aseguradora1"
  ).val();
  var extension = archivo.split(".").pop();
  documento = $(
    "#txt_documento_credito_ambulatorio_documento_pedido_aseguradora1"
  )[0].files[0];

  crear_overlay_seguimiento_credito_ambulatorio_asistencia_medica_1();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);
  datos.append(
    "listaDocumentosSolicitadosAseguradora",
    listaDocumentosSolicitadosAseguradora
  );
  datos.append("enviar_mail", enviar_mail);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesSeguimientosCreditoAmbulatorio",
    listaObservacionesSeguimientosCreditoAmbulatorio
  );
  datos.append("estado_caducado", estado_caducado);
  datos.append("documento", documento);
  datos.append("extension", extension);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_credito_ambulatorio_asistencia_medica_individual_seguimiento_modificar1.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Seguimiento Credito Ambulatorio Modificado Exitosamente",
          "success"
        ).then((value) => {
          eliminar_overlay_seguimiento_credito_ambulatorio_asistencia_medica_1();
          $("#modalAgregarSeguimientoCreditoAmbulatorio1").modal("hide");
          table_listar_creditos_ambulatorios_asistencia_medica_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRAR DOCUMENTO ADICIONAL 1
 *********************************/
$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnAgregarDocumentoSeguimiento1",
  function () {
    $("#modalAgregarDocumentoSeguimientoCreditoAmbulatorio1").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarDocumentoSeguimientoCreditoAmbulatorio1").modal("show");

    var idCreditoAmbulatorio = $(this).attr("idCreditoAmbulatorio");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarDocumentoSeguimientoCreditoAmbulatorioPaciente1").text(paciente);
    $("#txt_idCreditoAmbulatorio").val(idCreditoAmbulatorio);
    $("#txt_idContrato").val(idContrato);
    $("#txt_fecha_documento_seguimiento_aseguradora1").val("");
    $("#txt_observaciones_documento_seguimiento_credito_ambulatorio1").val("");
    $("#txt_documento_credito_ambulatorio_documento_seguimiento1").val("");
    Cargar_Observaciones_Documentos_Seguimientos_1();
  }
);

/*=============================================
    CARGAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS PEDIDO CREDITO AMBULATORIO
  =============================================*/

function Cargar_Observaciones_Documentos_Seguimientos_1() {
  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val();
  var idContrato = $("#txt_idContrato").val();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_observacion_credito_ambulatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $(
          "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorioAnterior1"
        ).val(data[0]["credito_ambulatorio_observacion_descripcion"]);
      } else {
        $(
          "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorioAnterior1"
        ).val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS PEDIDO CREDITO AMBULATORIO 1
    =============================================*/

function listarObservacionesDocumentosSeguimientoCreditoAmbulatorio_1() {
  if (
    $("#txt_observaciones_documento_seguimiento_credito_ambulatorio1").val()
      .length > 0
  ) {
    var listaObservacionesDocumentoSeguimientosCreditoAmbulatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorioAnterior1"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $(
          "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorioAnterior1"
        ).val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesDocumentoSeguimientosCreditoAmbulatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $(
      "#txt_observaciones_documento_seguimiento_credito_ambulatorio1"
    )
      .val()
      .toUpperCase();

    listaObservacionesDocumentoSeguimientosCreditoAmbulatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesDocumentoSeguimientosCreditoAmbulatorio1").val(
      JSON.stringify(listaObservacionesDocumentoSeguimientosCreditoAmbulatorio)
    );
  } else {
    $("#listaObservacionesDocumentoSeguimientosCreditoAmbulatorio1").val(
      $(
        "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorioAnterior1"
      ).val()
    );
  }

  const reg = /\\n/g;
  var str = $(
    "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorio1"
  ).val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesDocumentoSeguimientosCreditoAmbulatorio1").val(newStr);
}

function crear_overlay_documento_seguimiento_credito_ambulatorio_asistencia_medica_1() {
  $("#modalDocumentoSeguimientoCreditoAmbulatorio1").append(
    '<div class="overlay dark" id="overlayDocumentoSeguimientoAsistenciaMedica1"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_documento_seguimiento_credito_ambulatorio_asistencia_medica_1() {
  $("#overlayDocumentoSeguimientoAsistenciaMedica1").remove();
}

/*****************************************************
   REGISTRAR UN NUEVO DOCUMENTO SEGUIMIENTO PEDIDO CREDITO AMBULATORIO
   ***************************************************/
function Registrar_Documento_Seguimiento_Credito_Ambulatorio_1() {
  listarObservacionesDocumentosSeguimientoCreditoAmbulatorio_1();

  var idCreditoAmbulatorio = $("#txt_idCreditoAmbulatorio").val().toUpperCase();
  var idContrato = $("#txt_idContrato").val().toUpperCase();
  var fecha_seguimiento = $(
    "#txt_fecha_documento_seguimiento_aseguradora1"
  ).val();
  var observaciones = $(
    "#txt_observaciones_documento_seguimiento_credito_ambulatorio1"
  ).val();
  var listaObservacionesDocumentoSeguimientosCreditoAmbulatorio = $(
    "#listaObservacionesDocumentoSeguimientosCreditoAmbulatorio1"
  ).val();

  var documento;

  var cont1 = 0;

  if (listaObservacionesDocumentoSeguimientosCreditoAmbulatorio.length > 0) {
    var data1 = JSON.parse(
      listaObservacionesDocumentoSeguimientosCreditoAmbulatorio
    );
    if (data1.length > 0) {
      for (var i = 0; i < data1.length; i++) {
        var observacion = data1[i]["observaciones"];

        if (observacion.length > 0) {
          cont1++;
        }
      }
    }
  }

  if (fecha_seguimiento.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione una fecha de seguimento",
      "warning"
    );
  }

  if (cont1 == 0 || observaciones.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar una observaci&oacute;n",
      "warning"
    );
  }

  if (
    $("#txt_documento_credito_ambulatorio_documento_seguimiento1").val()
      .length == 0
  ) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $(
    "#txt_documento_credito_ambulatorio_documento_seguimiento1"
  ).val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_credito_ambulatorio_documento_seguimiento1")[0]
    .files[0];

  crear_overlay_documento_seguimiento_credito_ambulatorio_asistencia_medica_1();

  var datos = new FormData();

  datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesDocumentoSeguimientosCreditoAmbulatorio",
    listaObservacionesDocumentoSeguimientosCreditoAmbulatorio
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/creditos-ambulatorios-clientes/controlador_credito_ambulatorio_asistencia_medica_individual_documento_seguimiento_registro_1.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Nuevo Documento Seguimiento Registrado",
          "success"
        ).then((value) => {
          eliminar_overlay_documento_seguimiento_credito_ambulatorio_asistencia_medica_1();
          $("#modalAgregarDocumentoSeguimientoCreditoAmbulatorio1").modal(
            "hide"
          );
          table_listar_creditos_ambulatorios_asistencia_medica_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_documento_seguimiento_credito_ambulatorio_asistencia_medica_1();
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
      }
    },
  });
}
