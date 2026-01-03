// function lista1() {
//   $.ajax({
//     url: "controller/reembolsos-clientes/controlador_reembolsos_asistencia_medica_individual_listar.php",
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
  $("#tabla-listar-reembolsos-asistencia-medica-individual").removeClass(
    "nowrap"
  );
  $("#tabla-listar-reembolsos-asistencia-medica-individual").addClass(
    "dt-responsive"
  );
} else {
  $("#tabla-listar-reembolsos-asistencia-medica-individual").removeClass(
    "dt-responsive"
  );
  $("#tabla-listar-reembolsos-asistencia-medica-individual").addClass("nowrap");
}

var table_listar_reembolsos_asistencia_medica_individual;
function listar_reembolsos_asistencia_medica_individual() {
  table_listar_reembolsos_asistencia_medica_individual = $(
    "#tabla-listar-reembolsos-asistencia-medica-individual"
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
        targets: [
          0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19,
          20, 21, 22, 23,
        ],
      },
    ],
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
    ajax: "controller/reembolsos-clientes/controlador_reembolsos_asistencia_medica_individual_listar.php",
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $($(nRow).find("td")[0]).css("text-align", "center");
      $($(nRow).find("td")[1]).css("text-align", "center");
      $($(nRow).find("td")[2]).css("text-align", "center");
      $($(nRow).find("td")[3]).css("text-align", "center");
      $($(nRow).find("td")[4]).css("text-align", "center");
      $($(nRow).find("td")[5]).css("text-align", "center");
      $($(nRow).find("td")[6]).css("text-align", "center");
      $($(nRow).find("td")[7]).css("text-align", "center");
      $($(nRow).find("td")[8]).css("text-align", "center");
      $($(nRow).find("td")[9]).css("text-align", "center");
      $($(nRow).find("td")[10]).css("text-align", "center");
      $($(nRow).find("td")[11]).css("text-align", "center");
      $($(nRow).find("td")[12]).css("text-align", "center");
      $($(nRow).find("td")[13]).css("text-align", "center");
      $($(nRow).find("td")[14]).css("text-align", "center");
      $($(nRow).find("td")[15]).css("text-align", "center");
      $($(nRow).find("td")[16]).css("text-align", "center");
      $($(nRow).find("td")[17]).css("text-align", "center");
      $($(nRow).find("td")[18]).css("text-align", "center");
      $($(nRow).find("td")[19]).css("text-align", "center");
      $($(nRow).find("td")[20]).css("text-align", "center");
      $($(nRow).find("td")[21]).css("text-align", "center");
      $($(nRow).find("td")[22]).css("text-align", "center");
      $($(nRow).find("td")[23]).css("text-align", "center");
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

function listarValidaDatosReembolso() {
  var listaValidarDatosReembolso = [];

  var etiquetas = $(".etiquetaRadioValidar");

  for (var i = 1; i <= etiquetas.length; i++) {
    var documento = $("#etiquetaRadioValidar" + i).val();
    var radio = $("input:radio[name=radio_" + i + "]:checked").val();

    listaValidarDatosReembolso.push({
      documento: documento,
      estado: radio,
    });
  }

  $("#listaValidarDatosReembolso").val(
    JSON.stringify(listaValidarDatosReembolso)
  );
}

/*=============================================
  LISTAR OBSERVACIONES VALIDAR DATOS REEMBOLSO
=============================================*/

function listarObservacionesValidarDatosReembolso() {
  var listaObservacionesDatosReembolso = [];

  var observaciones = $("#txt_observaciones_reembolso")
    .val()
    .replace(/(\r\n|\n|\r|\t)/gm, " ")
    .toUpperCase();

  listaObservacionesDatosReembolso.push({
    fecha_registro: fecha_actual(),
    observaciones: observaciones,
  });

  $("#listaObservacionesDatosReembolso").val(
    JSON.stringify(listaObservacionesDatosReembolso)
  );
}

/*=============================================
ACTUALIZAR LISTADO DATOS REEMBOLSO
=============================================*/

/*=============================================
CAMBIOS EN RADIO VALIDAR
=============================================*/
$(".validarDatosReembolso").on("change", "input.radio_validacion", function () {
  listarValidaDatosReembolso();
});

/*=============================================
CAMBIOS EN FECHA DE SEGUIMIENTO
=============================================*/
$(".validarDatosReembolso").on(
  "change",
  "input.fecha_seguimiento_validar",
  function () {
    listarValidaDatosReembolso();
  }
);

/*=============================================
CAMBIOS EN OBSERVACIONES
=============================================*/
$(".validarDatosReembolso").on(
  "keyup",
  "textarea.observaciones_reembolso",
  function () {
    listarValidaDatosReembolso();
  }
);

