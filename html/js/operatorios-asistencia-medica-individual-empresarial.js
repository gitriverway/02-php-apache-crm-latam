$(document).on("hidden.bs.modal", function (event) {
  if ($(".modal:visible").length) {
    $("body").addClass("modal-open");
  }
});
//  function lista1(){

//     $.ajax({

//         url:"controller/operatorios-clientes-empresariales/controlador_operatorio_asistencia_medica_individual_listar.php",
//         method: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(respuesta){

//             console.log(respuesta);

//         }
//     });
//  }

if (window.matchMedia("(max-width:767px)").matches) {
  $("#tabla-listar-operatorios-asistencia-medica-individual").removeClass(
    "nowrap"
  );
  $("#tabla-listar-operatorios-asistencia-medica-individual").addClass(
    "dt-responsive"
  );
} else {
  $("#tabla-listar-operatorios-asistencia-medica-individual").removeClass(
    "dt-responsive"
  );
  $("#tabla-listar-operatorios-asistencia-medica-individual").addClass(
    "nowrap"
  );
}

var table_listar_operatorios_asistencia_medica_individual;
function listar_operatorios_asistencia_medica_individual() {
  table_listar_operatorios_asistencia_medica_individual = $(
    "#tabla-listar-operatorios-asistencia-medica-individual"
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
        targets: [0, 1, 2, 5, 6, 7, 8, 10, 11, 12, 13, 14, 15, 16, 17],
      },
    ],
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
    ajax: "controller/operatorios-clientes-empresariales/controlador_operatorio_asistencia_medica_individual_listar.php",
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
 ABRIR MODAL OBSERVACIONES OPERATORIO
 *********************************/