/*********************************
ABRIR MODAL OBSERVACIONES REEMBOLSO
*********************************/
var numObservacion = 0;
$("#tabla-listar-reembolsos-asistencia-medica-individual").on(
  "click",
  ".btnVerObservaciones",
  function () {
    $("#modalObservaciones").modal({ backdrop: "static", keyboard: false });
    $("#modalObservaciones").modal("show");

    numObservacion = 0;

    $("#todoObservaciones").empty();

    var idReembolso = $(this).attr("idReembolso");
    var paciente = $(this).attr("paciente");

    $("#observacionesPaciente").text(paciente);

    var datos = new FormData();

    datos.append("idReembolso", idReembolso);

    $.ajax({
      url: "controller/reembolsos-clientes/controlador_observacion_reembolso_adicionales_listar.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        var data = JSON.parse(respuesta);

        if (data.length > 0) {
          $("#listaObservaciones").val(
            data[0]["reembolso_observacion_descripcion"]
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

$("#tabla-listar-reembolsos-asistencia-medica-individual").on(
  "click",
  ".btnVerDocumento",
  function () {
    var documentoRuta = $(this).attr("ruta");
    window.open(documentoRuta, "Documento", "width=1024,height=1024");
  }
);

$("#tabla-listar-reembolsos-asistencia-medica-individual").on(
  "click",
  ".btnCambiarEstado",
  function () {
    var idReembolso = $(this).attr("idReembolso");
    var estado = $(this).attr("estado");
    reactivarReembolsoAnulado(idReembolso, estado);
  }
);

function reactivarReembolsoAnulado(idReembolso, estado) {
  Swal.fire({
    title: "Está seguro?",
    text: "No podrás revertir esto.!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, desea cambiar estado!",
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = new FormData();

      datos.append("idReembolso", idReembolso);
      datos.append("estado", estado);

      $.ajax({
        url: "controller/reembolsos-clientes/controlador_reembolso_asistencia_medica_individual_reactivar.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          if (respuesta > 0) {
            Swal.fire(
              "Estado Actualizado",
              "Su reembolso se ha activado",
              "success"
            ).then((value) => {
              table_listar_reembolsos_asistencia_medica_individual.ajax.reload();
            });
          }
        },
      });
    }
  });
}

/*********************************
 ABRI MODAL VALIDAR REEMBOLSO
 *********************************/
$("#tabla-listar-reembolsos-asistencia-medica-individual").on(
  "click",
  ".btnValidarDocumentosReembolso",
  function () {
    var idReembolso = $(this).attr("idReembolso");
    var idBayer = $(this).attr("idBayer");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#txt_idReembolso").val(idReembolso);
    $("#txt_idBayer").val(idBayer);
    $("#txt_idContrato").val(idContrato);
    $("#validarNombrePaciente").text(paciente);

    $("#modalModificarReembolso").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalModificarReembolso").modal("show");
    Limpiar_Validar_Reembolso();
    listarValidaDatosReembolso();
  }
);

function Limpiar_Validar_Reembolso() {
  $("#radio_solicitud_2").prop("checked", true);
  $("#radio_factura_medica_2").prop("checked", true);
  $("#radio_factura_medicina_2").prop("checked", true);
  $("#radio_receta_medica_2").prop("checked", true);
  $("#radio_factura_laboratorio_2").prop("checked", true);
  $("#radio_pedido_examenes_2").prop("checked", true);
  $("#radio_resultado_examenes_2").prop("checked", true);
  $("#radio_historia_clinica_2").prop("checked", true);
  $("#radio_protocolo_operatorio_2").prop("checked", true);
  $("#radio_hoja_emergencia_008_2").prop("checked", true);
  $("#radio_factura_detallada_2").prop("checked", true);
  $("#radio_estado_cuenta_hospital_2").prop("checked", true);
  $("#radio_pedido_fisioterapia_2").prop("checked", true);
  $("#radio_factura_fisioterapia_2").prop("checked", true);
  $("#radio_bitacora_asistencia_fisioterapia_2").prop("checked", true);
  $("#txt_fecha_seguimiento_validar").val("");
  $("#txt_observaciones_reembolso").val("");
  $("#listaObservacionesDatosReembolso").val("");
}

function crear_overlay_validar_reembolso_asistencia_medica() {
  $("#modalValidarDocumentosReembolso").append(
    '<div class="overlay dark" id="overlayValidarDocumentoReembolso"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_validar_reembolso_asistencia_medica() {
  $("#overlayValidarDocumentoReembolso").remove();
}

/*********************************
 MODIFICAR VALIDAR REEMBOLSO
 *********************************/
function Modificar_Validar_Reembolso() {
  listarObservacionesValidarDatosReembolso();

  var idReembolso = $("#txt_idReembolso").val();
  var idBayer = $("#txt_idBayer").val();
  var idContrato = $("#txt_idContrato").val();
  var listaValidarDatosReembolso = $("#listaValidarDatosReembolso").val();
  var fecha_seguimiento_validar = $("#txt_fecha_seguimiento_validar").val();
  var listaObservacionesDatosReembolso = $(
    "#listaObservacionesDatosReembolso"
  ).val();

  var cont = 0;
  var cont1 = 0;

  if (listaValidarDatosReembolso.length > 0) {
    var data = JSON.parse(listaValidarDatosReembolso);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var estado = data[i]["estado"];
        if (estado == "NO") {
          cont++;
        }
      }
    }
  }
  if (listaObservacionesDatosReembolso.length > 0) {
    var data1 = JSON.parse(listaObservacionesDatosReembolso);
    if (data1.length > 0) {
      for (var i = 0; i < data1.length; i++) {
        var observacion = data1[i]["observaciones"];

        if (observacion.length > 0) {
          cont1++;
        }
      }
    }
  }

  if (listaValidarDatosReembolso.length == 0) {
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

  crear_overlay_validar_reembolso_asistencia_medica();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);
  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);
  datos.append("listaValidarDatosReembolso", listaValidarDatosReembolso);
  datos.append("fecha_seguimiento_validar", fecha_seguimiento_validar);
  datos.append(
    "listaObservacionesDatosReembolso",
    listaObservacionesDatosReembolso
  );
  datos.append("contar_validar", cont);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_reembolso_asistencia_medica_individual_validar_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Validar Reembolso Modificado Exitosamente",
          "success"
        ).then((value) => {
          $("#modalModificarReembolso").modal("hide");
        });
      }
      table_listar_reembolsos_asistencia_medica_individual.ajax.reload();
      eliminar_overlay_validar_reembolso_asistencia_medica();
    },
  });
}

/*********************************
ABRIR MODAL OBSERVACIONES ADICIONALES SEGUIMIENTO REEMBOLSO
*********************************/
$("#tabla-listar-reembolsos-asistencia-medica-individual").on(
  "click",
  ".btnAgregarObservacionesAdicionales",
  function () {
    var idReembolso = $(this).attr("idReembolso");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#txt_idReembolso").val(idReembolso);
    $("#txt_idContrato").val(idContrato);
    $("#agregarObservacionAdicionalPaciente").text(paciente);

    $("#modalAgregarObservacionAdicionalReembolso").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarObservacionAdicionalReembolso").modal("show");

    $("#txt_fecha_seguimiento_observacion_adicional").val("");
    $("#txt_observaciones_adicionales_seguimiento_reembolso").val("");

    Cargar_Observaciones_Adicionales_Seguimientos_Reembolsos();
  }
);

function Cargar_Observaciones_Adicionales_Seguimientos_Reembolsos() {
  var idReembolso = $("#txt_idReembolso").val();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_observacion_reembolso_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesAdicionalesSeguimientosReembolsoAnterior").val(
          data[0]["reembolso_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesAdicionalesSeguimientosReembolsoAnterior").val(
          ""
        );
      }
    },
  });
}

/*=============================================
     LISTAR OBSERVACIONES SEGUIMIENTOS REEMBOLSO
   =============================================*/

function listarObservacionesAdicionalesSeguimientoReembolso() {
  if (
    $("#txt_observaciones_adicionales_seguimiento_reembolso").val().length > 0
  ) {
    var listaObservacionesAdicionalesSeguimientosReembolso = [];
    var lista_observaciones = $(
      "#listaObservacionesAdicionalesSeguimientosReembolsoAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesAdicionalesSeguimientosReembolsoAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesAdicionalesSeguimientosReembolso.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $(
      "#txt_observaciones_adicionales_seguimiento_reembolso"
    )
      .val()
      .replace(/(\r\n|\n|\r|\t)/gm, " ")
      .toUpperCase();

    listaObservacionesAdicionalesSeguimientosReembolso.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesAdicionalesSeguimientosReembolso").val(
      JSON.stringify(listaObservacionesAdicionalesSeguimientosReembolso)
    );
  } else {
    $("#listaObservacionesAdicionalesSeguimientosReembolso").val(
      $("#listaObservacionesAdicionalesSeguimientosReembolsoAnterior").val()
    );
  }
}

function Modificar_Observaciones_adicionales_Seguimiento_Reembolso() {
  listarObservacionesAdicionalesSeguimientoReembolso();

  var idReembolso = $("#txt_idReembolso").val();
  var idContrato = $("#txt_idContrato").val();

  var fecha_seguimiento = $(
    "#txt_fecha_seguimiento_observacion_adicional"
  ).val();
  var observacion = $(
    "#txt_observaciones_adicionales_seguimiento_reembolso"
  ).val();
  var lista_observaciones_adicionales = $(
    "#listaObservacionesAdicionalesSeguimientosReembolso"
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

  datos.append("idReembolso", idReembolso);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "lista_observaciones_adicionales",
    lista_observaciones_adicionales
  );

  $.ajax({
    url: "controller/reembolsos-observaciones/controlador_reembolso_asistencia_medica_individual_observaciones_adicionales_modificar.php",
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
          $("#modalAgregarObservacionAdicionalReembolso").modal("hide");
          table_listar_reembolsos_asistencia_medica_individual.ajax.reload();
        });
      }
    },
  });
}

function Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos() {
  var idReembolso = $("#txt_idReembolso").val();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_documentos_adicionales_solictados_aseguradora_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaDocumentosSolicitadosAseguradoraAnterior").val(
          data[0]["reembolso_documentos_seguimiento"]
        );
      } else {
        $("#listaDocumentosSolicitadosAseguradoraAnterior").val("");
      }
      cargar_auto_documentos_aseguradora();
    },
  });
}

function Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos_1() {
  var idReembolso = $("#txt_idReembolso").val();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_documentos_adicionales_solictados_aseguradora_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaDocumentosSolicitadosAseguradoraAnterior_1").val(
          data[0]["reembolso_documentos_seguimiento_1"]
        );
      } else {
        $("#listaDocumentosSolicitadosAseguradoraAnterior_1").val("");
      }
      cargar_auto_documentos_aseguradora_1();
    },
  });
}

function Cargar_Observaciones_Seguimientos() {
  var idReembolso = $("#txt_idReembolso").val();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_observacion_reembolso_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesSeguimientosReembolsoAnterior").val(
          data[0]["reembolso_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesSeguimientosReembolsoAnterior").val("");
      }
    },
  });
}

function Cargar_Observaciones_Seguimientos_1() {
  var idReembolso = $("#txt_idReembolso").val();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_observacion_reembolso_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesSeguimientosReembolsoAnterior_1").val(
          data[0]["reembolso_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesSeguimientosReembolsoAnterior_1").val("");
      }
    },
  });
}

/*=============================================
    LISTAR OBSERVACIONES SEGUIMIENTOS REEMBOLSO
  =============================================*/

function listarObservacionesSeguimientoReembolso() {
  if ($("#txt_observaciones_seguimiento_reembolso").val().length > 0) {
    var listaObservacionesSeguimientosReembolso = [];
    var lista_observaciones = $(
      "#listaObservacionesSeguimientosReembolsoAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesSeguimientosReembolsoAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesSeguimientosReembolso.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_seguimiento_reembolso")
      .val()
      .replace(/(\r\n|\n|\r|\t)/gm, " ")
      .toUpperCase();

    listaObservacionesSeguimientosReembolso.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesSeguimientosReembolso").val(
      JSON.stringify(listaObservacionesSeguimientosReembolso)
    );
  } else {
    $("#listaObservacionesSeguimientosReembolso").val(
      $("#listaObservacionesSeguimientosReembolsoAnterior").val()
    );
  }
}

function listarObservacionesSeguimientoReembolso_1() {
  if ($("#txt_observaciones_seguimiento_reembolso_1").val().length > 0) {
    var listaObservacionesSeguimientosReembolso = [];
    var lista_observaciones = $(
      "#listaObservacionesSeguimientosReembolsoAnterior_1"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesSeguimientosReembolsoAnterior_1").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesSeguimientosReembolso.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_seguimiento_reembolso_1")
      .val()
      .replace(/(\r\n|\n|\r|\t)/gm, " ")
      .toUpperCase();

    listaObservacionesSeguimientosReembolso.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesSeguimientosReembolso_1").val(
      JSON.stringify(listaObservacionesSeguimientosReembolso)
    );
  } else {
    $("#listaObservacionesSeguimientosReembolso_1").val(
      $("#listaObservacionesSeguimientosReembolsoAnterior_1").val()
    );
  }
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

  $(".seguimientoDatosReembolso").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridSeguimientoReembolso">' +
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
      '<button type="button" class="form-control btn btn-danger quitarDocumento" idDocumento="' +
      numDocumentosRequeridosAseguradora +
      '"><i class="fa fa-times"></i></button>' +
      "</div>" +
      "</div>" +
      "</div>"
  );

  numDocumentosRequeridosAseguradora++;

  listarDocumentosAseguradora();
});

var numDocumentosRequeridosAseguradora_1 = 0;