var numObservacion = 0;
$("#tabla-listar-operatorios-asistencia-medica-individual").on(
  "click",
  ".btnVerObservaciones",
  function () {
    $("#modalObservaciones").modal({ backdrop: "static", keyboard: false });
    $("#modalObservaciones").modal("show");

    numObservacion = 0;

    $("#todoObservaciones").empty();

    var idOperatorio = $(this).attr("idOperatorio");

    var paciente = $(this).attr("paciente");

    $("#observacionesPaciente").text(paciente);

    var datos = new FormData();

    datos.append("idOperatorio", idOperatorio);

    $.ajax({
      url: "controller/operatorios-clientes-empresariales/controlador_observacion_operatorio_adicionales_listar.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        var data = JSON.parse(respuesta);

        if (data.length > 0) {
          $("#listaObservaciones").val(
            data[0]["operatorio_observacion_descripcion"]
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

$("#tabla-listar-operatorios-asistencia-medica-individual").on(
  "click",
  ".btnVerDocumento",
  function () {
    var documentoRuta = $(this).attr("ruta");
    window.open(documentoRuta, "Documento", "width=1024,height=1024");
  }
);

$("#tabla-listar-operatorios-asistencia-medica-individual").on(
  "click",
  ".btnVerDocumentoAdicional",
  function () {
    var documentoRuta = $(this).attr("ruta");
    window.open(documentoRuta, "Documento Adicional", "width=1024,height=1024");
  }
);

$("#tabla-listar-operatorios-asistencia-medica-individual").on(
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

$("#tabla-listar-operatorios-asistencia-medica-individual").on(
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
    LISTAR VALIDAR DATOS OPERATORIO
  =============================================*/

function listarValidaDatosOperatorio() {
  var listaValidarDatosOperatorio = [];

  var etiquetas = $(".etiquetaRadioValidar");

  for (var i = 1; i <= etiquetas.length; i++) {
    var documento = $("#etiquetaRadioValidar" + i).val();
    var radio = $("input:radio[name=radio_" + i + "]:checked").val();

    listaValidarDatosOperatorio.push({
      documento: documento,
      estado: radio,
    });
  }

  $("#listaValidarDatosOperatorio").val(
    JSON.stringify(listaValidarDatosOperatorio)
  );
}

/*=============================================
    LISTAR OBSERVACIONES VALIDAR DATOS OPERATORIO
  =============================================*/

function listarObservacionesValidarDatosOperatorio() {
  var listaObservacionesDatosOperatorio = [];

  var observaciones = $("#txt_observaciones_operatorio").val().toUpperCase();

  listaObservacionesDatosOperatorio.push({
    fecha_registro: fecha_actual(),
    observaciones: observaciones,
  });

  $("#listaObservacionesDatosOperatorio").val(
    JSON.stringify(listaObservacionesDatosOperatorio)
  );

  const reg = /\\n/g;
  var str = $("#listaObservacionesDatosOperatorio").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesDatosOperatorio").val(newStr);
}
/*=============================================
  ACTUALIZAR LISTADO DATOS OPERATORIO
  =============================================*/

/*=============================================
  CAMBIOS EN RADIO VALIDAR
  =============================================*/
$(".validarDatosOperatorio").on(
  "change",
  "input.radio_validacion",
  function () {
    listarValidaDatosOperatorio();
  }
);

/*=============================================
  CAMBIOS EN FECHA DE SEGUIMIENTO
  =============================================*/
$(".validarDatosOperatorio").on(
  "change",
  "input.fecha_seguimiento_validar",
  function () {
    listarValidaDatosOperatorio();
  }
);

/*=============================================
  CAMBIOS EN OBSERVACIONES
  =============================================*/
$(".validarDatosOperatorio").on(
  "keyup",
  "textarea.observaciones_operatorio",
  function () {
    listarValidaDatosOperatorio();
  }
);

/*********************************
 ABRI MODAL VALIDAR OPERATORIO
 *********************************/
$("#tabla-listar-operatorios-asistencia-medica-individual").on(
  "click",
  ".btnValidarDocumentosOperatorio",
  function () {
    var idOperatorio = $(this).attr("idOperatorio");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#txt_idOperatorio").val(idOperatorio);
    $("#txt_idContrato").val(idContrato);
    $("#modificarOperatorioPaciente").text(paciente);

    $("#modalModificarOperatorio").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalModificarOperatorio").modal("show");
    Limpiar_Validar_Operatorio();
    listarValidaDatosOperatorio();
  }
);

function Limpiar_Validar_Operatorio() {
  $("#radio_solicitud_2").prop("checked", true);
  $("#radio_resultado_examenes_2").prop("checked", true);
  $("#radio_historia_clinica_2").prop("checked", true);
  $("#txt_fecha_seguimiento_validar").val("");
  $("#txt_observaciones_operatorio").val("");
  $("#listaObservacionesDatosOperatorio").val("");
}

function crear_overlay_validar_operatorio_asistencia_medica() {
  $("#modalValidarDocumentosOperatorio").append(
    '<div class="overlay dark" id="overlayValidarDocumentoOperatorio"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_validar_operatorio_asistencia_medica() {
  $("#overlayValidarDocumentoOperatorio").remove();
}

/*********************************
   MODIFICAR VALIDAR OPERATORIO
   *********************************/
function Modificar_Validar_Operatorio() {
  listarObservacionesValidarDatosOperatorio();

  var idOperatorio = $("#txt_idOperatorio").val();
  var idContrato = $("#txt_idContrato").val();
  var listaValidarDatosOperatorio = $("#listaValidarDatosOperatorio").val();
  var fecha_seguimiento_validar = $("#txt_fecha_seguimiento_validar").val();
  var listaObservacionesDatosOperatorio = $(
    "#listaObservacionesDatosOperatorio"
  ).val();

  var cont = 0;
  var cont1 = 0;

  if (listaValidarDatosOperatorio.length > 0) {
    var data = JSON.parse(listaValidarDatosOperatorio);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var estado = data[i]["estado"];
        if (estado == "NO") {
          cont++;
        }
      }
    }
  }
  if (listaObservacionesDatosOperatorio.length > 0) {
    var data1 = JSON.parse(listaObservacionesDatosOperatorio);
    if (data1.length > 0) {
      for (var i = 0; i < data1.length; i++) {
        var observacion = data1[i]["observaciones"];

        if (observacion.length > 0) {
          cont1++;
        }
      }
    }
  }

  if (listaValidarDatosOperatorio.length == 0) {
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

  crear_overlay_validar_operatorio_asistencia_medica();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);
  datos.append("idContrato", idContrato);
  datos.append("listaValidarDatosOperatorio", listaValidarDatosOperatorio);
  datos.append("fecha_seguimiento_validar", fecha_seguimiento_validar);
  datos.append(
    "listaObservacionesDatosOperatorio",
    listaObservacionesDatosOperatorio
  );
  datos.append("contar_validar", cont);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_operatorio_asistencia_medica_individual_validar_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Validar Operatorio Modificado Exitosamente",
          "success"
        ).then((value) => {
          $("#modalModificarOperatorio").modal("hide");
          table_listar_operatorios_asistencia_medica_individual.ajax.reload();
        });
      }
      eliminar_overlay_validar_operatorio_asistencia_medica();
    },
  });
}

/*********************************
 ABRIR MODAL OBSERVACIONES ADICIONALES SEGUIMIENTO OPERATORIO
 *********************************/
$("#tabla-listar-operatorios-asistencia-medica-individual").on(
  "click",
  ".btnAgregarObservacionesAdicionales",
  function () {
    var idOperatorio = $(this).attr("idOperatorio");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarObservacionAdicionalOperatorioPaciente").text(paciente);
    $("#txt_idOperatorio").val(idOperatorio);
    $("#txt_idContrato").val(idContrato);

    $("#modalAgregarObservacionAdicionalOperatorio").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarObservacionAdicionalOperatorio").modal("show");

    $("#txt_fecha_seguimiento_observacion_adicional").val("");
    $("#txt_observaciones_adicionales_seguimiento_operatorio").val("");

    Cargar_Observaciones_Adicionales_Seguimientos_Operatorios();
  }
);

function Cargar_Observaciones_Adicionales_Seguimientos_Operatorios() {
  var idOperatorio = $("#txt_idOperatorio").val();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_observacion_operatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesAdicionalesSeguimientosOperatorioAnterior").val(
          data[0]["operatorio_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesAdicionalesSeguimientosOperatorioAnterior").val(
          ""
        );
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES SEGUIMIENTOS PEDIDO OPERATORIO
    =============================================*/

function listarObservacionesAdicionalesSeguimientoOperatorio() {
  if (
    $("#txt_observaciones_adicionales_seguimiento_operatorio").val().length > 0
  ) {
    var listaObservacionesAdicionalesSeguimientosOperatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesAdicionalesSeguimientosOperatorioAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesAdicionalesSeguimientosOperatorioAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesAdicionalesSeguimientosOperatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $(
      "#txt_observaciones_adicionales_seguimiento_operatorio"
    )
      .val()
      .toUpperCase();

    listaObservacionesAdicionalesSeguimientosOperatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesAdicionalesSeguimientosOperatorio").val(
      JSON.stringify(listaObservacionesAdicionalesSeguimientosOperatorio)
    );
  } else {
    $("#listaObservacionesAdicionalesSeguimientosOperatorio").val(
      $("#listaObservacionesAdicionalesSeguimientosOperatorioAnterior").val()
    );
  }

  const reg = /\\n/g;
  var str = $("#listaObservacionesAdicionalesSeguimientosOperatorio").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesAdicionalesSeguimientosOperatorio").val(newStr);
}

function Modificar_Observaciones_adicionales_Seguimiento_Operatorio() {
  listarObservacionesAdicionalesSeguimientoOperatorio();

  var idOperatorio = $("#txt_idOperatorio").val();
  var idContrato = $("#txt_idContrato").val();
  var fecha_seguimiento = $(
    "#txt_fecha_seguimiento_observacion_adicional"
  ).val();
  var observacion = $(
    "#txt_observaciones_adicionales_seguimiento_operatorio"
  ).val();
  var lista_observaciones_adicionales = $(
    "#listaObservacionesAdicionalesSeguimientosOperatorio"
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

  datos.append("idOperatorio", idOperatorio);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "lista_observaciones_adicionales",
    lista_observaciones_adicionales
  );

  $.ajax({
    url: "controller/operatorios-observaciones-empresariales/controlador_operatorio_asistencia_medica_individual_observaciones_adicionales_modificar.php",
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
          $("#modalAgregarObservacionAdicionalOperatorio").modal("hide");
          table_listar_operatorios_asistencia_medica_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRAR SOLICTAR DOCUMENTOS FALTANTES SEGUIMIENTO
 *********************************/
$("#tabla-listar-operatorios-asistencia-medica-individual").on(
  "click",
  ".btnSeguimientoOperatorioAseguradora",
  function () {
    $("#modalAgregarSeguimientoOperatorio").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarSeguimientoOperatorio").modal("show");
    var idOperatorio = $(this).attr("idOperatorio");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarSeguimientoOperatorioPaciente").text(paciente);
    $("#txt_idOperatorio").val(idOperatorio);
    $("#txt_idContrato").val(idContrato);

    $("#enviarEmail").prop("checked", true);

    $("#txt_fecha_seguimiento").val("");
    $("#listaDocumentosSolicitadosAseguradora").val("");
    $(".seguimientoDatosOperatorio").empty();
    Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos();
    Cargar_Observaciones_Seguimientos();
    listarObservacionesSeguimientoOperatorio();
  }
);

function Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos() {
  var idOperatorio = $("#txt_idOperatorio").val();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_documentos_adicionales_solictados_aseguradora_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaDocumentosSolicitadosAseguradoraAnterior").val(
          data[0]["operatorio_documentos_seguimiento"]
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

      $(".seguimientoDatosOperatorio").append(
        '<div class="col-12 my-1">' +
          '<div class="row gridSeguimientoOperatorio">' +
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
  var idOperatorio = $("#txt_idOperatorio").val();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_observacion_operatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesSeguimientosOperatorioAnterior").val(
          data[0]["operatorio_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesSeguimientosOperatorioAnterior").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES SEGUIMIENTOS OPERATORIO
    =============================================*/

function listarObservacionesSeguimientoOperatorio() {
  if ($("#txt_observaciones_seguimiento_operatorio").val().length > 0) {
    var listaObservacionesSeguimientosOperatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesSeguimientosOperatorioAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesSeguimientosOperatorioAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesSeguimientosOperatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_seguimiento_operatorio")
      .val()
      .toUpperCase();

    listaObservacionesSeguimientosOperatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesSeguimientosOperatorio").val(
      JSON.stringify(listaObservacionesSeguimientosOperatorio)
    );
  } else {
    $("#listaObservacionesSeguimientosOperatorio").val(
      $("#listaObservacionesSeguimientosOperatorioAnterior").val()
    );
  }
  const reg = /\\n/g;
  var str = $("#listaObservacionesSeguimientosOperatorio").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesSeguimientosOperatorio").val(newStr);
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

  $(".seguimientoDatosOperatorio").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridSeguimientoOperatorio">' +
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

$(".seguimientoDatosOperatorio").on(
  "keyup",
  "input.documentoRequerido",
  function () {
    listarDocumentosAseguradora();
  }
);
/*=============================================
    CAMBIOS EN RADIO SEGUIMIENTO
    =============================================*/
$(".seguimientoDatosOperatorio").on(
  "change",
  "input.radio_seguimiento_si",
  function () {
    listarDocumentosAseguradora();
  }
);
$(".seguimientoDatosOperatorio").on(
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
$("#txt_observaciones_seguimiento_operatorio").keyup(function () {
  listarDocumentosAseguradora();
});

/*=============================================
    QUITAR DOCUMENTOS SOLICITADOS POR ASEGURADORA
    =============================================*/

var idQuitarDocumento = [];

localStorage.removeItem("quitarDocumento");

$(".seguimientoDatosOperatorio").on(
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

    if ($(".seguimientoDatosOperatorio").children().length == 0) {
      $("#listaDocumentosSolicitadosAseguradora").val("");
    } else {
      // AGRUPAR FAMILIARES EN FORMATO JSON
      listarDocumentosAseguradora();
    }
  }
);

function crear_overlay_seguimiento_operatorio_asistencia_medica() {
  $("#modalSeguimientoOperatorio").append(
    '<div class="overlay dark" id="overlaySeguimientoOperatorioAsistenciaMedica"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_seguimiento_operatorio_asistencia_medica() {
  $("#overlaySeguimientoOperatorioAsistenciaMedica").remove();
}

function Modificar_Seguimiento_Operatorio() {
  listarObservacionesSeguimientoOperatorio();

  var idOperatorio = $("#txt_idOperatorio").val();
  var idContrato = $("#txt_idContrato").val();
  var listaDocumentosSolicitadosAseguradora = $(
    "#listaDocumentosSolicitadosAseguradora"
  ).val();
  var enviar_mail = "";
  var fecha_seguimiento = $("#txt_fecha_seguimiento").val();
  var observaciones = $("#txt_observaciones_seguimiento_operatorio").val();
  var listaObservacionesSeguimientosOperatorio = $(
    "#listaObservacionesSeguimientosOperatorio"
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

  if (listaObservacionesSeguimientosOperatorio.length > 0) {
    var data1 = JSON.parse(listaObservacionesSeguimientosOperatorio);
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
    "#txt_documento_operatorio_documento_pedido_aseguradora"
  ).val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_operatorio_documento_pedido_aseguradora")[0]
    .files[0];

  crear_overlay_seguimiento_operatorio_asistencia_medica();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);
  datos.append("idContrato", idContrato);
  datos.append(
    "listaDocumentosSolicitadosAseguradora",
    listaDocumentosSolicitadosAseguradora
  );
  datos.append("enviar_mail", enviar_mail);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesSeguimientosOperatorio",
    listaObservacionesSeguimientosOperatorio
  );
  datos.append("estado_caducado", estado_caducado);
  datos.append("documento", documento);
  datos.append("extension", extension);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_operatorio_asistencia_medica_individual_seguimiento_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Seguimiento Operatorio Modificado Exitosamente",
          "success"
        ).then((value) => {
          eliminar_overlay_seguimiento_operatorio_asistencia_medica();
          $("#modalAgregarSeguimientoOperatorio").modal("hide");
          table_listar_operatorios_asistencia_medica_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRAR DOCUMENTO ADICIONAL
 *********************************/
$("#tabla-listar-operatorios-asistencia-medica-individual").on(
  "click",
  ".btnAgregarDocumentoSeguimiento",
  function () {
    $("#modalAgregarDocumentoSeguimientoOperatorio").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarDocumentoSeguimientoOperatorio").modal("show");
    var idOperatorio = $(this).attr("idOperatorio");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarDocumentoOperatorioPaciente").text(paciente);
    $("#txt_idOperatorio").val(idOperatorio);
    $("#txt_idContrato").val(idContrato);
    $("#txt_fecha_documento_seguimiento_aseguradora").val("");
    $("#txt_observaciones_documento_seguimiento_operatorio").val("");
    $("#txt_documento_operatorio_documento_seguimiento").val("");
    Cargar_Observaciones_Documentos_Seguimientos();
  }
);

/*=============================================
    CARGAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS PEDIDO OPERATORIO
  =============================================*/

function Cargar_Observaciones_Documentos_Seguimientos() {
  var idOperatorio = $("#txt_idOperatorio").val();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_observacion_operatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesDocumentoSeguimientosOperatorioAnterior").val(
          data[0]["operatorio_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesDocumentoSeguimientosOperatorioAnterior").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS PEDIDO OPERATORIO
    =============================================*/

function listarObservacionesDocumentosSeguimientoOperatorio() {
  if (
    $("#txt_observaciones_documento_seguimiento_operatorio").val().length > 0
  ) {
    var listaObservacionesDocumentoSeguimientosOperatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesDocumentoSeguimientosOperatorioAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesDocumentoSeguimientosOperatorioAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesDocumentoSeguimientosOperatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_documento_seguimiento_operatorio")
      .val()
      .toUpperCase();

    listaObservacionesDocumentoSeguimientosOperatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesDocumentoSeguimientosOperatorio").val(
      JSON.stringify(listaObservacionesDocumentoSeguimientosOperatorio)
    );
  } else {
    $("#listaObservacionesDocumentoSeguimientosOperatorio").val(
      $("#listaObservacionesDocumentoSeguimientosOperatorioAnterior").val()
    );
  }

  const reg = /\\n/g;
  var str = $("#listaObservacionesDocumentoSeguimientosOperatorio").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesDocumentoSeguimientosOperatorio").val(newStr);
}

function crear_overlay_documento_seguimiento_operatorio_asistencia_medica() {
  $("#modalDocumentoSeguimientoOperatorio").append(
    '<div class="overlay dark" id="overlayDocumentoSeguimientoAsistenciaMedica"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_documento_seguimiento_operatorio_asistencia_medica() {
  $("#overlayDocumentoSeguimientoAsistenciaMedica").remove();
}

/*****************************************************
   REGISTRAR UN NUEVO DOCUMENTO SEGUIMIENTO PEDIDO OPERATORIO
   ***************************************************/
function Registrar_Documento_Seguimiento_Operatorio() {
  listarObservacionesDocumentosSeguimientoOperatorio();

  var idOperatorio = $("#txt_idOperatorio").val().toUpperCase();
  var idContrato = $("#txt_idContrato").val().toUpperCase();
  var fecha_seguimiento = $(
    "#txt_fecha_documento_seguimiento_aseguradora"
  ).val();
  var observaciones = $(
    "#txt_observaciones_documento_seguimiento_operatorio"
  ).val();
  var listaObservacionesDocumentoSeguimientosOperatorio = $(
    "#listaObservacionesDocumentoSeguimientosOperatorio"
  ).val();

  var documento;

  var cont1 = 0;

  if (listaObservacionesDocumentoSeguimientosOperatorio.length > 0) {
    var data1 = JSON.parse(listaObservacionesDocumentoSeguimientosOperatorio);
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

  if ($("#txt_documento_operatorio_documento_seguimiento").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $("#txt_documento_operatorio_documento_seguimiento").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_operatorio_documento_seguimiento")[0].files[0];

  crear_overlay_documento_seguimiento_operatorio_asistencia_medica();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesDocumentoSeguimientosOperatorio",
    listaObservacionesDocumentoSeguimientosOperatorio
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_operatorio_asistencia_medica_individual_documento_seguimiento_registro.php",
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
          eliminar_overlay_documento_seguimiento_operatorio_asistencia_medica();
          $("#modalAgregarDocumentoSeguimientoOperatorio").modal("hide");
          table_listar_operatorios_asistencia_medica_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_documento_seguimiento_operatorio_asistencia_medica();
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
$("#tabla-listar-operatorios-asistencia-medica-individual").on(
  "click",
  ".btnAgregarAutorizacion",
  function () {
    $("#modalAgregarDocumentoAutorizacionOperatorio").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarDocumentoAutorizacionOperatorio").modal("show");
    var idOperatorio = $(this).attr("idOperatorio");
    var idContrato = $(this).attr("idContrato");
    var idBayer = $(this).attr("idBayer");
    var paciente = $(this).attr("paciente");

    $("#agregarDocumentoAutorizacionOperatorioPaciente").text(paciente);
    $("#txt_idOperatorio").val(idOperatorio);
    $("#txt_idContrato").val(idContrato);
    $("#txt_idBayer").val(idBayer);

    LimpiarRegistroDocumentoAutorizacion();
    cargar_datos_dependiente_operatorio();
    Cargar_Observaciones_Autorizacion_Seguimientos();
  }
);

function LimpiarRegistroDocumentoAutorizacion() {
  $("#txt_observaciones_autorizacion_operatorio").val("");
  $("#txt_documento_operatorio_documento_autorizacion").val("");
}

function cargar_datos_dependiente_operatorio() {
  var idOperatorio = $("#txt_idOperatorio").val();
  var idContrato = $("#txt_idContrato").val();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);
  datos.append("idContrato", idContrato);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_traer_operatorio_asistencia_medica_individual.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        for (let i = 0; i < data.length; i++) {
          var lista_operatorio = JSON.parse(data[i]["operatorio_descripcion"]);
          var paciente = lista_operatorio[0]["nombre_paciente"];
          $("#txt_paciente_operatorio").val(paciente);
        }
      }
    },
  });
}

/*=============================================
    CARGAR OBSERVACIONES AUTORIZACION PEDIDO OPERATORIO
  =============================================*/

function Cargar_Observaciones_Autorizacion_Seguimientos() {
  var idOperatorio = $("#txt_idOperatorio").val();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_observacion_operatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesLiquidacionOperatorioAnterior").val(
          data[0]["operatorio_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesLiquidacionOperatorioAnterior").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS PEDIDO OPERATORIO
    =============================================*/

function listarObservacionesAutorizacionOperatorio() {
  if ($("#txt_observaciones_autorizacion_operatorio").val().length > 0) {
    var listaObservacionesAutorizacionOperatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesAutorizacionOperatorioAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesAutorizacionOperatorioAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesAutorizacionOperatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_autorizacion_operatorio")
      .val()
      .trim()
      .toUpperCase();

    listaObservacionesAutorizacionOperatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesAutorizacionOperatorio").val(
      JSON.stringify(listaObservacionesAutorizacionOperatorio)
    );
  } else {
    $("#listaObservacionesAutorizacionOperatorio").val(
      $("#listaObservacionesAutorizacionOperatorioAnterior").val()
    );
  }

  const reg = /\\n/g;
  var str = $("#listaObservacionesAutorizacionOperatorio").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesAutorizacionOperatorio").val(newStr);
}

function crear_overlay_documento_autorizacion_operatorio_asistencia_medica() {
  $("#modalDocumentoAutorizacionOperatorio").append(
    '<div class="overlay dark" id="overlayDocumentoAutorizacionOperatorioAsistenciaMedica"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_documento_autorizacion_operatorio_asistencia_medica() {
  $("#overlayDocumentoAutorizacionOPeratorioAsistenciaMedica").remove();
}

/*********************************
   REGISTRAR AUTORIZACION PEDIDO OPERATORIO
   *********************************/
function Registrar_Documento_Autorizacion_Operatorio() {
  listarObservacionesAutorizacionOperatorio();

  var idOperatorio = $("#txt_idOperatorio").val();
  var idContrato = $("#txt_idContrato").val();
  var listaObservacionesAutorizacionOperatorio = $(
    "#listaObservacionesAutorizacionOperatorio"
  ).val();

  var documento;

  if ($("#txt_observaciones_autorizacion_operatorio").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingrese una observación para cargar la autorización del pedido operatorio",
      "warning"
    );
  }

  if ($("#txt_documento_operatorio_documento_autorizacion").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $("#txt_documento_operatorio_documento_autorizacion").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_operatorio_documento_autorizacion")[0].files[0];

  crear_overlay_documento_autorizacion_operatorio_asistencia_medica();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);
  datos.append("idContrato", idContrato);
  datos.append(
    "listaObservacionesAutorizacionOperatorio",
    listaObservacionesAutorizacionOperatorio
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_operatorio_asistencia_medica_individual_documento_autorizacion_registro.php",
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
          eliminar_overlay_documento_autorizacion_operatorio_asistencia_medica();
          $("#modalAgregarDocumentoAutorizacionOperatorio").modal("hide");
          table_listar_operatorios_asistencia_medica_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_documento_autorizacion_operatorio_asistencia_medica();
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
 ABRIR MODAL OBSERVACIONES ANULACION SEGUIMIENTO OPERATORIO
 *********************************/
$("#tabla-listar-operatorios-asistencia-medica-individual").on(
  "click",
  ".btnAgregarAnulacion",
  function () {
    var idOperatorio = $(this).attr("idOperatorio");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarObservacionAnulacionOperatorioPaciente").val(paciente);
    $("#txt_idOperatorio").val(idOperatorio);
    $("#txt_idContrato").val(idContrato);

    $("#modalAgregarObservacionAnulacionOperatorio").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarObservacionAnulacionOperatorio").modal("show");

    Cargar_Observaciones_Anulacion_Seguimientos_Operatorios();
  }
);

function Cargar_Observaciones_Anulacion_Seguimientos_Operatorios() {
  var idOperatorio = $("#txt_idOperatorio").val();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_observacion_operatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesAnulacionOperatorioAnterior").val(
          data[0]["operatorio_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesAnulacionOperatorioAnterior").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES SEGUIMIENTOS PEDIDO OPERATORIO
    =============================================*/

function listarObservacionesAnulacionOperatorio() {
  if ($("#txt_observaciones_anulacion_operatorio").val().length > 0) {
    var listaObservacionesAnulacionOperatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesAnulacionOperatorioAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesAnulacionOperatorioAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesAnulacionOperatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_anulacion_operatorio")
      .val()
      .toUpperCase();

    listaObservacionesAnulacionOperatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesAnulacionOperatorio").val(
      JSON.stringify(listaObservacionesAnulacionOperatorio)
    );
  } else {
    $("#listaObservacionesAnulacionOperatorio").val(
      $("#listaObservacionesAnulacionOperatorioAnterior").val()
    );
  }

  const reg = /\\n/g;
  var str = $("#listaObservacionesAnulacionOperatorio").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesAnulacionOperatorio").val(newStr);
}

function Modificar_Observaciones_Anulacion_Operatorio() {
  listarObservacionesAnulacionOperatorio();

  var idOperatorio = $("#txt_idOperatorio").val();
  var idContrato = $("#txt_idContrato").val();
  var observacion = $("#txt_observaciones_anulacion_operatorio").val();
  var lista_observaciones_anulacion = $(
    "#listaObservacionesAnulacionOperatorio"
  ).val();

  if (observacion.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar una observaci&oacute;n",
      "warning"
    );
  }

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);
  datos.append("idContrato", idContrato);
  datos.append("lista_observaciones_anulacion", lista_observaciones_anulacion);

  $.ajax({
    url: "controller/operatorios-observaciones-empresariales/controlador_operatorio_asistencia_medica_individual_observaciones_anulacion_modificar.php",
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
          $("#modalAgregarObservacionAnulacionOperatorio").modal("hide");
          table_listar_operatorios_asistencia_medica_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRO DE OPERATORIO
 *********************************/
function AbrirModalRegistro() {
  $("#modalAgregarOperatorio").modal({ backdrop: "static", keyboard: false });
  $("#modalAgregarOperatorio").modal("show");
  LimpiarRegistro();
}

function LimpiarRegistro() {
  $("#txt_idBayer").val("");
  $("#txt_contrato_aplicar").val("");
  $("#cbm_nombre_colaborador").empty();
  $("#cbm_nombre_colaborador").append(
    "<option value=''>SIN REGISTROS</option>"
  );
  $("#cbm_nombre_paciente").empty();
  $("#cbm_nombre_paciente").append("<option value=''>SIN REGISTROS</option>");
  $("#txt_fecha_operacion").val("");
  $("#txt_lugar_hospitalario_operatorio").val("");
  // $("#txt_valor_presentado_operatorio").val("");
  $("#txt_diagnostico_operatorio").val("");
  $("#txt_documento_operatorio").val("");
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
  fecha = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();

  var fecha_actual = $("#txt_fecha_operacion").val();

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
      "controller/contratos-clientes-empresariales/controlador_contrato_cliente_asistencia_medica_individual_listar_todos.php?fecha=" +
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
    url: "controller/bayer-persona-empresarial/controlador_combo_dependientes_listar.php",
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
            $("#lista_colaboradores").val(JSON.stringify(data));
          }
        } else {
          cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
      } else {
        cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
      }
      $(".cbm_nombre_colaborador").html(cadena);
    },
  });
}

$(".nuevoDatosOperatorio").on(
  "change",
  "select.cbm_nombre_colaborador",
  function () {
    cargar_lista_pacientes();
  }
);

function cargar_lista_pacientes() {
  var colaborador = $("#cbm_nombre_colaborador").val();
  var lista = $("#lista_colaboradores").val();

  if (lista != "") {
    var data = JSON.parse(lista);
    var data1 = "";
    var cadena = "";

    if (data.length > 0) {
      cadena += "<option value=''>Seleccione..</option>";
      for (var i = 0; i < data.length; i++) {
        if (data[i]["nombre"] == colaborador) {
          cadena +=
            "<option  value='" +
            data[i]["nombre"] +
            "'>" +
            data[i]["nombre"] +
            "</option>";
          data1 = data[i]["lista_dependientes"];
          if (data1 != "") {
            for (var j = 0; j < data1.length; j++) {
              cadena +=
                "<option  value='" +
                data1[j]["nombre"] +
                "'>" +
                data1[j]["nombre"] +
                "</option>";
            }
          }
        }
      }
    } else {
      cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
    }
  } else {
    cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
  }
  $(".cbm_nombre_paciente").html(cadena);
}

$("#txt_documento_operatorio").change(function () {
  var documento = this.files[0];

  // Tamaño correcto en bytes (25MB reales)
  var maxSizeMB = 25;
  var maxSizeBytes = maxSizeMB * 1024 * 1024;
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  if (documento["type"] != "application/pdf") {
    $("#txt_documento_operatorio").val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir el documento",
      text: "¡El documento debe estar en formato PDF!",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (documento["size"] > maxSizeBytes) {
    $("#txt_documento_operatorio").val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir el documento",
      text: "¡El documento no debe pesar más de " + maxSizeMB + "MB!",
      confirmButtonText: "¡Cerrar!",
    });
  }
});

function listarDatosOperatorio() {
  var listaDatosOperatorio = [];

  var nombre_colaborador = $(".cbm_nombre_colaborador");
  var nombre_paciente = $(".cbm_nombre_paciente");
  var fecha_atencion = $(".fecha_operacion");
  var lugar_hospitalario = $(".lugar_hospitalario");
  // var valor_presentado = $(".valor_presentado");
  var diagnostico = $(".diagnostico_operatorio");
  var lugar_procedimiento = $(".lugar_procedimiento_operatorio");
  var fecha_procedimiento_operatorio = $(".fecha_procedimiento_operatorio");

  for (var i = 0; i < nombre_paciente.length; i++) {
    listaDatosOperatorio.push({
      nombre_colaborador: $(nombre_colaborador[i]).val().toUpperCase(),
      nombre_paciente: $(nombre_paciente[i]).val().toUpperCase(),
      fecha_atencion: $(fecha_atencion[i]).val(),
      valor_presentado: 0,
      lugar_hospitalario: $(lugar_hospitalario[i]).val(),
      diagnostico: $(diagnostico[i]).val().toUpperCase(),
      lugar_procedimiento: $(lugar_procedimiento[i]).val().toUpperCase(),
      fecha_procedimiento_operatorio: $(
        fecha_procedimiento_operatorio[i]
      ).val(),
    });
  }

  $("#listaDatosOperatorio").val(JSON.stringify(listaDatosOperatorio));
  const reg = /\\n/g;
  var str = $("#listaDatosOperatorio").val();
  const newStr = str.replace(reg, " ");
  $("#listaDatosOperatorio").val(newStr);
}

function crear_overlay_operatorio_cliente_asistencia_medica() {
  $("#modalNuevoOperatorio").append(
    '<div class="overlay dark" id="overlayNuevoOperatorio"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}

function eliminar_overlay_operatorio_cliente_asistencia_medica() {
  $("#overlayNuevoOperatorio").remove();
}

/*********************************
   REGISTRAR UN NUEVO OPERATORIO
   *********************************/
function Registrar_Operatorio() {
  listarDatosOperatorio();

  var idBayer = $("#txt_idBayer").val().toUpperCase();
  var idContrato = $("#txt_idContrato").val().toUpperCase();
  var listaDatosOperatorio = $("#listaDatosOperatorio").val();
  var documento;

  var cont = 0;

  if (listaDatosOperatorio.length > 0) {
    var data = JSON.parse(listaDatosOperatorio);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var nombre_colaborador = data[i]["nombre_colaborador"];
        var nombre_paciente = data[i]["nombre_paciente"];
        var fecha_atencion = data[i]["fecha_atencion"];
        var valor_presentado = data[i]["valor_presentado"];
        var lugar_hospitalario = data[i]["lugar_hospitalario"];
        var diagnostico = data[i]["diagnostico"];
        var lugar_procedimiento = data[i]["lugar_procedimiento"];
        var fecha_procedimiento_operatorio =
          data[i]["fecha_procedimiento_operatorio"];

        if (
          nombre_colaborador.length == 0 ||
          nombre_paciente.length == 0 ||
          fecha_atencion.length == 0 ||
          valor_presentado.length == 0 ||
          lugar_hospitalario.length == 0 ||
          diagnostico.length == 0 ||
          lugar_procedimiento.length == 0 ||
          fecha_procedimiento_operatorio.length == 0
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

  if (listaDatosOperatorio.length == 0 || cont > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios para la petición operatorio",
      "warning"
    );
  }

  if ($("#txt_documento_operatorio").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $("#txt_documento_operatorio").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_operatorio")[0].files[0];

  crear_overlay_operatorio_cliente_asistencia_medica();

  var datos = new FormData();

  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);
  datos.append("listaDatosOperatorio", listaDatosOperatorio);
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_operatorio_asistencia_medica_individual_registro.php",
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
          "Datos correctamente, Nueva Petición Operatorio Registrado",
          "success"
        ).then((value) => {
          eliminar_overlay_operatorio_cliente_asistencia_medica();
          $("#modalAgregarOperatorio").modal("hide");
          table_listar_operatorios_asistencia_medica_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_operatorio_cliente_asistencia_medica();
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
 ABRIR MODAL REGISTRAR SOLICTAR DOCUMENTOS FALTANTES SEGUIMIENTO
 *********************************/
$("#tabla-listar-operatorios-asistencia-medica-individual").on(
  "click",
  ".btnSeguimientoOperatorioAseguradora1",
  function () {
    $("#modalAgregarSeguimientoOperatorio1").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarSeguimientoOperatorio1").modal("show");

    var idOperatorio = $(this).attr("idOperatorio");
    var idContrato = $(this).attr("idContrato");
    var paciente = $(this).attr("paciente");

    $("#agregarSeguimientoOperatorioPaciente1").text(paciente);
    $("#txt_idOperatorio").val(idOperatorio);
    $("#txt_idContrato").val(idContrato);
    $("#enviarEmail1").prop("checked", true);

    $("#txt_fecha_seguimiento1").val("");
    $("#listaDocumentosSolicitadosAseguradora1").val("");
    $(".seguimientoDatosOperatorio1").empty();
    Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos_1();
    Cargar_Observaciones_Seguimientos_1();
    listarObservacionesSeguimientoOperatorio_1();
  }
);

function Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos_1() {
  var idOperatorio = $("#txt_idOperatorio").val();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_documentos_adicionales_solictados_aseguradora_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaDocumentosSolicitadosAseguradoraAnterior1").val(
          data[0]["operatorio_documentos_seguimiento_1"]
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

      $(".seguimientoDatosOperatorio1").append(
        '<div class="col-12 my-1">' +
          '<div class="row gridSeguimientoOperatorio1">' +
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
          '<button type="button" class="form-control btn btn-danger quitarDocumento idDocumento="' +
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

/*=============================================
    QUITAR DOCUMENTOS SOLICITADOS POR ASEGURADORA
    =============================================*/

var idQuitarDocumento1 = [];

localStorage.removeItem("quitarDocumento");

$(".seguimientoDatosOperatorio1").on(
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
      idQuitarDocumento1 = [];
    } else {
      idQuitarDocumento1.concat(localStorage.getItem("quitarDocumento"));
    }

    idQuitarDocumento1.push({
      idDocumento: idDocumento,
    });

    localStorage.setItem("quitarDocumento", JSON.stringify(idQuitarDocumento1));

    numDocumentosRequeridosAseguradora--;

    if ($(".seguimientoDatosOperatorio1").children().length == 0) {
      $("#listaDocumentosSolicitadosAseguradora1").val("");
    } else {
      // AGRUPAR FAMILIARES EN FORMATO JSON
      listarDocumentosAseguradora_1();
    }
  }
);

function Cargar_Observaciones_Seguimientos_1() {
  var idOperatorio = $("#txt_idOperatorio").val();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_observacion_operatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesSeguimientosOperatorioAnterior1").val(
          data[0]["operatorio_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesSeguimientosOperatorioAnterior1").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES SEGUIMIENTOS OPERATORIO
    =============================================*/

function listarObservacionesSeguimientoOperatorio_1() {
  if ($("#txt_observaciones_seguimiento_operatorio1").val().length > 0) {
    var listaObservacionesSeguimientosOperatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesSeguimientosOperatorioAnterior1"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesSeguimientosOperatorioAnterior1").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesSeguimientosOperatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_seguimiento_operatorio1")
      .val()
      .toUpperCase();

    listaObservacionesSeguimientosOperatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesSeguimientosOperatorio1").val(
      JSON.stringify(listaObservacionesSeguimientosOperatorio)
    );
  } else {
    $("#listaObservacionesSeguimientosOperatorio1").val(
      $("#listaObservacionesSeguimientosOperatorioAnterior1").val()
    );
  }
  const reg = /\\n/g;
  var str = $("#listaObservacionesSeguimientosOperatorio1").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesSeguimientosOperatorio1").val(newStr);
}

$(".btnAgregarDocumentoRequeridoAseguradora1").click(function () {
  var estado = "";

  if (numDocumentosRequeridosAseguradora > 0) {
    estado = "d-md-none";
  } else {
    estado = "";
  }

  $(".seguimientoDatosOperatorio1").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridSeguimientoOperatorio1">' +
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

  listarDocumentosAseguradora_1();
});

function listarObservacionesSeguimientoOperatorio_1() {
  if ($("#txt_observaciones_seguimiento_operatorio1").val().length > 0) {
    var listaObservacionesSeguimientosOperatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesSeguimientosOperatorioAnterior1"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesSeguimientosOperatorioAnterior1").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesSeguimientosOperatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_seguimiento_operatorio1")
      .val()
      .toUpperCase();

    listaObservacionesSeguimientosOperatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesSeguimientosOperatorio1").val(
      JSON.stringify(listaObservacionesSeguimientosOperatorio)
    );
  } else {
    $("#listaObservacionesSeguimientosOperatorio1").val(
      $("#listaObservacionesSeguimientosOperatorioAnterior1").val()
    );
  }
  const reg = /\\n/g;
  var str = $("#listaObservacionesSeguimientosOperatorio1").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesSeguimientosOperatorio1").val(newStr);
}

function crear_overlay_seguimiento_operatorio_asistencia_medica_1() {
  $("#modalSeguimientoOperatorio1").append(
    '<div class="overlay dark" id="overlaySeguimientoOperatorioAsistenciaMedica1"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_seguimiento_operatorio_asistencia_medica_1() {
  $("#overlaySeguimientoOperatorioAsistenciaMedica1").remove();
}

function Modificar_Seguimiento_Operatorio_1() {
  listarDocumentosAseguradora_1();
  listarObservacionesSeguimientoOperatorio_1();

  var idOperatorio = $("#txt_idOperatorio").val();
  var idContrato = $("#txt_idContrato").val();
  var listaDocumentosSolicitadosAseguradora = $(
    "#listaDocumentosSolicitadosAseguradora1"
  ).val();
  var enviar_mail = "";
  var fecha_seguimiento = $("#txt_fecha_seguimiento1").val();
  var observaciones = $("#txt_observaciones_seguimiento_operatorio1").val();
  var listaObservacionesSeguimientosOperatorio = $(
    "#listaObservacionesSeguimientosOperatorio1"
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

  if (listaObservacionesSeguimientosOperatorio.length > 0) {
    var data1 = JSON.parse(listaObservacionesSeguimientosOperatorio);
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
    "#txt_documento_operatorio_documento_pedido_aseguradora1"
  ).val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_operatorio_documento_pedido_aseguradora1")[0]
    .files[0];

  crear_overlay_seguimiento_operatorio_asistencia_medica_1();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);
  datos.append("idContrato", idContrato);
  datos.append(
    "listaDocumentosSolicitadosAseguradora",
    listaDocumentosSolicitadosAseguradora
  );
  datos.append("enviar_mail", enviar_mail);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesSeguimientosOperatorio",
    listaObservacionesSeguimientosOperatorio
  );
  datos.append("estado_caducado", estado_caducado);
  datos.append("documento", documento);
  datos.append("extension", extension);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_operatorio_asistencia_medica_individual_seguimiento_modificar_1.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Seguimiento Operatorio Modificado Exitosamente",
          "success"
        ).then((value) => {
          eliminar_overlay_seguimiento_operatorio_asistencia_medica_1();
          $("#modalAgregarSeguimientoOperatorio1").modal("hide");
          table_listar_operatorios_asistencia_medica_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRAR DOCUMENTO ADICIONAL
 *********************************/
$("#tabla-listar-operatorios-asistencia-medica-individual").on(
  "click",
  ".btnAgregarDocumentoSeguimiento1",
  function () {
    $("#modalAgregarDocumentoSeguimientoOperatorio1").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarDocumentoSeguimientoOperatorio1").modal("show");
    var idOperatorio = $(this).attr("idOperatorio");
    var idContrato = $(this).attr("idContrato");
    $("#txt_idOperatorio").val(idOperatorio);
    $("#txt_idContrato").val(idContrato);
    $("#txt_fecha_documento_seguimiento_aseguradora1").val("");
    $("#txt_observaciones_documento_seguimiento_operatorio1").val("");
    $("#txt_documento_operatorio_documento_seguimiento1").val("");
    Cargar_Observaciones_Documentos_Seguimientos_1();
  }
);

/*=============================================
    CARGAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS PEDIDO OPERATORIO
  =============================================*/

function Cargar_Observaciones_Documentos_Seguimientos_1() {
  var idOperatorio = $("#txt_idOperatorio").val();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_observacion_operatorio_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesDocumentoSeguimientosOperatorioAnterior1").val(
          data[0]["operatorio_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesDocumentoSeguimientosOperatorioAnterior1").val(
          ""
        );
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS PEDIDO OPERATORIO
    =============================================*/

function listarObservacionesDocumentosSeguimientoOperatorio_1() {
  if (
    $("#txt_observaciones_documento_seguimiento_operatorio1").val().length > 0
  ) {
    var listaObservacionesDocumentoSeguimientosOperatorio = [];
    var lista_observaciones = $(
      "#listaObservacionesDocumentoSeguimientosOperatorioAnterior1"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesDocumentoSeguimientosOperatorioAnterior1").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesDocumentoSeguimientosOperatorio.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $(
      "#txt_observaciones_documento_seguimiento_operatorio1"
    )
      .val()
      .toUpperCase();

    listaObservacionesDocumentoSeguimientosOperatorio.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesDocumentoSeguimientosOperatorio1").val(
      JSON.stringify(listaObservacionesDocumentoSeguimientosOperatorio)
    );
  } else {
    $("#listaObservacionesDocumentoSeguimientosOperatorio1").val(
      $("#listaObservacionesDocumentoSeguimientosOperatorioAnterior1").val()
    );
  }

  const reg = /\\n/g;
  var str = $("#listaObservacionesDocumentoSeguimientosOperatorio1").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesDocumentoSeguimientosOperatorio1").val(newStr);
}

function crear_overlay_documento_seguimiento_operatorio_asistencia_medica_1() {
  $("#modalDocumentoSeguimientoOperatorio1").append(
    '<div class="overlay dark" id="overlayDocumentoSeguimientoAsistenciaMedica1"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_documento_seguimiento_operatorio_asistencia_medica_1() {
  $("#overlayDocumentoSeguimientoAsistenciaMedica1").remove();
}

/*****************************************************
   REGISTRAR UN NUEVO DOCUMENTO SEGUIMIENTO PEDIDO OPERATORIO 1
   ***************************************************/
function Registrar_Documento_Seguimiento_Operatorio_1() {
  listarObservacionesDocumentosSeguimientoOperatorio_1();

  var idOperatorio = $("#txt_idOperatorio").val().toUpperCase();
  var idContrato = $("#txt_idContrato").val().toUpperCase();
  var fecha_seguimiento = $(
    "#txt_fecha_documento_seguimiento_aseguradora1"
  ).val();
  var observaciones = $(
    "#txt_observaciones_documento_seguimiento_operatorio1"
  ).val();
  var listaObservacionesDocumentoSeguimientosOperatorio = $(
    "#listaObservacionesDocumentoSeguimientosOperatorio1"
  ).val();

  var documento;

  var cont1 = 0;

  if (listaObservacionesDocumentoSeguimientosOperatorio.length > 0) {
    var data1 = JSON.parse(listaObservacionesDocumentoSeguimientosOperatorio);
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

  if ($("#txt_documento_operatorio_documento_seguimiento1").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $("#txt_documento_operatorio_documento_seguimiento1").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_operatorio_documento_seguimiento1")[0].files[0];

  crear_overlay_documento_seguimiento_operatorio_asistencia_medica_1();

  var datos = new FormData();

  datos.append("idOperatorio", idOperatorio);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesDocumentoSeguimientosOperatorio",
    listaObservacionesDocumentoSeguimientosOperatorio
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/operatorios-clientes-empresariales/controlador_operatorio_asistencia_medica_individual_documento_seguimiento_registro_1.php",
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
          eliminar_overlay_documento_seguimiento_operatorio_asistencia_medica_1();
          $("#modalAgregarDocumentoSeguimientoOperatorio1").modal("hide");
          table_listar_operatorios_asistencia_medica_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_documento_seguimiento_operatorio_asistencia_medica_1();
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
      }
    },
  });
}