$(".btnAgregarDocumentoRequeridoAseguradora_1").click(function () {
  var estado = "";

  if (numDocumentosRequeridosAseguradora_1 > 0) {
    estado = "d-md-none";
  } else {
    estado = "";
  }

  $(".seguimientoDatosReembolso_1").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridSeguimientoReembolso_1">' +
      "<!-- Documento -->" +
      '<div class="my-1 col-12 col-md-6 order-md-1 ' +
      estado +
      '">' +
      "<label>Documento</label>" +
      "</div>" +
      '<div class="my-1 col-12 col-md-6 order-md-5">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumerosLetras documentoRequerido_1" id="documentoRequerido' +
      numDocumentosRequeridosAseguradora_1 +
      '" name="documentoRequerido' +
      numDocumentosRequeridosAseguradora_1 +
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
      '<input class="form-check-input radio_seguimiento_si_1" type="radio" name="radio_seguimiento_' +
      numDocumentosRequeridosAseguradora_1 +
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
      '<input class="form-check-input radio_seguimiento_no_1" type="radio" name="radio_seguimiento_' +
      numDocumentosRequeridosAseguradora_1 +
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
      '<button type="button" class="form-control btn btn-danger quitarDocumento_1" idDocumento="' +
      numDocumentosRequeridosAseguradora_1 +
      '"><i class="fa fa-times"></i></button>' +
      "</div>" +
      "</div>" +
      "</div>"
  );

  numDocumentosRequeridosAseguradora_1++;

  listarDocumentosAseguradora_1();
});

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

      $(".seguimientoDatosReembolso").append(
        '<div class="col-12 my-1">' +
          '<div class="row gridSeguimientoReembolso">' +
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
          '<button type="button" class="form-control btn btn-danger quitarDocumento" idDocumento="' +
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

function cargar_auto_documentos_aseguradora_1() {
  numDocumentosRequeridosAseguradora_1 = 0;

  var lista_documentos_adicionales = $(
    "#listaDocumentosSolicitadosAseguradoraAnterior_1"
  ).val();

  if (lista_documentos_adicionales.length > 0) {
    lista_documentos_adicionales = JSON.parse(
      $("#listaDocumentosSolicitadosAseguradoraAnterior_1").val()
    );

    for (let i = 0; i < lista_documentos_adicionales.length; i++) {
      var estado = "";
      var estado_si = "";
      var estado_no = "";

      if (numDocumentosRequeridosAseguradora_1 > 0) {
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

      $(".seguimientoDatosReembolso_1").append(
        '<div class="col-12 my-1">' +
          '<div class="row gridSeguimientoReembolso_1">' +
          "<!-- Documento -->" +
          '<div class="my-1 col-12 col-md-6 order-md-1 ' +
          estado +
          '">' +
          "<label>Documento</label>" +
          "</div>" +
          '<div class="my-1 col-12 col-md-6 order-md-5">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras documentoRequerido_1" id="documentoRequerido' +
          numDocumentosRequeridosAseguradora_1 +
          '" name="documentoRequerido' +
          numDocumentosRequeridosAseguradora_1 +
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
          '<input class="form-check-input radio_seguimiento_si_1" type="radio" name="radio_seguimiento_' +
          numDocumentosRequeridosAseguradora_1 +
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
          '<input class="form-check-input radio_seguimiento_no_1" type="radio" name="radio_seguimiento_' +
          numDocumentosRequeridosAseguradora_1 +
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
          '<button type="button" class="form-control btn btn-danger quitarDocumento_1" idDocumento="' +
          numDocumentosRequeridosAseguradora_1 +
          '"><i class="fa fa-times"></i></button>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      numDocumentosRequeridosAseguradora_1++;
    }

    listarDocumentosAseguradora_1();
  }
}

/*=============================================
LISTAR DOCUMENTOS SOLICITADOS POR ASEGURADORA
=============================================*/

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

function listarDocumentosAseguradora_1() {
  var listaDocumentosSolicitadosAseguradora = [];

  var documento = $(".documentoRequerido_1");
  var estado = $(".radio_seguimiento_si_1");
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

  $("#listaDocumentosSolicitadosAseguradora_1").val(
    JSON.stringify(listaDocumentosSolicitadosAseguradora)
  );
}

$(".seguimientoDatosReembolso").on(
  "keyup",
  "input.documentoRequerido",
  function () {
    listarDocumentosAseguradora();
  }
);
$(".seguimientoDatosReembolso_1").on(
  "keyup",
  "input.documentoRequerido_1",
  function () {
    listarDocumentosAseguradora_1();
  }
);
/*=============================================
CAMBIOS EN RADIO SEGUIMIENTO
=============================================*/
$(".seguimientoDatosReembolso").on(
  "change",
  "input.radio_seguimiento_si",
  function () {
    listarDocumentosAseguradora();
  }
);
$(".seguimientoDatosReembolso").on(
  "change",
  "input.radio_seguimiento_no",
  function () {
    listarDocumentosAseguradora();
  }
);

$(".seguimientoDatosReembolso_1").on(
  "change",
  "input.radio_seguimiento_si_1",
  function () {
    listarDocumentosAseguradora_1();
  }
);
$(".seguimientoDatosReembolso_1").on(
  "change",
  "input.radio_seguimiento_no_1",
  function () {
    listarDocumentosAseguradora_1();
  }
);

/*=============================================
CAMBIOS EN FECHA DE SEGUIMIENTO
=============================================*/

$("#txt_fecha_seguimiento").change(function () {
  listarDocumentosAseguradora();
});

$("#txt_fecha_seguimiento_1").change(function () {
  listarDocumentosAseguradora_1();
});

/*=============================================
CAMBIOS EN OBSERVACIONES
=============================================*/
$("#txt_observaciones_seguimiento_reembolso").keyup(function () {
  listarDocumentosAseguradora();
});

$("#txt_observaciones_seguimiento_reembolso_1").keyup(function () {
  listarDocumentosAseguradora_1();
});

/*=============================================
QUITAR DOCUMENTOS SOLICITADOS POR ASEGURADORA
=============================================*/

var idQuitarDocumento = [];

localStorage.removeItem("quitarDocumento");

$(".seguimientoDatosReembolso").on(
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

    if ($(".seguimientoDatosReembolso").children().length == 0) {
      $("#listaDocumentosSolicitadosAseguradora").val("");
    } else {
      // AGRUPAR FAMILIARES EN FORMATO JSON
      listarDocumentosAseguradora();
    }
  }
);

var idQuitarDocumento_1 = [];

localStorage.removeItem("quitarDocumento_1");

$(".seguimientoDatosReembolso_1").on(
  "click",
  "button.quitarDocumento_1",
  function () {
    // $(this).parent().parent().parent().parent().parent().css({"color": "red", "border": "2px solid red"});
    // $(this).parent().parent().parent().css({"color": "red", "border": "2px solid red"});
    $(this).parent().parent().parent().remove();

    var idDocumento = $(this).attr("idDocumento");

    /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/

    if (localStorage.getItem("quitarDocumento_1") == null) {
      idQuitarDocumento_1 = [];
    } else {
      idQuitarDocumento_1.concat(localStorage.getItem("quitarDocumento_1"));
    }

    idQuitarDocumento_1.push({
      idDocumento: idDocumento,
    });

    localStorage.setItem(
      "quitarDocumento_1",
      JSON.stringify(idQuitarDocumento_1)
    );

    numDocumentosRequeridosAseguradora_1--;

    if ($(".seguimientoDatosReembolso_1").children().length == 0) {
      $("#listaDocumentosSolicitadosAseguradora_1").val("");
    } else {
      // AGRUPAR FAMILIARES EN FORMATO JSON
      listarDocumentosAseguradora_1();
    }
  }
);

/*********************************
ABRIR MODAL REGISTRAR SOLICTAR DOCUMENTOS FALTANTES SEGUIMIENTO
*********************************/
$("#tabla-listar-reembolsos-asistencia-medica-individual").on(
  "click",
  ".btnSeguimientoReembolsoAseguradora",
  function () {
    $("#modalAgregarSeguimientoReembolso").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarSeguimientoReembolso").modal("show");
    var idReembolso = $(this).attr("idReembolso");
    var idBayer = $(this).attr("idBayer");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarSeguimientoReembolsoPaciente").text(paciente);
    $("#txt_idReembolso").val(idReembolso);
    $("#txt_idBayer").val(idBayer);
    $("#txt_idContrato").val(idContrato);
    $("#enviarEmail").prop("checked", true);
    // $("#txt_fecha_seguimiento").val(fecha_actual());
    $("#txt_fecha_seguimiento").val("");
    $("#listaDocumentosSolicitadosAseguradora").val("");
    $(".seguimientoDatosReembolso").empty();
    Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos();
    Cargar_Observaciones_Seguimientos();
    listarObservacionesSeguimientoReembolso();
  }
);

/*********************************
ABRIR MODAL REGISTRAR SOLICTAR DOCUMENTOS FALTANTES SEGUIMIENTO
*********************************/
$("#tabla-listar-reembolsos-asistencia-medica-individual").on(
  "click",
  ".btnSeguimientoReembolsoAseguradora_1",
  function () {
    $("#modalAgregarSeguimientoReembolso_1").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarSeguimientoReembolso_1").modal("show");
    var idReembolso = $(this).attr("idReembolso");
    var idBayer = $(this).attr("idBayer");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarSeguimientoReembolsoPaciente1").text(paciente);
    $("#txt_idReembolso").val(idReembolso);
    $("#txt_idBayer").val(idBayer);
    $("#txt_idContrato").val(idContrato);
    $("#enviarEmail_1").prop("checked", true);
    // $("#txt_fecha_seguimiento").val(fecha_actual());
    $("#txt_fecha_seguimiento_1").val("");
    $("#listaDocumentosSolicitadosAseguradora_1").val("");
    $(".seguimientoDatosReembolso_1").empty();
    Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos_1();
    Cargar_Observaciones_Seguimientos_1();
    listarObservacionesSeguimientoReembolso_1();
  }
);

function crear_overlay_seguimiento_reembolso_asistencia_medica() {
  $("#modalSeguimientoReembolso").append(
    '<div class="overlay dark" id="overlaySeguimientoReembolsoAsistenciaMedica"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_seguimiento_reembolso_asistencia_medica() {
  $("#overlaySeguimientoReembolsoAsistenciaMedica").remove();
}

function Modificar_Seguimiento_Reembolso() {
  listarObservacionesSeguimientoReembolso();

  var idReembolso = $("#txt_idReembolso").val();
  var idBayer = $("#txt_idBayer").val();
  var idContrato = $("#txt_idContrato").val();
  var listaDocumentosSolicitadosAseguradora = $(
    "#listaDocumentosSolicitadosAseguradora"
  ).val();
  var enviar_mail = "";
  var fecha_seguimiento = $("#txt_fecha_seguimiento").val();
  var observaciones = $("#txt_observaciones_seguimiento_reembolso").val();
  var listaObservacionesSeguimientosReembolso = $(
    "#listaObservacionesSeguimientosReembolso"
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
        var documento = data[i]["documento"];

        if (documento.length == 0) {
          cont++;
        }
      }
    }
  }

  if (listaObservacionesSeguimientosReembolso.length > 0) {
    var data1 = JSON.parse(listaObservacionesSeguimientosReembolso);
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
    "#txt_documento_reembolso_documento_pedido_aseguradora"
  ).val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_reembolso_documento_pedido_aseguradora")[0]
    .files[0];

  crear_overlay_seguimiento_reembolso_asistencia_medica();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);
  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);
  datos.append(
    "listaDocumentosSolicitadosAseguradora",
    listaDocumentosSolicitadosAseguradora
  );
  datos.append("enviar_mail", enviar_mail);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesSeguimientosReembolso",
    listaObservacionesSeguimientosReembolso
  );
  datos.append("estado_caducado", estado_caducado);
  datos.append("documento", documento);
  datos.append("extension", extension);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_reembolso_asistencia_medica_individual_seguimiento_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Seguimiento Reembolso Modificado Exitosamente",
          "success"
        ).then((value) => {
          eliminar_overlay_seguimiento_reembolso_asistencia_medica();
          $("#modalAgregarSeguimientoReembolso").modal("hide");
          table_listar_reembolsos_asistencia_medica_individual.ajax.reload();
        });
      }
    },
  });
}

function crear_overlay_seguimiento_reembolso_asistencia_medica_1() {
  $("#modalSeguimientoReembolso_1").append(
    '<div class="overlay dark" id="overlaySeguimientoReembolsoAsistenciaMedica_1"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_seguimiento_reembolso_asistencia_medica_1() {
  $("#overlaySeguimientoReembolsoAsistenciaMedica_1").remove();
}

function Modificar_Seguimiento_Reembolso_1() {
  listarObservacionesSeguimientoReembolso_1();

  var idReembolso = $("#txt_idReembolso").val();
  var idBayer = $("#txt_idBayer").val();
  var idContrato = $("#txt_idContrato").val();
  var listaDocumentosSolicitadosAseguradora = $(
    "#listaDocumentosSolicitadosAseguradora_1"
  ).val();
  var enviar_mail = "";
  var fecha_seguimiento = $("#txt_fecha_seguimiento_1").val();
  var observaciones = $("#txt_observaciones_seguimiento_reembolso_1").val();
  var listaObservacionesSeguimientosReembolso = $(
    "#listaObservacionesSeguimientosReembolso_1"
  ).val();
  var documento;

  var estado_caducado = "";

  if ($("#enviarEmail_1").is(":checked")) {
    enviar_mail = "SI";
  } else {
    enviar_mail = "NO";
  }

  if ($("#estadoCaducado_1").is(":checked")) {
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
        var documento = data[i]["documento"];

        if (documento.length == 0) {
          cont++;
        }
      }
    }
  }

  if (listaObservacionesSeguimientosReembolso.length > 0) {
    var data1 = JSON.parse(listaObservacionesSeguimientosReembolso);
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
    "#txt_documento_reembolso_documento_pedido_aseguradora_1"
  ).val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_reembolso_documento_pedido_aseguradora_1")[0]
    .files[0];

  crear_overlay_seguimiento_reembolso_asistencia_medica_1();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);
  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);
  datos.append(
    "listaDocumentosSolicitadosAseguradora",
    listaDocumentosSolicitadosAseguradora
  );
  datos.append("enviar_mail", enviar_mail);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesSeguimientosReembolso",
    listaObservacionesSeguimientosReembolso
  );
  datos.append("estado_caducado", estado_caducado);
  datos.append("documento", documento);
  datos.append("extension", extension);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_reembolso_asistencia_medica_individual_seguimiento_modificar_1.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Seguimiento Reembolso Modificado Exitosamente",
          "success"
        ).then((value) => {
          eliminar_overlay_seguimiento_reembolso_asistencia_medica_1();
          $("#modalAgregarSeguimientoReembolso_1").modal("hide");
          table_listar_reembolsos_asistencia_medica_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
ABRIR MODAL REGISTRAR DOCUMENTO ADICIONAL
*********************************/
$("#tabla-listar-reembolsos-asistencia-medica-individual").on(
  "click",
  ".btnAgregarDocumentoSeguimiento",
  function () {
    $("#modalAgregarDocumentoSeguimientoReembolso").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarDocumentoSeguimientoReembolso").modal("show");
    var idReembolso = $(this).attr("idReembolso");
    var idBayer = $(this).attr("idBayer");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarDocumentoSeguimientoReembolsoPaciente").text(paciente);
    $("#txt_idReembolso").val(idReembolso);
    $("#txt_idBayer").val(idBayer);
    $("#txt_idContrato").val(idContrato);
    $("#txt_fecha_documento_seguimiento_aseguradora").val("");
    $("#txt_observaciones_documento_seguimiento_reembolso").val("");
    $("#txt_documento_reembolso_documento_seguimiento").val("");
    Cargar_Observaciones_Documentos_Seguimientos();
  }
);

/*********************************
ABRIR MODAL REGISTRAR DOCUMENTO ADICIONAL2
*********************************/
$("#tabla-listar-reembolsos-asistencia-medica-individual").on(
  "click",
  ".btnAgregarDocumentoSeguimiento_1",
  function () {
    $("#modalAgregarDocumentoSeguimientoReembolso_1").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarDocumentoSeguimientoReembolso_1").modal("show");
    var idReembolso = $(this).attr("idReembolso");
    var idBayer = $(this).attr("idBayer");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarDocumentoSeguimientoPaciente1").text(paciente);
    $("#txt_idReembolso").val(idReembolso);
    $("#txt_idBayer").val(idBayer);
    $("#txt_idContrato").val(idContrato);
    $("#txt_fecha_documento_seguimiento_aseguradora_1").val("");
    $("#txt_observaciones_documento_seguimiento_reembolso_1").val("");
    $("#txt_documento_reembolso_documento_seguimiento_1").val("");
    Cargar_Observaciones_Documentos_Seguimientos_1();
  }
);

/*=============================================
  CARGAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS REEMBOLSO
=============================================*/

function Cargar_Observaciones_Documentos_Seguimientos() {
  var idReembolso = $("#txt_idReembolso").val();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_observacion_reembolso_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesDocumentoSeguimientosReembolsoAnterior").val(
          data[0]["reembolso_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesDocumentoSeguimientosReembolsoAnterior").val("");
      }
    },
  });
}

/*=============================================
  CARGAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS REEMBOLSO
=============================================*/

function Cargar_Observaciones_Documentos_Seguimientos_1() {
  var idReembolso = $("#txt_idReembolso").val();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_observacion_reembolso_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesDocumentoSeguimientosReembolsoAnterior_1").val(
          data[0]["reembolso_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesDocumentoSeguimientosReembolsoAnterior_1").val(
          ""
        );
      }
    },
  });
}

/*=============================================
    LISTAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS REEMBOLSO
  =============================================*/

function listarObservacionesDocumentosSeguimientoReembolso() {
  if (
    $("#txt_observaciones_documento_seguimiento_reembolso").val().length > 0
  ) {
    var listaObservacionesDocumentoSeguimientosReembolso = [];
    var lista_observaciones = $(
      "#listaObservacionesDocumentoSeguimientosReembolsoAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesDocumentoSeguimientosReembolsoAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesDocumentoSeguimientosReembolso.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_documento_seguimiento_reembolso")
      .val()
      .replace(/(\r\n|\n|\r|\t)/gm, " ")
      .toUpperCase();

    listaObservacionesDocumentoSeguimientosReembolso.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesDocumentoSeguimientosReembolso").val(
      JSON.stringify(listaObservacionesDocumentoSeguimientosReembolso)
    );
  } else {
    $("#listaObservacionesDocumentoSeguimientosReembolso").val(
      $("#listaObservacionesDocumentoSeguimientosReembolsoAnterior").val()
    );
  }
}

/*=============================================
  LISTAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS REEMBOLSO
=============================================*/

function listarObservacionesDocumentosSeguimientoReembolso_1() {
  if (
    $("#txt_observaciones_documento_seguimiento_reembolso_1").val().length > 0
  ) {
    var listaObservacionesDocumentoSeguimientosReembolso = [];
    var lista_observaciones = $(
      "#listaObservacionesDocumentoSeguimientosReembolsoAnterior_1"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesDocumentoSeguimientosReembolsoAnterior_1").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesDocumentoSeguimientosReembolso.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $(
      "#txt_observaciones_documento_seguimiento_reembolso_1"
    )
      .val()
      .replace(/(\r\n|\n|\r|\t)/gm, " ")
      .toUpperCase();

    listaObservacionesDocumentoSeguimientosReembolso.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesDocumentoSeguimientosReembolso_1").val(
      JSON.stringify(listaObservacionesDocumentoSeguimientosReembolso)
    );
  } else {
    $("#listaObservacionesDocumentoSeguimientosReembolso_1").val(
      $("#listaObservacionesDocumentoSeguimientosReembolsoAnterior_1").val()
    );
  }
}

function crear_overlay_documento_seguimiento_reembolso_asistencia_medica() {
  $("#modalDocumentoSeguimientoReembolso").append(
    '<div class="overlay dark" id="overlayDocumentoSeguimientoAsistenciaMedica"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_documento_seguimiento_reembolso_asistencia_medica() {
  $("#overlayDocumentoSeguimientoAsistenciaMedica").remove();
}

function crear_overlay_documento_seguimiento_reembolso_asistencia_medica_1() {
  $("#modalDocumentoSeguimientoReembolso_1").append(
    '<div class="overlay dark" id="overlayDocumentoSeguimientoAsistenciaMedica_1"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_documento_seguimiento_reembolso_asistencia_medica_1() {
  $("#overlayDocumentoSeguimientoAsistenciaMedica_1").remove();
}

/*****************************************************
   REGISTRAR UN NUEVO DOCUMENTO SEGUIMIENTO REEMBOLSO
   ***************************************************/
function Registrar_Documento_Seguimiento_Reembolso() {
  listarObservacionesDocumentosSeguimientoReembolso();

  var idReembolso = $("#txt_idReembolso").val().toUpperCase();
  var idBayer = $("#txt_idBayer").val().toUpperCase();
  var idContrato = $("#txt_idContrato").val().toUpperCase();
  var fecha_seguimiento = $(
    "#txt_fecha_documento_seguimiento_aseguradora"
  ).val();
  var observaciones = $(
    "#txt_observaciones_documento_seguimiento_reembolso"
  ).val();
  var listaObservacionesDocumentoSeguimientosReembolso = $(
    "#listaObservacionesDocumentoSeguimientosReembolso"
  ).val();

  var documento;

  var cont1 = 0;

  if (listaObservacionesDocumentoSeguimientosReembolso.length > 0) {
    var data1 = JSON.parse(listaObservacionesDocumentoSeguimientosReembolso);
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

  if ($("#txt_documento_reembolso_documento_seguimiento").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $("#txt_documento_reembolso_documento_seguimiento").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_reembolso_documento_seguimiento")[0].files[0];

  crear_overlay_documento_seguimiento_reembolso_asistencia_medica();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);
  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesDocumentoSeguimientosReembolso",
    listaObservacionesDocumentoSeguimientosReembolso
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_reembolso_asistencia_medica_individual_documento_seguimiento_registro.php",
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
          eliminar_overlay_documento_seguimiento_reembolso_asistencia_medica();
          $("#modalAgregarDocumentoSeguimientoReembolso").modal("hide");
          table_listar_reembolsos_asistencia_medica_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_documento_seguimiento_reembolso_asistencia_medica();
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
      }
    },
  });
}

/*****************************************************
 REGISTRAR UN NUEVO DOCUMENTO SEGUIMIENTO REEMBOLSO
 ***************************************************/
function Registrar_Documento_Seguimiento_Reembolso_1() {
  listarObservacionesDocumentosSeguimientoReembolso_1();

  var idReembolso = $("#txt_idReembolso").val().toUpperCase();
  var idBayer = $("#txt_idBayer").val().toUpperCase();
  var idContrato = $("#txt_idContrato").val().toUpperCase();
  var fecha_seguimiento = $(
    "#txt_fecha_documento_seguimiento_aseguradora_1"
  ).val();
  var observaciones = $(
    "#txt_observaciones_documento_seguimiento_reembolso_1"
  ).val();
  var listaObservacionesDocumentoSeguimientosReembolso = $(
    "#listaObservacionesDocumentoSeguimientosReembolso_1"
  ).val();

  var documento;

  var cont1 = 0;

  if (listaObservacionesDocumentoSeguimientosReembolso.length > 0) {
    var data1 = JSON.parse(listaObservacionesDocumentoSeguimientosReembolso);
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

  if ($("#txt_documento_reembolso_documento_seguimiento_1").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $("#txt_documento_reembolso_documento_seguimiento_1").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_reembolso_documento_seguimiento_1")[0].files[0];

  crear_overlay_documento_seguimiento_reembolso_asistencia_medica_1();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);
  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesDocumentoSeguimientosReembolso",
    listaObservacionesDocumentoSeguimientosReembolso
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_reembolso_asistencia_medica_individual_documento_seguimiento_1_registro.php",
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
          eliminar_overlay_documento_seguimiento_reembolso_asistencia_medica_1();
          $("#modalAgregarDocumentoSeguimientoReembolso_1").modal("hide");
          table_listar_reembolsos_asistencia_medica_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_documento_seguimiento_reembolso_asistencia_medica_1();
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
ABRI MODAL REGISTRAR LIQUIDACION
*********************************/
$("#tabla-listar-reembolsos-asistencia-medica-individual").on(
  "click",
  ".btnAgregarLiquidacion",
  function () {
    $("#modalAgregarDocumentoLiquidacionReembolso").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarDocumentoLiquidacionReembolso").modal("show");
    var idReembolso = $(this).attr("idReembolso");
    var idBayer = $(this).attr("idBayer");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarDocumentoLiquidacionReembolsoPaciente").text(paciente);
    $("#txt_idReembolso").val(idReembolso);
    $("#txt_idBayer").val(idBayer);
    $("#txt_idContrato").val(idContrato);

    LimpiarRegistroDocumentoLiquidacion();
    cargar_deducible_dependiente_reembolso();
    Cargar_Observaciones_Liquidacion_Seguimientos();
  }
);

function LimpiarRegistroDocumentoLiquidacion() {
  $("#txt_deducible_contrato_dependiente").val(0.0);
  $("#txt_valor_deducible").val(0.0);
  $("#txt_saldo_deducible").val(0.0);
  $("#txt_valor_presentado_liquidacion").val(0.0);
  $("#txt_valor_no_cubierto").val(0.0);
  $("#txt_valor_reembolsado").val(0.0);
  $("#txt_valor_copago").val(0.0);
  $("#txt_documento_reembolso_documento_liquidacion").val("");

  // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
  $(".valor_liquidacion").number(true, 2);
}

function cargar_deducible_dependiente_reembolso() {
  var idReembolso = $("#txt_idReembolso").val();
  var idBayer = $("#txt_idBayer").val();
  var idContrato = $("#txt_idContrato").val();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);
  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_traer_reembolso_asistencia_medica_individual.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        for (let i = 0; i < data.length; i++) {
          $("#txt_idBayer").val(data[i]["bayer_id"]);
          $("#listaDependientes").val(data[i]["cliente_familiares"]);
          var lista_reembolso = JSON.parse(data[i]["reembolso_descripcion"]);
          var lista_dependiente = JSON.parse(data[i]["cliente_familiares"]);
          var paciente = lista_reembolso[0]["nombre_paciente"];
          $("#txt_paciente_reembolso").val(paciente);
          var deducible = 0;

          for (let j = 0; j < lista_dependiente.length; j++) {
            var dependiente = lista_dependiente[j]["nombre"];
            if (dependiente == paciente) {
              deducible = lista_dependiente[j]["valor_deducible"];
              $("#txt_deducible_contrato_dependiente").val(deducible);
              $("#txt_saldo_deducible").val(deducible);
            }
          }
        }
      }
    },
  });
}

/*=============================================
  CARGAR OBSERVACIONES LIQUIDACIONES REEMBOLSO
=============================================*/

function Cargar_Observaciones_Liquidacion_Seguimientos() {
  var idReembolso = $("#txt_idReembolso").val();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_observacion_reembolso_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesLiquidacionReembolsoAnterior").val(
          data[0]["reembolso_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesLiquidacionReembolsoAnterior").val("");
      }
    },
  });
}
// Calcular saldo deducible
function calcular_saldo_deducible() {
  var saldo =
    $("#txt_deducible_contrato_dependiente").val() -
    $("#txt_valor_deducible").val();
  $("#txt_saldo_deducible").val(saldo);
}

// Calcular valor reembolso
function calcular_valor_reembolso() {
  var valor =
    $("#txt_valor_presentado_liquidacion").val() -
    $("#txt_valor_no_cubierto").val() -
    $("#txt_valor_deducible").val() -
    $("#txt_valor_copago").val();

  $("#txt_valor_reembolsado").val(valor.toFixed(2));
}

$("#txt_valor_presentado_liquidacion").keyup(function () {
  calcular_valor_reembolso();
});

$("#txt_valor_presentado_liquidacion").change(function () {
  calcular_valor_reembolso();
});

$("#txt_valor_no_cubierto").keyup(function () {
  calcular_valor_reembolso();
});

$("#txt_valor_no_cubierto").change(function () {
  calcular_valor_reembolso();
});

$("#txt_valor_deducible").keyup(function () {
  calcular_valor_reembolso();
  calcular_saldo_deducible();
});

$("#txt_valor_deducible").change(function () {
  calcular_valor_reembolso();
  calcular_saldo_deducible();
});

$("#txt_valor_copago").keyup(function () {
  calcular_valor_reembolso();
});

$("#txt_valor_copago").change(function () {
  calcular_valor_reembolso();
});

function actualizar_deducible_dependiente() {
  var lista = $("#listaDependientes").val();

  var listaDependencia = [];

  if (lista.length > 0) {
    lista = JSON.parse($("#listaDependientes").val());
    var saldo = 0;
    for (let i = 0; i < lista.length; i++) {
      if (lista[i]["nombre"] == $("#txt_paciente_reembolso").val()) {
        saldo = $("#txt_saldo_deducible").val();
      } else {
        saldo = lista[i]["valor_deducible"];
      }

      listaDependencia.push({
        tipo: lista[i]["tipo"],
        nombre: lista[i]["nombre"],
        genero: lista[i]["genero"],
        fecha_nacimiento: lista[i]["fecha_nacimiento"],
        edad: lista[i]["edad"],
        valor_deducible: saldo,
      });
    }
  }

  $("#listaDependientes").val(JSON.stringify(listaDependencia));
}

/*=============================================
     LISTAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS REEMBOLSO
   =============================================*/

function listarObservacionesLiquidacionReembolso() {
  if ($("#txt_observaciones_liquidacion_reembolso").val().length > 0) {
    var listaObservacionesLiquidacionReembolso = [];
    var lista_observaciones = $(
      "#listaObservacionesLiquidacionReembolsoAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesLiquidacionReembolsoAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesLiquidacionReembolso.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_liquidacion_reembolso")
      .val()
      .replace(/(\r\n|\n|\r|\t)/gm, " ")
      .toUpperCase();

    listaObservacionesLiquidacionReembolso.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesLiquidacionReembolso").val(
      JSON.stringify(listaObservacionesLiquidacionReembolso)
    );
  } else {
    $("#listaObservacionesLiquidacionReembolso").val(
      $("#listaObservacionesLiquidacionReembolsoAnterior").val()
    );
  }
}

function crear_overlay_documento_liquidacion_reembolso_asistencia_medica() {
  $("#modalDocumentoLiquidacionReembolso").append(
    '<div class="overlay dark" id="overlayDocumentoLiquidacionReembolsoAsistenciaMedica"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_documento_liquidacion_reembolso_asistencia_medica() {
  $("#overlayDocumentoLiquidacionReembolsoAsistenciaMedica").remove();
}

/*********************************
   REGISTRAR LIQUIDACION REEMBOLSO
   *********************************/
function Registrar_Documento_Liquidacion_Reembolso() {
  actualizar_deducible_dependiente();
  calcular_valor_reembolso();
  listarObservacionesLiquidacionReembolso();

  var idReembolso = $("#txt_idReembolso").val();
  var idBayer = $("#txt_idBayer").val();
  var idContrato = $("#txt_idContrato").val();
  var lista_dependientes = $("#listaDependientes").val();
  var deducible_contrato = $("#txt_deducible_contrato_dependiente").val();
  var valor_cobrado = $("#txt_valor_deducible").val();
  var saldo_deducible = $("#txt_saldo_deducible").val();
  var valor_presentado = $("#txt_valor_presentado_liquidacion").val();
  var valor_no_cubierto = $("#txt_valor_no_cubierto").val();
  var valor_copago = $("#txt_valor_copago").val();
  var valor_reembolsado = $("#txt_valor_reembolsado").val();
  var listaObservacionesLiquidacionReembolso = $(
    "#listaObservacionesLiquidacionReembolso"
  ).val();

  var documento;

  if (
    idBayer.length == 0 ||
    lista_dependientes.length == 0 ||
    deducible_contrato.length == 0 ||
    valor_cobrado.length == 0 ||
    saldo_deducible.length == 0 ||
    valor_presentado.length == 0 ||
    valor_no_cubierto.length == 0 ||
    valor_copago.length == 0 ||
    valor_reembolsado.length == 0
  ) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingrese valores numericos en los campos vacios",
      "warning"
    );
  }

  if ($("#txt_documento_reembolso_documento_liquidacion").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $("#txt_documento_reembolso_documento_liquidacion").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_reembolso_documento_liquidacion")[0].files[0];

  crear_overlay_documento_liquidacion_reembolso_asistencia_medica();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);
  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);
  datos.append("lista_dependientes", lista_dependientes);
  datos.append("deducible_contrato", deducible_contrato);
  datos.append("valor_cobrado", valor_cobrado);
  datos.append("saldo_deducible", saldo_deducible);
  datos.append("valor_presentado", valor_presentado);
  datos.append("valor_no_cubierto", valor_no_cubierto);
  datos.append("valor_copago", valor_copago);
  datos.append("valor_reembolsado", valor_reembolsado);
  datos.append(
    "listaObservacionesLiquidacionReembolso",
    listaObservacionesLiquidacionReembolso
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_reembolso_asistencia_medica_individual_documento_liquidacion_registro.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta != "") {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Nueva Liquidacion Registrado",
          "success"
        ).then((value) => {
          eliminar_overlay_documento_liquidacion_reembolso_asistencia_medica();
          $("#modalAgregarDocumentoLiquidacionReembolso").modal("hide");
          table_listar_reembolsos_asistencia_medica_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_documento_liquidacion_reembolso_asistencia_medica();
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
ABRIR MODAL OBSERVACIONES ADICIONALES SEGUIMIENTO REEMBOLSO
*********************************/
$("#tabla-listar-reembolsos-asistencia-medica-individual").on(
  "click",
  ".btnAgregarAnulacion",
  function () {
    var idReembolso = $(this).attr("idReembolso");
    var paciente = $(this).attr("paciente");

    $("#agregarAnulacionReembolsoPaciente").text(paciente);
    $("#txt_idReembolso").val(idReembolso);

    $("#modalAgregarAnulacionReembolso").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarAnulacionReembolso").modal("show");

    Cargar_Observaciones_Anulacion_Reembolsos();
  }
);

function Cargar_Observaciones_Anulacion_Reembolsos() {
  var idReembolso = $("#txt_idReembolso").val();

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_observacion_reembolso_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesAnulacionReembolsoAnterior").val(
          data[0]["reembolso_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesAnulacionReembolsoAnterior").val("");
      }
    },
  });
}

/*=============================================
     LISTAR OBSERVACIONES ANULACION REEMBOLSO
   =============================================*/

function listarObservacionesAnulacionReembolso() {
  if ($("#txt_observaciones_anulacion_reembolso").val().length > 0) {
    var listaObservacionesAnulacionReembolso = [];
    var lista_observaciones = $(
      "#listaObservacionesAnulacionReembolsoAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesAnulacionReembolsoAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesAnulacionReembolso.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_anulacion_reembolso")
      .val()
      .replace(/(\r\n|\n|\r|\t)/gm, " ")
      .toUpperCase();

    listaObservacionesAnulacionReembolso.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesAnulacionReembolso").val(
      JSON.stringify(listaObservacionesAnulacionReembolso)
    );
  } else {
    $("#listaObservacionesAnulacionReembolso").val(
      $("#listaObservacionesAnulacionReembolsoAnterior").val()
    );
  }
}

function Modificar_Observaciones_Anulacion_Reembolso() {
  listarObservacionesAnulacionReembolso();

  var idReembolso = $("#txt_idReembolso").val();
  var observacion = $("#txt_observaciones_anulacion_reembolso").val();
  var lista_observaciones_anulacion = $(
    "#listaObservacionesAnulacionReembolso"
  ).val();

  if (observacion.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar una observaci&oacute;n",
      "warning"
    );
  }

  var datos = new FormData();

  datos.append("idReembolso", idReembolso);
  datos.append("lista_observaciones_anulacion", lista_observaciones_anulacion);

  $.ajax({
    url: "controller/reembolsos-observaciones/controlador_reembolso_asistencia_medica_individual_observaciones_anulacion_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Anulado correctamente",
          "success"
        ).then((value) => {
          $("#modalAgregarAnulacionReembolso").modal("hide");
          table_listar_reembolsos_asistencia_medica_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRO DE REEMBOLSO
 *********************************/
function AbrirModalRegistro() {
  $("#modalAgregarReembolso").modal({ backdrop: "static", keyboard: false });
  $("#modalAgregarReembolso").modal("show");
  LimpiarRegistro();
}

function LimpiarRegistro() {
  $("#txt_idBayer").val("");
  $("#txt_contrato_aplicar").val("");
  $("#cbm_nombre_paciente").empty();
  $("#cbm_nombre_paciente").append("<option value=''>SIN REGISTROS</option>");
  $("#txt_fecha_atencion").val("");
  $("#txt_valor_presentado").val("");
  $("#txt_diagnostico").val("");
  $("#txt_documento_reembolso").val("");
}

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

  var fecha_actual = $("#txt_fecha_atencion").val();

  if (fecha_actual == "") {
    fecha_envio = fecha;
  } else {
    fecha_envio = fecha_actual;
  }

  table_listar_contratos_cliente = $(
    "#table_listar_contratos_cliente"
  ).DataTable({
    responsive: true,
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
    ajax:
      "controller/contratos-clientes/controlador_contrato_cliente_asistencia_medica_individual_listar_todos.php?fecha=" +
      fecha_envio,
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $($(nRow).find("td")[0]).css("text-align", "center");
      $($(nRow).find("td")[1]).css("text-align", "center");
      $($(nRow).find("td")[2]).css("text-align", "center");
      $($(nRow).find("td")[3]).css("text-align", "center");
      $($(nRow).find("td")[4]).css("text-align", "center");
      $($(nRow).find("td")[5]).css("text-align", "center");
      $($(nRow).find("td")[6]).css("text-align", "center");
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

function listarDatosReembolso() {
  var listaDatosReembolso = [];

  var nombre_paciente = $(".cbm_nombre_paciente");
  var fecha_atencion = $(".fecha_atencion");
  var valor_presentado = $(".valor_presentado");
  var diagnostico = $(".diagnostico_reembolso");

  for (var i = 0; i < nombre_paciente.length; i++) {
    var diagnostico_valor = $(diagnostico[i])
      .val()
      .replace(/(\r\n|\n|\r|\t)/gm, " ")
      .toUpperCase();
    listaDatosReembolso.push({
      nombre_paciente: $(nombre_paciente[i]).val().toUpperCase(),
      fecha_atencion: $(fecha_atencion[i]).val(),
      valor_presentado: $(valor_presentado[i]).val(),
      diagnostico: diagnostico_valor,
    });
  }

  $("#listaDatosReembolso").val(JSON.stringify(listaDatosReembolso));
}

function crear_overlay_reembolso_cliente_asistencia_medica() {
  $("#modalNuevoReembolso").append(
    '<div class="overlay dark" id="overlayNuevoReembolso"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_reembolso_cliente_asistencia_medica() {
  $("#overlayNuevoReembolso").remove();
}

/*********************************
 REGISTRAR UN NUEVO REEMBOLSO
 *********************************/
function Registrar_Reembolso() {
  listarDatosReembolso();

  var idBayer = $("#txt_idBayer").val().toUpperCase();
  var idContrato = $("#txt_idContrato").val().toUpperCase();
  var listaDatosReembolso = $("#listaDatosReembolso").val();
  var documento;

  var cont = 0;
  var cont_dias_validos = 0;

  if (listaDatosReembolso.length > 0) {
    var data = JSON.parse(listaDatosReembolso);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var nombre_paciente = data[i]["nombre_paciente"];
        var fecha_atencion = data[i]["fecha_atencion"];
        var valor_presentado = data[i]["valor_presentado"];
        var diagnostico = data[i]["diagnostico"];

        if (
          nombre_paciente.length == 0 ||
          fecha_atencion.length == 0 ||
          valor_presentado.length == 0 ||
          diagnostico.length == 0
        ) {
          cont++;
        } else {
          let hoy = new Date();

          fecha_atencion = fecha_atencion.split("-");

          var mydate = new Date(
            fecha_atencion[0],
            fecha_atencion[1] - 1,
            fecha_atencion[2]
          );

          let diferencia = hoy.getTime() - mydate.getTime();

          cont_dias_validos = Math.round(diferencia / (1000 * 60 * 60 * 24));
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

  if (listaDatosReembolso.length == 0 || cont > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios para el Reembolso",
      "warning"
    );
  }

  if ($("#txt_documento_reembolso").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  if (cont_dias_validos > 90) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "La fecha del reembolso ingresado es mayor a los 90 dias permitidos por la aseguradora",
      "warning"
    );
  }

  var archivo = $("#txt_documento_reembolso").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_reembolso")[0].files[0];

  crear_overlay_reembolso_cliente_asistencia_medica();

  var datos = new FormData();

  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);
  datos.append("listaDatosReembolso", listaDatosReembolso);
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_reembolso_asistencia_medica_individual_registro.php",
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
          "Datos correctamente, Nuevo Reembolso Registrado",
          "success"
        ).then((value) => {
          $("#modalAgregarReembolso").modal("hide");
          table_listar_reembolsos_asistencia_medica_individual.ajax.reload();
        });
      } else {
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
      }
      eliminar_overlay_reembolso_cliente_asistencia_medica();
    },
  });
}
