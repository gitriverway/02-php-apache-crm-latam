$(document).on("hidden.bs.modal", function (event) {
  if ($(".modal:visible").length) {
    $("body").addClass("modal-open");
  }
});

// Helper function para traducciones en JavaScript
function t(key, defaultValue) {
  if (
    typeof translations !== "undefined" &&
    translations.form &&
    translations.form[key]
  ) {
    return translations.form[key];
  }
  if (
    typeof translations !== "undefined" &&
    translations.form_labels &&
    translations.form_labels[key]
  ) {
    return translations.form_labels[key];
  }
  return defaultValue || key;
}

// function lista1() {
//   $.ajax({
//     url: "/controller/siniestros-clientes/controlador_siniestro_vehiculo_individual_listar.php",
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
  $("#tabla-listar-siniestros-vehiculo-individual").removeClass("nowrap");
  $("#tabla-listar-siniestros-vehiculo-individual").addClass("dt-responsive");
} else {
  $("#tabla-listar-siniestros-vehiculo-individual").removeClass(
    "dt-responsive"
  );
  $("#tabla-listar-siniestros-vehiculo-individual").addClass("nowrap");
}

var table_listar_siniestros_vehiculo_individual;
function listar_siniestros_vehiculo_individual() {
  table_listar_siniestros_vehiculo_individual = $(
    "#tabla-listar-siniestros-vehiculo-individual"
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
        targets: [4, 5, 11],
      },
      {
        searchPanes: {
          show: false,
        },
        targets: [
          0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19,
          20, 21, 22, 23, 24, 25,
        ],
      },
    ],
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
    ajax: "controller/siniestros-clientes/controlador_siniestro_vehiculo_individual_listar.php",
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      for (var i = 0; i <= 25; i++) {
        $($(nRow).find("td")[i]).css("text-align", "center");
      }
    },
    language: idioma_espanol,
  });
}

function fecha_actual() {
  var fecha_actual_obervacion;

  $.ajax({
    url: "/controller/controlador_fecha_actual_zona_horario.php",
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

function listarValidaDatosSiniestro() {
  var listaValidarDatosSiniestro = [];

  var etiquetas = $(".etiquetaRadioValidar");

  for (var i = 1; i <= etiquetas.length; i++) {
    var documento = $("#etiquetaRadioValidar" + i).val();
    var radio = $("input:radio[name=radio_" + i + "]:checked").val();

    listaValidarDatosSiniestro.push({
      documento: documento,
      estado: radio,
    });
  }

  $("#listaValidarDatosSiniestro").val(
    JSON.stringify(listaValidarDatosSiniestro)
  );
}

/*=============================================
    LISTAR OBSERVACIONES VALIDAR DATOS SINIESTRO
  =============================================*/

function listarObservacionesValidarDatosSiniestro() {
  var listaObservacionesDatosSiniestro = [];

  var observaciones = $("#txt_observaciones_siniestro").val().toUpperCase();

  listaObservacionesDatosSiniestro.push({
    fecha_registro: fecha_actual(),
    observaciones: observaciones,
  });

  $("#listaObservacionesDatosSiniestro").val(
    JSON.stringify(listaObservacionesDatosSiniestro)
  );

  const reg = /\\n/g;
  var str = $("#listaObservacionesDatosSiniestro").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesDatosSiniestro").val(newStr);
}

/*=============================================
  ACTUALIZAR LISTADO DATOS SINIESTRO
  =============================================*/

/*=============================================
  CAMBIOS EN RADIO VALIDAR
  =============================================*/
$(".validarDatosSiniestro").on("change", "input.radio_validacion", function () {
  listarValidaDatosSiniestro();
});

/*=============================================
  CAMBIOS EN FECHA DE SEGUIMIENTO
  =============================================*/
$(".validarDatosSiniestro").on(
  "change",
  "input.fecha_seguimiento_validar",
  function () {
    listarValidaDatosSiniestro();
  }
);

/*=============================================
  CAMBIOS EN OBSERVACIONES
  =============================================*/
$(".validarDatosSiniestro").on(
  "keyup",
  "textarea.observaciones_siniestro",
  function () {
    listarValidaDatosSiniestro();
  }
);

$("#tabla-listar-siniestros-vehiculo-individual").on(
  "click",
  ".btnVerDetalleSiniestro",
  function () {
    $("#modalDetalleSiniestro").modal({ backdrop: "static", keyboard: false });
    $("#modalDetalleSiniestro").modal("show");

    $("#todoDetalleSiniestro").empty();

    var detalle = $(this).attr("detalle");
    var cliente_siniestro = $(this).attr("cliente_siniestro");
    $("#modalDetalleSiniestroVehiculo").text(cliente_siniestro);

    if (detalle.length > 0) {
      $("#todoDetalleSiniestro").append(
        '<div class="col-12 my-1">' +
          '<label class="detalleSiniestro" id="detalleSiniestro' +
          '" name="detalleSiniestro' +
          '">' +
          detalle +
          "</label>" +
          "</div>"
      );
    } else {
      $("#todoDetalleSiniestro").append(
        '<div class="col-12 my-1">' + "<p>SIN REGISTROS</p>" + '</div">'
      );
    }
  }
);

$("#tabla-listar-siniestros-vehiculo-individual").on(
  "click",
  ".btnVerDetalleTercerosSiniestro",
  function () {
    $("#modalDetalleSiniestro").modal({ backdrop: "static", keyboard: false });
    $("#modalDetalleSiniestro").modal("show");

    $("#todoDetalleSiniestro").empty();

    var nombre = $(this).attr("nombre");
    var telefono = $(this).attr("telefono");

    if (nombre.length > 0) {
      $("#todoDetalleSiniestro").append(
        '<div class="col-12 my-1">' +
          '<label class="nombreTercerosSiniestro" id="nombreTercerosSiniestro' +
          '" name="nombreTercerosSiniestro' +
          '">Nombre:' +
          nombre +
          "</label>" +
          "</div>" +
          '<div class="col-12 my-1">' +
          '<label class="telefonoTercerosSiniestro" id="telefonoTercerosSiniestro' +
          '" name="telefonoTercerosSiniestro' +
          '">Teléfono:' +
          telefono +
          "</label>" +
          "</div>"
      );
    } else {
      $("#todoDetalleSiniestro").append(
        '<div class="col-12 my-1">' + "<p>SIN REGISTROS</p>" + '</div">'
      );
    }
  }
);

/*********************************
 ABRIR MODAL OBSERVACIONES SINIESTRO
 *********************************/
var numObservacion = 0;
$("#tabla-listar-siniestros-vehiculo-individual").on(
  "click",
  ".btnVerObservaciones",
  function () {
    $("#modalObservaciones").modal({ backdrop: "static", keyboard: false });
    $("#modalObservaciones").modal("show");

    numObservacion = 0;

    $("#todoObservaciones").empty();

    var idSiniestro = $(this).attr("idSiniestro");
    var cliente_siniestro = $(this).attr("cliente_siniestro");
    $("#modalObservacionesSiniestroVehiculo").text(cliente_siniestro);

    var datos = new FormData();

    datos.append("idSiniestro", idSiniestro);

    $.ajax({
      url: "/controller/siniestros-clientes/controlador_observacion_siniestro_adicionales_listar.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        var data = JSON.parse(respuesta);

        if (data.length > 0) {
          $("#listaObservaciones").val(
            data[0]["siniestro_observacion_descripcion"]
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
                "<label>" + t('form_labels.fecha_registro', 'Fecha Registro') + "</label>" +
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
                "<label>" + t('form_labels.observacion', 'Observación') + "</label>" +
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

$("#tabla-listar-siniestros-vehiculo-individual").on(
  "click",
  ".btnVerDocumento",
  function () {
    var documentoRuta = $(this).attr("ruta");
    window.open(documentoRuta, "Documento", "width=1024,height=1024");
  }
);

/*********************************
 ABRI MODAL VALIDAR SINIESTRO
 *********************************/
$("#tabla-listar-siniestros-vehiculo-individual").on(
  "click",
  ".btnValidarDocumentosSiniestro",
  function () {
    var idSiniestro = $(this).attr("idSiniestro");
    var idContrato = $(this).attr("idContrato");
    var cliente_siniestro = $(this).attr("cliente_siniestro");

    $("#txt_idSiniestro").val(idSiniestro);
    $("#txt_idContrato").val(idContrato);
    $("#modalModificarSiniestroVehiculo").text(cliente_siniestro);

    $("#modalModificarSiniestro").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalModificarSiniestro").modal("show");
    Limpiar_Validar_Siniestro();
    listarValidaDatosSiniestro();
    // Cargar_Observaciones_Adicionales();
  }
);

function Limpiar_Validar_Siniestro() {
  $("#radio_formulario_siniestro_2").prop("checked", true);
  $("#radio_licencia_2").prop("checked", true);
  $("#radio_matricula_2").prop("checked", true);
  $("#radio_parte_policial_2").prop("checked", true);
  $("#radio_denuncia_fiscalia_2").prop("checked", true);
  $("#txt_fecha_seguimiento_validar").val("");
  $("#txt_observaciones_siniestro").val("");
  $("#listaObservacionesDatosSiniestro").val("");
}

function crear_overlay_validar_siniestro_vehiculo() {
  $("#modalValidarDocumentosSiniestro").append(
    '<div class="overlay dark" id="overlayValidarDocumentoSiniestro"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_validar_siniestro_vehiculo() {
  $("#overlayValidarDocumentoSiniestro").remove();
}

/*********************************
   MODIFICAR VALIDAR SINIESTRO
   *********************************/
function Modificar_Validar_Siniestro() {
  listarValidaDatosSiniestro();
  listarObservacionesValidarDatosSiniestro();

  var idSiniestro = $("#txt_idSiniestro").val();
  var idContrato = $("#txt_idContrato").val();
  var listaValidarDatosSiniestro = $("#listaValidarDatosSiniestro").val();
  var fecha_seguimiento_validar = $("#txt_fecha_seguimiento_validar").val();
  var listaObservacionesDatosSiniestro = $(
    "#listaObservacionesDatosSiniestro"
  ).val();

  var cont = 0;
  var cont1 = 0;

  if (listaValidarDatosSiniestro.length > 0) {
    var data = JSON.parse(listaValidarDatosSiniestro);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var estado = data[i]["estado"];
        if (estado == "NO") {
          cont++;
        }
      }
    }
  }
  if (listaObservacionesDatosSiniestro.length > 0) {
    var data1 = JSON.parse(listaObservacionesDatosSiniestro);
    if (data1.length > 0) {
      for (var i = 0; i < data1.length; i++) {
        var observacion = data1[i]["observaciones"];

        if (observacion.length > 0) {
          cont1++;
        }
      }
    }
  }

  if (listaValidarDatosSiniestro.length == 0) {
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

  crear_overlay_validar_siniestro_vehiculo();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);
  datos.append("idContrato", idContrato);
  datos.append("listaValidarDatosSiniestro", listaValidarDatosSiniestro);
  datos.append("fecha_seguimiento_validar", fecha_seguimiento_validar);
  datos.append(
    "listaObservacionesDatosSiniestro",
    listaObservacionesDatosSiniestro
  );
  datos.append("contar_validar", cont);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_siniestro_vehiculo_individual_validar_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      // console.log(respuesta);
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Validar Siniestro Modificado Exitosamente",
          "success"
        ).then((value) => {
          $("#modalModificarSiniestro").modal("hide");
          table_listar_siniestros_vehiculo_individual.ajax.reload();
        });
      }
      eliminar_overlay_validar_siniestro_vehiculo();
    },
  });
}

/*********************************
 ABRIR MODAL OBSERVACIONES ADICIONALES SEGUIMIENTO SINIESTRO
 *********************************/
$("#tabla-listar-siniestros-vehiculo-individual").on(
  "click",
  ".btnAgregarObservacionesAdicionales",
  function () {
    var idSiniestro = $(this).attr("idSiniestro");
    var idContrato = $(this).attr("idContrato");
    var cliente_siniestro = $(this).attr("cliente_siniestro");

    $("#txt_idSiniestro").val(idSiniestro);
    $("#txt_idContrato").val(idContrato);
    $("#modalAgregarObservacionesAdicionalesSiniestroVehiculo").text(
      cliente_siniestro
    );

    $("#modalAgregarObservacionAdicionalSiniestro").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarObservacionAdicionalSiniestro").modal("show");

    $("#txt_fecha_seguimiento_observacion_adicional").val("");
    $("#txt_observaciones_adicionales_seguimiento_siniestro").val("");

    Cargar_Observaciones_Adicionales_Seguimientos_Siniestros();
  }
);

function Cargar_Observaciones_Adicionales_Seguimientos_Siniestros() {
  var idSiniestro = $("#txt_idSiniestro").val();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_observacion_siniestro_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesAdicionalesSeguimientosSiniestroAnterior").val(
          data[0]["siniestro_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesAdicionalesSeguimientosSiniestroAnterior").val(
          ""
        );
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES SEGUIMIENTOS SINIESTRO
    =============================================*/

function listarObservacionesAdicionalesSeguimientoSiniestro() {
  if (
    $("#txt_observaciones_adicionales_seguimiento_siniestro").val().length > 0
  ) {
    var listaObservacionesAdicionalesSeguimientosSiniestro = [];
    var lista_observaciones = $(
      "#listaObservacionesAdicionalesSeguimientosSiniestroAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesAdicionalesSeguimientosSiniestroAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesAdicionalesSeguimientosSiniestro.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $(
      "#txt_observaciones_adicionales_seguimiento_siniestro"
    )
      .val()
      .toUpperCase();

    listaObservacionesAdicionalesSeguimientosSiniestro.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesAdicionalesSeguimientosSiniestro").val(
      JSON.stringify(listaObservacionesAdicionalesSeguimientosSiniestro)
    );
  } else {
    $("#listaObservacionesAdicionalesSeguimientosSiniestro").val(
      $("#listaObservacionesAdicionalesSeguimientosSiniestroAnterior").val()
    );
  }

  const reg = /\\n/g;
  var str = $("#listaObservacionesAdicionalesSeguimientosSiniestro").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesAdicionalesSeguimientosSiniestro").val(newStr);
}

function Modificar_Observaciones_adicionales_Seguimiento_Siniestro() {
  listarObservacionesAdicionalesSeguimientoSiniestro();

  var idSiniestro = $("#txt_idSiniestro").val();
  var idContrato = $("#txt_idContrato").val();
  var fecha_seguimiento = $(
    "#txt_fecha_seguimiento_observacion_adicional"
  ).val();
  var observacion = $(
    "#txt_observaciones_adicionales_seguimiento_siniestro"
  ).val();
  var lista_observaciones_adicionales = $(
    "#listaObservacionesAdicionalesSeguimientosSiniestro"
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

  datos.append("idSiniestro", idSiniestro);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "lista_observaciones_adicionales",
    lista_observaciones_adicionales
  );

  $.ajax({
    url: "/controller/siniestros-observaciones/controlador_siniestro_vehiculo_individual_observaciones_adicionales_modificar.php",
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
          $("#modalAgregarObservacionAdicionalSiniestro").modal("hide");
          table_listar_siniestros_vehiculo_individual.ajax.reload();
        });
      }
    },
  });
}

function Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos() {
  var idSiniestro = $("#txt_idSiniestro").val();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_documentos_adicionales_solictados_aseguradora_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaDocumentosSolicitadosAseguradoraAnterior").val(
          data[0]["siniestro_documentos_seguimiento"]
        );
      } else {
        $("#listaDocumentosSolicitadosAseguradoraAnterior").val("");
      }
      cargar_auto_documentos_aseguradora();
    },
  });
}

function Cargar_Observaciones_Seguimientos() {
  var idSiniestro = $("#txt_idSiniestro").val();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_observacion_siniestro_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesSeguimientosSiniestroAnterior").val(
          data[0]["siniestro_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesSeguimientosSiniestroAnterior").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES SEGUIMIENTOS SINIESTRO
    =============================================*/

function listarObservacionesSeguimientoSiniestro() {
  if ($("#txt_observaciones_seguimiento_siniestro").val().length > 0) {
    var listaObservacionesSeguimientosSiniestro = [];
    var lista_observaciones = $(
      "#listaObservacionesSeguimientosSiniestroAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesSeguimientosSiniestroAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesSeguimientosSiniestro.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_seguimiento_siniestro")
      .val()
      .toUpperCase();

    listaObservacionesSeguimientosSiniestro.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesSeguimientosSiniestro").val(
      JSON.stringify(listaObservacionesSeguimientosSiniestro)
    );
  } else {
    $("#listaObservacionesSeguimientosSiniestro").val(
      $("#listaObservacionesSeguimientosSiniestroAnterior").val()
    );
  }
  const reg = /\\n/g;
  var str = $("#listaObservacionesSeguimientosSiniestro").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesSeguimientosSiniestro").val(newStr);
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

  $(".seguimientoDatosSiniestro").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridSeguimientoSiniestro">' +
      "<!-- Documento -->" +
      '<div class="my-1 col-12 col-md-6 order-md-1 ' +
      estado +
      '">' +
      "<label>" + t('form_labels.documento', 'Documento') + "</label>" +
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
      "<label>" + t('form_labels.si', 'SI') + "</label>" +
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
      "<label>" + t('form_labels.no', 'NO') + "</label>" +
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

      $(".seguimientoDatosSiniestro").append(
        '<div class="col-12 my-1">' +
          '<div class="row gridSeguimientoSiniestro">' +
          "<!-- Documento -->" +
          '<div class="my-1 col-12 col-md-6 order-md-1 ' +
          estado +
          '">' +
          "<label>" + t('form_labels.documento', 'Documento') + "</label>" +
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
          "<label>" + t('form_labels.si', 'SI') + "</label>" +
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
          "<label>" + t('form_labels.no', 'NO') + "</label>" +
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

$(".seguimientoDatosSiniestro").on(
  "keyup",
  "input.documentoRequerido",
  function () {
    listarDocumentosAseguradora();
  }
);
/*=============================================
    CAMBIOS EN RADIO SEGUIMIENTO
    =============================================*/
$(".seguimientoDatosSiniestro").on(
  "change",
  "input.radio_seguimiento_si",
  function () {
    listarDocumentosAseguradora();
  }
);
$(".seguimientoDatosSiniestro").on(
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
$("#txt_observaciones_seguimiento_siniestro").keyup(function () {
  listarDocumentosAseguradora();
});

/*=============================================
    QUITAR DOCUMENTOS SOLICITADOS POR ASEGURADORA
    =============================================*/

var idQuitarDocumento = [];

localStorage.removeItem("quitarDocumento");

$(".seguimientoDatosSiniestro").on(
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

    if ($(".seguimientoDatosSiniestro").children().length == 0) {
      $("#listaDocumentosSolicitadosAseguradora").val("");
    } else {
      // AGRUPAR FAMILIARES EN FORMATO JSON
      listarDocumentosAseguradora();
    }
  }
);

/*********************************
 ABRIR MODAL REGISTRAR SOLICTAR DOCUMENTOS FALTANTES SEGUIMIENTO
 *********************************/
$("#tabla-listar-siniestros-vehiculo-individual").on(
  "click",
  ".btnSeguimientoSiniestroAseguradora",
  function () {
    $("#modalAgregarSeguimientoSiniestro").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarSeguimientoSiniestro").modal("show");
    var idSiniestro = $(this).attr("idSiniestro");
    var idContrato = $(this).attr("idContrato");
    var cliente_siniestro = $(this).attr("cliente_siniestro");

    $("#modalAgregarSeguimientoSiniestroVehiculo").text(cliente_siniestro);
    $("#txt_idSiniestro").val(idSiniestro);
    $("#txt_idContrato").val(idContrato);
    $("#enviarEmail").prop("checked", true);
    // $("#txt_fecha_seguimiento").val(fecha_actual());
    $("#txt_fecha_seguimiento").val("");
    $("#listaDocumentosSolicitadosAseguradora").val("");
    $(".seguimientoDatosSiniestro").empty();
    Cargar_lista_documentos_Solictados_Aseguradora_Seguimientos();
    Cargar_Observaciones_Seguimientos();
    listarObservacionesSeguimientoSiniestro();
  }
);

function crear_overlay_seguimiento_siniestro_vehiculo() {
  $("#modalSeguimientoSiniestro").append(
    '<div class="overlay dark" id="overlaySeguimientoSiniestroVehiculo"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_seguimiento_siniestro_vehiculo() {
  $("#overlaySeguimientoSiniestroVehiculo").remove();
}

function Modificar_Seguimiento_Siniestro() {
  listarObservacionesSeguimientoSiniestro();

  var idSiniestro = $("#txt_idSiniestro").val();
  var idContrato = $("#txt_idContrato").val();
  var listaDocumentosSolicitadosAseguradora = $(
    "#listaDocumentosSolicitadosAseguradora"
  ).val();
  var enviar_mail = "";
  var fecha_seguimiento = $("#txt_fecha_seguimiento").val();
  var observaciones = $("#txt_observaciones_seguimiento_siniestro").val();
  var listaObservacionesSeguimientosSiniestro = $(
    "#listaObservacionesSeguimientosSiniestro"
  ).val();

  var documento;

  if ($("#enviarEmail").is(":checked")) {
    enviar_mail = "SI";
  } else {
    enviar_mail = "NO";
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

  if (listaObservacionesSeguimientosSiniestro.length > 0) {
    var data1 = JSON.parse(listaObservacionesSeguimientosSiniestro);
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
    "#txt_documento_siniestro_requerimiento_documento_seguimiento"
  ).val();
  var extension = archivo.split(".").pop();
  documento = $(
    "#txt_documento_siniestro_requerimiento_documento_seguimiento"
  )[0].files[0];

  crear_overlay_seguimiento_siniestro_vehiculo();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);
  datos.append("idContrato", idContrato);
  datos.append(
    "listaDocumentosSolicitadosAseguradora",
    listaDocumentosSolicitadosAseguradora
  );
  datos.append("enviar_mail", enviar_mail);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesSeguimientosSiniestro",
    listaObservacionesSeguimientosSiniestro
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_siniestro_vehiculo_individual_seguimiento_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      // console.log(respuesta);
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Seguimiento Siniestro Modificado Exitosamente",
          "success"
        ).then((value) => {
          eliminar_overlay_seguimiento_siniestro_vehiculo();
          $("#modalAgregarSeguimientoSiniestro").modal("hide");
          table_listar_siniestros_vehiculo_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRAR DOCUMENTO ADICIONAL
 *********************************/
$("#tabla-listar-siniestros-vehiculo-individual").on(
  "click",
  ".btnAgregarDocumentoSeguimiento",
  function () {
    $("#modalAgregarDocumentoSeguimientoSiniestro").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarDocumentoSeguimientoSiniestro").modal("show");
    var idSiniestro = $(this).attr("idSiniestro");
    var idContrato = $(this).attr("idContrato");
    var cliente_siniestro = $(this).attr("cliente_siniestro");

    $("#modalAgregarDocumentoSeguimientoSiniestroVehiculo").text(
      cliente_siniestro
    );
    $("#txt_idSiniestro").val(idSiniestro);
    $("#txt_idContrato").val(idContrato);
    $("#txt_fecha_documento_seguimiento_aseguradora").val("");
    $("#txt_observaciones_documento_seguimiento_siniestro").val("");
    $("#txt_documento_siniestro_documento_seguimiento").val("");
    Cargar_Observaciones_Documentos_Seguimientos();
  }
);

/*=============================================
    CARGAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS SINIESTRO
  =============================================*/

function Cargar_Observaciones_Documentos_Seguimientos() {
  var idSiniestro = $("#txt_idSiniestro").val();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_observacion_siniestro_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesDocumentoSeguimientosSiniestroAnterior").val(
          data[0]["siniestro_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesDocumentoSeguimientosSiniestroAnterior").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS SINIESTRO
    =============================================*/

function listarObservacionesDocumentosSeguimientoSiniestro() {
  if (
    $("#txt_observaciones_documento_seguimiento_siniestro").val().length > 0
  ) {
    var listaObservacionesDocumentoSeguimientosSiniestro = [];
    var lista_observaciones = $(
      "#listaObservacionesDocumentoSeguimientosSiniestroAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesDocumentoSeguimientosSiniestroAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesDocumentoSeguimientosSiniestro.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_documento_seguimiento_siniestro")
      .val()
      .toUpperCase();

    listaObservacionesDocumentoSeguimientosSiniestro.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesDocumentoSeguimientosSiniestro").val(
      JSON.stringify(listaObservacionesDocumentoSeguimientosSiniestro)
    );
  } else {
    $("#listaObservacionesDocumentoSeguimientosSiniestro").val(
      $("#listaObservacionesDocumentoSeguimientosSiniestroAnterior").val()
    );
  }

  const reg = /\\n/g;
  var str = $("#listaObservacionesDocumentoSeguimientosSiniestro").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesDocumentoSeguimientosSiniestro").val(newStr);
}

function crear_overlay_documento_seguimiento_siniestro_vehiculo() {
  $("#modalDocumentoSeguimientoSiniestro").append(
    '<div class="overlay dark" id="overlayDocumentoSeguimientoSiniestroVehiculoIndividual"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_documento_seguimiento_siniestro_vehiculo() {
  $("#overlayDocumentoSeguimientoSiniestroVehiculoIndividual").remove();
}

/*****************************************************
   REGISTRAR UN NUEVO DOCUMENTO SEGUIMIENTO SINIESTRO
   ***************************************************/
function Registrar_Documento_Seguimiento_Siniestro() {
  listarObservacionesDocumentosSeguimientoSiniestro();

  var idSiniestro = $("#txt_idSiniestro").val().toUpperCase();
  var idContrato = $("#txt_idContrato").val().toUpperCase();
  var fecha_seguimiento = $(
    "#txt_fecha_documento_seguimiento_aseguradora"
  ).val();
  var observaciones = $(
    "#txt_observaciones_documento_seguimiento_siniestro"
  ).val();
  var listaObservacionesDocumentoSeguimientosSiniestro = $(
    "#listaObservacionesDocumentoSeguimientosSiniestro"
  ).val();

  var documento;

  var cont1 = 0;

  if (listaObservacionesDocumentoSeguimientosSiniestro.length > 0) {
    var data1 = JSON.parse(listaObservacionesDocumentoSeguimientosSiniestro);
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

  if ($("#txt_documento_siniestro_documento_seguimiento").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $("#txt_documento_siniestro_documento_seguimiento").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_siniestro_documento_seguimiento")[0].files[0];

  crear_overlay_documento_seguimiento_siniestro_vehiculo();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesDocumentoSeguimientosSiniestro",
    listaObservacionesDocumentoSeguimientosSiniestro
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_siniestro_vehiculo_individual_documento_seguimiento_registro.php",
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
          eliminar_overlay_documento_seguimiento_siniestro_vehiculo();
          $("#modalAgregarDocumentoSeguimientoSiniestro").modal("hide");
          table_listar_siniestros_vehiculo_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_documento_seguimiento_siniestro_vehiculo();
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
$("#tabla-listar-siniestros-vehiculo-individual").on(
  "click",
  ".btnAgregarLiquidacion",
  function () {
    $("#modalAgregarDocumentoLiquidacionSiniestro").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarDocumentoLiquidacionSiniestro").modal("show");
    var idSiniestro = $(this).attr("idSiniestro");
    var idBayer = $(this).attr("idBayer");
    var idContrato = $(this).attr("idContrato");
    var cliente_siniestro = $(this).attr("cliente_siniestro");

    $("#modalAgregarDocumentoLiquidacionSiniestroVehiculo").text(
      cliente_siniestro
    );
    $("#txt_idSiniestro").val(idSiniestro);
    $("#txt_idBayer").val(idBayer);
    $("#txt_idContrato").val(idContrato);

    LimpiarRegistroDocumentoLiquidacion();
    cargar_deducible_dependiente_siniestro();
    Cargar_Observaciones_Liquidacion_Seguimientos();
  }
);

function LimpiarRegistroDocumentoLiquidacion() {
  // $("#txt_valor_reclamo").val(0.0);
  // $("#txt_valor_deducible").val(0.0);
  // $("#txt_valor_rasa").val(0.0);
  // $("#txt_valor_cubierto").val(0.0);
  // $("#txt_valor_indemnizar_cliente").val(0.0);
  // $("#txt_valor_paga_cliente").val(0.0);

  $("#txt_documento_siniestro_documento_liquidacion").val("");

  // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
  // $(".valor_liquidacion").number(true, 2);
}

function cargar_deducible_dependiente_siniestro() {
  var idSiniestro = $("#txt_idSiniestro").val();
  var idContrato = $("#txt_idContrato").val();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);
  datos.append("idContrato", idContrato);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_traer_siniestro_vehiculo_individual.php",
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
          $("#listaVehiculos").val(data[i]["cliente_vehiculos"]);
          var lista_siniestro = JSON.parse(data[i]["siniestro_descripcion"]);
          var paciente = lista_siniestro[0]["vehiculo"];
          $("#txt_vehiculo_siniestro").val(paciente);
        }
      }
    },
  });
}

/*=============================================
    CARGAR OBSERVACIONES LIQUIDACIONES REEMBOLSO
  =============================================*/

function Cargar_Observaciones_Liquidacion_Seguimientos() {
  var idSiniestro = $("#txt_idSiniestro").val();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_observacion_siniestro_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesLiquidacionSiniestroAnterior").val(
          data[0]["siniestro_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesLiquidacionSiniestroAnterior").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES DOCUMENTOS SEGUIMIENTOS SINIESTRO
    =============================================*/

function listarObservacionesLiquidacionSiniestro() {
  if ($("#txt_observaciones_liquidacion_siniestro").val().length > 0) {
    var listaObservacionesLiquidacionSiniestro = [];
    var lista_observaciones = $(
      "#listaObservacionesLiquidacionSiniestroAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesLiquidacionSiniestroAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesLiquidacionSiniestro.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_liquidacion_siniestro")
      .val()
      .toUpperCase();

    listaObservacionesLiquidacionSiniestro.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesLiquidacionSiniestro").val(
      JSON.stringify(listaObservacionesLiquidacionSiniestro)
    );
  } else {
    $("#listaObservacionesLiquidacionSiniestro").val(
      $("#listaObservacionesLiquidacionSiniestroAnterior").val()
    );
  }

  const reg = /\\n/g;
  var str = $("#listaObservacionesLiquidacionSiniestro").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesLiquidacionSiniestro").val(newStr);
}

function crear_overlay_documento_liquidacion_siniestro_vehiculo() {
  $("#modalDocumentoLiquidacionSiniestro").append(
    '<div class="overlay dark" id="overlayDocumentoLiquidacionSiniestroVehiculo"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_documento_liquidacion_siniestro_vehiculo() {
  $("#overlayDocumentoLiquidacionSiniestroVehiculo").remove();
}

function calcular_valor_pago_cliente() {
  var valor =
    Number($("#txt_valor_deducible").val()) +
    Number($("#txt_valor_rasa").val());

  $("#txt_valor_paga_cliente").val(valor.toFixed(2));
}

function calcular_valor_liquidacion() {
  var valor =
    Number($("#txt_valor_reclamo").val()) -
    Number($("#txt_valor_deducible").val()) -
    Number($("#txt_valor_rasa").val());

  $("#txt_valor_indemnizar_cliente").val(valor.toFixed(2));
}

$("#txt_valor_reclamo").keyup(function () {
  calcular_valor_pago_cliente();
  calcular_valor_liquidacion();
});
$("#txt_valor_deducible").keyup(function () {
  calcular_valor_pago_cliente();
  calcular_valor_liquidacion();
});
$("#txt_valor_rasa").keyup(function () {
  calcular_valor_pago_cliente();
  calcular_valor_liquidacion();
});

/*********************************
   REGISTRAR LIQUIDACION SINIESTRO
   *********************************/
function Registrar_Documento_Liquidacion_Siniestro() {
  calcular_valor_pago_cliente();
  calcular_valor_liquidacion();
  listarObservacionesLiquidacionSiniestro();

  var idSiniestro = $("#txt_idSiniestro").val();
  var idBayer = $("#txt_idBayer").val();
  var idContrato = $("#txt_idContrato").val();
  var lista_vehiculo = $("#listaVehiculos").val();
  var valor_reclamo = $("#txt_valor_reclamo").val();
  var deducible_contrato = $("#txt_valor_deducible").val();
  var valor_rasa = $("#txt_valor_rasa").val();
  var valor_cubierto = $("#txt_valor_cubierto").val();
  var valor_paga_cliente = $("#txt_valor_paga_cliente").val();
  var valor_indemnizar_cliente = $("#txt_valor_indemnizar_cliente").val();
  var listaObservacionesLiquidacionSiniestro = $(
    "#listaObservacionesLiquidacionSiniestro"
  ).val();

  var documento;

  if (
    idBayer.length == 0 ||
    lista_vehiculo.length == 0 ||
    valor_reclamo.length == 0 ||
    deducible_contrato.length == 0 ||
    valor_rasa.length == 0 ||
    valor_cubierto.length == 0 ||
    valor_indemnizar_cliente.length == 0 ||
    valor_paga_cliente.length == 0
  ) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingrese valores numericos en los campos vacios",
      "warning"
    );
  }

  if ($("#txt_documento_siniestro_documento_liquidacion").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $("#txt_documento_siniestro_documento_liquidacion").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_siniestro_documento_liquidacion")[0].files[0];

  crear_overlay_documento_liquidacion_siniestro_vehiculo();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);
  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);
  datos.append("lista_vehiculo", lista_vehiculo);
  datos.append("valor_reclamo", valor_reclamo);
  datos.append("deducible_contrato", deducible_contrato);
  datos.append("valor_rasa", valor_rasa);
  datos.append("valor_cubierto", valor_cubierto);
  datos.append("valor_indemnizar_cliente", valor_indemnizar_cliente);
  datos.append("valor_paga_cliente", valor_paga_cliente);
  datos.append(
    "listaObservacionesLiquidacionSiniestro",
    listaObservacionesLiquidacionSiniestro
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_siniestro_vehiculo_individual_documento_liquidacion_registro.php",
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
          eliminar_overlay_documento_liquidacion_siniestro_vehiculo();
          $("#modalAgregarDocumentoLiquidacionSiniestro").modal("hide");
          table_listar_siniestros_vehiculo_individual.ajax.reload();
        });
      } else {
        eliminar_overlay_documento_liquidacion_siniestro_vehiculo();
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
 ABRIR MODAL OBSERVACIONES ADICIONALES SEGUIMIENTO SINIESTRO
 *********************************/
$("#tabla-listar-siniestros-vehiculo-individual").on(
  "click",
  ".btnAgregarAnulacion ",
  function () {
    var idSiniestro = $(this).attr("idSiniestro");
    var idContrato = $(this).attr("idContrato");
    var cliente_siniestro = $(this).attr("cliente_siniestro");

    $("#modalAgregarObservacionAnulacionSiniestroVehiculo").text(
      cliente_siniestro
    );
    $("#txt_idSiniestro").val(idSiniestro);
    $("#txt_idContrato").val(idContrato);

    $("#modalAgregarObservacionAnulacionSiniestro").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarObservacionAnulacionSiniestro").modal("show");

    $("#txt_observaciones_anulacion_siniestro").val("");

    Cargar_Observaciones_Anulacion_Siniestros();
  }
);

function Cargar_Observaciones_Anulacion_Siniestros() {
  var idSiniestro = $("#txt_idSiniestro").val();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_observacion_siniestro_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesAnulacionSiniestroAnterior").val(
          data[0]["siniestro_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesAnulacionSiniestroAnterior").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES SEGUIMIENTOS SINIESTRO
    =============================================*/

function listarObservacionesAnulacionSiniestro() {
  if ($("#txt_observaciones_anulacion_siniestro").val().length > 0) {
    var listaObservacionesAnulacionSiniestro = [];
    var lista_observaciones = $(
      "#listaObservacionesAnulacionSiniestroAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesAnulacionSiniestroAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesAnulacionSiniestro.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_anulacion_siniestro")
      .val()
      .toUpperCase();

    listaObservacionesAnulacionSiniestro.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesAnulacionSiniestro").val(
      JSON.stringify(listaObservacionesAnulacionSiniestro)
    );
  } else {
    $("#listaObservacionesAnulacionSiniestro").val(
      $("#listaObservacionesAnulacionSiniestroAnterior").val()
    );
  }

  const reg = /\\n/g;
  var str = $("#listaObservacionesAnulacionSiniestro").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesAnulacionSiniestro").val(newStr);
}

function Modificar_Observaciones_Anulacion_Siniestro() {
  listarObservacionesAnulacionSiniestro();

  var idSiniestro = $("#txt_idSiniestro").val();
  var idContrato = $("#txt_idContrato").val();
  var observacion = $("#txt_observaciones_anulacion_siniestro").val();
  var lista_observaciones_anulacion = $(
    "#listaObservacionesAnulacionSiniestro"
  ).val();

  if (observacion.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar una observaci&oacute;n",
      "warning"
    );
  }

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);
  datos.append("idContrato", idContrato);
  datos.append("lista_observaciones_anulacion", lista_observaciones_anulacion);

  $.ajax({
    url: "/controller/siniestros-observaciones/controlador_siniestro_vehiculo_individual_observaciones_anulacion_modificar.php",
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
          $("#modalAgregarObservacionAnulacionSiniestro").modal("hide");
          table_listar_siniestros_vehiculo_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRO DE REEMBOLSO
 *********************************/
function AbrirModalRegistro() {
  $("#modalAgregarSiniestro").modal({ backdrop: "static", keyboard: false });
  $("#modalAgregarSiniestro").modal("show");
  LimpiarRegistro();
}

function LimpiarRegistro() {
  $("#txt_idBayer").val("");
  $("#txt_contrato_aplicar").val("");
  $("#cbm_vehiculo").empty();
  $("#cbm_vehiculo").append("<option value=''>SIN REGISTROS</option>");
  $("#txt_fecha_siniestro").val("");
  $("#radio_danos_terceros_2").prop("checked", true);
  $("#txt_detalle_siniestro").val("");
  $("#txt_documento_siniestro").val("");
  $("#datosTerceros").addClass("d-none");

  $("#txt_nombre_afectado_siniestro").val("");
  $("#txt_telefono_afectado_siniestro").val("");
}

$(".radio_danos_tercero").change(function () {
  var radio = $("input:radio[name=radio_danos_tercero]:checked").val();

  if (radio == "SI") {
    $("#datosTerceros").removeClass("d-none");
  } else {
    $("#datosTerceros").addClass("d-none");
    $("#txt_nombre_afectado_siniestro").val("");
    $("#txt_telefono_afectado_siniestro").val("");
  }
});

$(".btnListarContratos").click(function () {
  $("#modalListarContratosClientes").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modalListarContratosClientes").modal("show");
  listar_contratos_para_seleccionar();
});
/************************************
Listar Contratos Clientes
*************************************/
var table_listar_contratos_cliente;
function listar_contratos_para_seleccionar() {
  var f = new Date();
  fecha = f.getFullYear() + "-" + f.getMonth() + "-" + f.getDate();

  var fecha_actual = $("#txt_fecha_siniestro").val();

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
      [5, 10, 25, 50, 100, -1],
      [5, 10, 25, 50, 100, "All"],
    ],
    pageLength: 5,
    destroy: true,
    async: false,
    processing: true,
    ajax:
      "controller/contratos-clientes/controlador_contrato_cliente_vehiculo_individual_listar_todos.php?fecha=" +
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
    var proveedor_descripcion = $(this).attr("proveedor_descripcion");

    $("#txt_idBayer").val(idCliente);
    $("#txt_idContrato").val(idContrato);
    $("#txt_contrato_aplicar").val(numeroContrato);

    if (proveedor_descripcion == "ZURICH") {
      $("#formularioZurich").removeClass("d-none");
    } else {
      $("#formularioZurich").addClass("d-none");
    }

    $("#modalListarContratosClientes").modal("hide");

    listar_combo_vehiculos();
  }
);

/*********************************
LISTAR COMBO VEHICULOS
*********************************/
function listar_combo_vehiculos() {
  var idBayer = $("#txt_idBayer").val();
  var idContrato = $("#txt_idContrato").val();

  var datos = new FormData();
  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);

  $.ajax({
    url: "/controller/bayer_persona/controlador_combo_vehiculos_listar.php",
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
              "<option  value='marca: " +
              data[i]["marca"] +
              " modelo: " +
              data[i]["modelo"] +
              " año: " +
              data[i]["ano"] +
              "'>marca: " +
              data[i]["marca"] +
              " modelo: " +
              data[i]["modelo"] +
              " año: " +
              data[i]["ano"] +
              "</option>";
          }
        } else {
          cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
      } else {
        cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
      }
      $(".cbm_vehiculo").html(cadena);
    },
  });
}

/*=============================================
LISTAR DATOS SINIESTRO
=============================================*/
function listarDatosSiniestro() {
  var listaDatosSiniestro = [];

  var vehiculo = $(".cbm_vehiculo");
  var fecha_siniestro = $(".fecha_siniestro");
  var lugar_siniestro = $(".lugar_siniestro");
  var danos_tercero = $("input:radio[name=radio_danos_tercero]:checked").val();
  var detalle_siniestro = $(".detalle_siniestro");

  for (var i = 0; i < vehiculo.length; i++) {
    listaDatosSiniestro.push({
      vehiculo: $(vehiculo[i]).val().toUpperCase(),
      fecha_siniestro: $(fecha_siniestro[i]).val(),
      lugar_siniestro: $(lugar_siniestro[i]).val().toUpperCase(),
      danos_tercero: danos_tercero,
      detalle_siniestro: $(detalle_siniestro[i]).val().toUpperCase(),
    });
  }

  $("#listaDatosSiniestro").val(JSON.stringify(listaDatosSiniestro));
  const reg = /\\n/g;
  var str = $("#listaDatosSiniestro").val();
  const newStr = str.replace(reg, " ");
  $("#listaDatosSiniestro").val(newStr);
}

/*=============================================
LISTAR DATOS TERCEROS SINIESTRO
=============================================*/
function listarDatosTerceroSiniestro() {
  var listaDatosTerceroSiniestro = [];

  var nombre = $(".nombre_afectado_siniestro");
  var telefono = $(".telefono_afectado_siniestro");

  for (var i = 0; i < nombre.length; i++) {
    listaDatosTerceroSiniestro.push({
      nombre: $(nombre[i]).val().trim().toUpperCase(),
      telefono: $(telefono[i]).val().trim(),
    });
  }

  if (nombre.length == 0) {
    $("#listaDatosTerceroSiniestro").val("");
  } else {
    $("#listaDatosTerceroSiniestro").val(
      JSON.stringify(listaDatosTerceroSiniestro)
    );
    const reg = /\\n/g;
    var str = $("#listaDatosTerceroSiniestro").val();
    const newStr = str.replace(reg, " ");
    $("#listaDatosTerceroSiniestro").val(newStr);
  }
}

function crear_overlay_siniestro_cliente_vehiculo() {
  $("#modalNuevoSiniestro").append(
    '<div class="overlay dark" id="overlayNuevoSiniestro"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_siniestro_cliente_vehiculo() {
  $("#overlayNuevoSiniestro").remove();
}

/*********************************
 REGISTRAR UN NUEVO SINIESTRO
 *********************************/
function Registrar_Siniestro() {
  listarDatosSiniestro();
  listarDatosTerceroSiniestro();

  var idBayer = $("#txt_idBayer").val().toUpperCase();
  var idContrato = $("#txt_idContrato").val().toUpperCase();
  var listaDatosSiniestro = $("#listaDatosSiniestro").val();
  var listaDatosTerceroSiniestro = $("#listaDatosTerceroSiniestro").val();
  var danos_tercero = $("input:radio[name=radio_danos_tercero]:checked").val();

  var documento;

  var cont = 0;
  var cont1 = 0;

  if (listaDatosSiniestro.length > 0) {
    var data = JSON.parse(listaDatosSiniestro);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var vehiculo = data[i]["vehiculo"];
        var fecha_siniestro = data[i]["fecha_siniestro"];
        var lugar_siniestro = data[i]["lugar_siniestro"];
        var detalle_siniestro = data[i]["detalle_siniestro"];

        if (
          vehiculo.length == 0 ||
          fecha_siniestro.length == 0 ||
          lugar_siniestro.length == 0 ||
          detalle_siniestro.length == 0
        ) {
          cont++;
        }
      }
    }
  }
  if (listaDatosTerceroSiniestro.length > 0) {
    var data1 = JSON.parse(listaDatosTerceroSiniestro);
    if (data1.length > 0) {
      for (var i = 0; i < data1.length; i++) {
        var nombre_perjudicado = data1[i]["nombre"];
        var telefno_perjudicado = data1[i]["telefono"];

        if (nombre_perjudicado.length == 0 || telefno_perjudicado.length == 0) {
          cont1++;
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

  if (listaDatosSiniestro.length == 0 || cont > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios para el Siniestro",
      "warning"
    );
  }

  if (danos_tercero == "SI" && cont1 > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios para daños a terceros",
      "warning"
    );
  }

  if ($("#txt_documento_siniestro").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $("#txt_documento_siniestro").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_siniestro")[0].files[0];

  crear_overlay_siniestro_cliente_vehiculo();

  var datos = new FormData();

  datos.append("idBayer", idBayer);
  datos.append("idContrato", idContrato);
  datos.append("listaDatosSiniestro", listaDatosSiniestro);
  datos.append("listaDatosTerceroSiniestro", listaDatosTerceroSiniestro);
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_siniestro_vehiculo_individual_registro.php",
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
          "Datos correctamente, Nuevo Siniestro Registrado",
          "success"
        ).then((value) => {
          eliminar_overlay_siniestro_cliente_vehiculo();
          $("#modalAgregarSiniestro").modal("hide");
          table_listar_siniestros_vehiculo_individual.ajax.reload();
        });
      } else {
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
        eliminar_overlay_siniestro_cliente_vehiculo();
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRAR SOLICTAR DOCUMENTOS FALTANTES SEGUIMIENTO
 *********************************/
$("#tabla-listar-siniestros-vehiculo-individual").on(
  "click",
  ".btnAjusteAutorizacion",
  function () {
    $("#modalAgregarAjusteAutorizacionSiniestro").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarAjusteAutorizacionSiniestro").modal("show");
    var idSiniestro = $(this).attr("idSiniestro");
    var idContrato = $(this).attr("idContrato");
    var cliente_siniestro = $(this).attr("cliente_siniestro");

    $("#modalAgregarAjusteAutorizacionSiniestroVehiculo").text(
      cliente_siniestro
    );
    $("#txt_idSiniestro").val(idSiniestro);
    $("#txt_idContrato").val(idContrato);

    $("#txt_fecha_seguimiento_ajuste_autorizacion").val("");
    Cargar_Observaciones_Ajuste_Autorizacion();
    listarObservacionesAjusteAutorizacionSiniestro();
  }
);

function Cargar_Observaciones_Ajuste_Autorizacion() {
  var idSiniestro = $("#txt_idSiniestro").val();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_observacion_siniestro_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesAjusteAutorizacionSiniestroAnterior").val(
          data[0]["siniestro_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesAjusteAutorizacionSiniestroAnterior").val("");
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES SEGUIMIENTOS SINIESTRO
    =============================================*/

function listarObservacionesAjusteAutorizacionSiniestro() {
  if ($("#txt_observaciones_ajuste_autorizacion_siniestro").val().length > 0) {
    var listaObservacionesAjusteAutorizacionSiniestro = [];
    var lista_observaciones = $(
      "#listaObservacionesAjusteAutorizacionSiniestroAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $("#listaObservacionesAjusteAutorizacionSiniestroAnterior").val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesAjusteAutorizacionSiniestro.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $("#txt_observaciones_ajuste_autorizacion_siniestro")
      .val()
      .toUpperCase();

    listaObservacionesAjusteAutorizacionSiniestro.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesAjusteAutorizacionSiniestro").val(
      JSON.stringify(listaObservacionesAjusteAutorizacionSiniestro)
    );
  } else {
    $("#listaObservacionesAjusteAutorizacionSiniestro").val(
      $("#listaObservacionesAjusteAutorizacionSiniestroAnterior").val()
    );
  }
  const reg = /\\n/g;
  var str = $("#listaObservacionesAjusteAutorizacionSiniestro").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesAjusteAutorizacionSiniestro").val(newStr);
}

function crear_overlay_ajuste_autorizacion_siniestro_vehiculo() {
  $("#modalAjusteAutorizacionSiniestro").append(
    '<div class="overlay dark" id="overlayAjusteAutorizacionSiniestroVehiculo"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_ajuste_autorizacion_siniestro_vehiculo() {
  $("#overlayAjusteAutorizacionSiniestroVehiculo").remove();
}

function Modificar_Ajuste_Autorizacion_Siniestro() {
  listarObservacionesAjusteAutorizacionSiniestro();

  var idSiniestro = $("#txt_idSiniestro").val();
  var idContrato = $("#txt_idContrato").val();
  var fecha_seguimiento = $("#txt_fecha_seguimiento_ajuste_autorizacion").val();
  var observaciones = $(
    "#txt_observaciones_ajuste_autorizacion_siniestro"
  ).val();
  var listaObservacionesSeguimientosSiniestro = $(
    "#listaObservacionesAjusteAutorizacionSiniestro"
  ).val();

  var documento;

  var cont = 0;

  if (listaObservacionesSeguimientosSiniestro.length > 0) {
    var data1 = JSON.parse(listaObservacionesSeguimientosSiniestro);
    if (data1.length > 0) {
      for (var i = 0; i < data1.length; i++) {
        var observacion = data1[i]["observaciones"];

        if (observacion.length > 0) {
          cont++;
        }
      }
    }
  }

  if (fecha_seguimiento.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Selecciones la fecha de seguimiento",
      "warning"
    );
  }

  if (cont == 0 || observaciones.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar una observaci&oacute;n",
      "warning"
    );
  }

  var archivo = $("#txt_documento_siniestro_ajuste_autorizacion").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_siniestro_ajuste_autorizacion")[0].files[0];

  crear_overlay_ajuste_autorizacion_siniestro_vehiculo();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesSeguimientosSiniestro",
    listaObservacionesSeguimientosSiniestro
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_siniestro_vehiculo_individual_ajuste_autorizacion.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      // console.log(respuesta);
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Ajuste y Autorización de Siniestro Modificado Exitosamente",
          "success"
        ).then((value) => {
          eliminar_overlay_ajuste_autorizacion_siniestro_vehiculo();
          $("#modalAgregarAjusteAutorizacionSiniestro").modal("hide");
          table_listar_siniestros_vehiculo_individual.ajax.reload();
        });
      }
    },
  });
}

/*********************************
 ABRIR MODAL REGISTRAR SOLICTAR DOCUMENTOS FALTANTES SEGUIMIENTO
 *********************************/
$("#tabla-listar-siniestros-vehiculo-individual").on(
  "click",
  ".btnAjusteAutorizacionTerceros",
  function () {
    $("#modalAgregarAjusteAutorizacionTercerosSiniestro").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modalAgregarAjusteAutorizacionTercerosSiniestro").modal("show");
    var idSiniestro = $(this).attr("idSiniestro");
    var idContrato = $(this).attr("idContrato");
    var cliente_siniestro = $(this).attr("cliente_siniestro");

    $("#modalAgregarAjusteAutorizacionTercerosSiniestroVehiculo").text(
      cliente_siniestro
    );
    $("#txt_idSiniestro").val(idSiniestro);
    $("#txt_idContrato").val(idContrato);

    $("#txt_fecha_seguimiento_ajuste_autorizacion_terceros").val("");
    Cargar_Observaciones_Ajuste_Autorizacion_Terceros();
    listarObservacionesAjusteAutorizacionTercerosSiniestro();
  }
);

function Cargar_Observaciones_Ajuste_Autorizacion_Terceros() {
  var idSiniestro = $("#txt_idSiniestro").val();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_observacion_siniestro_adicionales_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      if (data.length > 0) {
        $("#listaObservacionesAjusteAutorizacionSiniestroTercerosAnterior").val(
          data[0]["siniestro_observacion_descripcion"]
        );
      } else {
        $("#listaObservacionesAjusteAutorizacionSiniestroTercerosAnterior").val(
          ""
        );
      }
    },
  });
}

/*=============================================
      LISTAR OBSERVACIONES AJUSTE TERCEROS SINIESTRO
    =============================================*/

function listarObservacionesAjusteAutorizacionTercerosSiniestro() {
  if (
    $("#txt_observaciones_ajuste_autorizacion_terceros_siniestro").val()
      .length > 0
  ) {
    var listaObservacionesAjusteAutorizacionSiniestroTerceros = [];
    var lista_observaciones = $(
      "#listaObservacionesAjusteAutorizacionSiniestroTercerosAnterior"
    ).val();
    if (lista_observaciones.length > 0) {
      lista_observaciones = JSON.parse(
        $(
          "#listaObservacionesAjusteAutorizacionSiniestroTercerosAnterior"
        ).val()
      );
      for (let i = 0; i < lista_observaciones.length; i++) {
        listaObservacionesAjusteAutorizacionSiniestroTerceros.push({
          fecha_registro: lista_observaciones[i]["fecha_registro"],
          observaciones: lista_observaciones[i]["observaciones"],
        });
      }
    }

    var observaciones = $(
      "#txt_observaciones_ajuste_autorizacion_terceros_siniestro"
    )
      .val()
      .toUpperCase();

    listaObservacionesAjusteAutorizacionSiniestroTerceros.push({
      fecha_registro: fecha_actual(),
      observaciones: observaciones,
    });

    $("#listaObservacionesAjusteAutorizacionSiniestroTerceros").val(
      JSON.stringify(listaObservacionesAjusteAutorizacionSiniestroTerceros)
    );
  } else {
    $("#listaObservacionesAjusteAutorizacionSiniestroTerceros").val(
      $("#listaObservacionesAjusteAutorizacionSiniestroTercerosAnterior").val()
    );
  }
  const reg = /\\n/g;
  var str = $("#listaObservacionesAjusteAutorizacionSiniestroTerceros").val();
  const newStr = str.replace(reg, " ");
  $("#listaObservacionesAjusteAutorizacionSiniestroTerceros").val(newStr);
}

function crear_overlay_ajuste_autorizacion_terceros_siniestro_vehiculo() {
  $("#modalAjusteAutorizacionTercerosSiniestro").append(
    '<div class="overlay dark" id="overlayAjusteAutorizacionTercerosSiniestroVehiculo"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_ajuste_autorizacion_terceros_siniestro_vehiculo() {
  $("#overlayAjusteAutorizacionTercerosSiniestroVehiculo").remove();
}

function Modificar_Ajuste_Autorizacion_Terceros_Siniestro() {
  listarObservacionesAjusteAutorizacionTercerosSiniestro();

  var idSiniestro = $("#txt_idSiniestro").val();
  var idContrato = $("#txt_idContrato").val();
  var fecha_seguimiento = $(
    "#txt_fecha_seguimiento_ajuste_autorizacion_terceros"
  ).val();
  var observaciones = $(
    "#txt_observaciones_ajuste_autorizacion_terceros_siniestro"
  ).val();
  var listaObservacionesSeguimientosSiniestro = $(
    "#listaObservacionesAjusteAutorizacionSiniestroTerceros"
  ).val();

  var documento;

  var cont = 0;

  if (listaObservacionesSeguimientosSiniestro.length > 0) {
    var data1 = JSON.parse(listaObservacionesSeguimientosSiniestro);
    if (data1.length > 0) {
      for (var i = 0; i < data1.length; i++) {
        var observacion = data1[i]["observaciones"];

        if (observacion.length > 0) {
          cont++;
        }
      }
    }
  }

  if (fecha_seguimiento.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Selecciones la fecha de seguimiento",
      "warning"
    );
  }

  if (cont == 0 || observaciones.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingresar una observaci&oacute;n",
      "warning"
    );
  }

  var archivo = $(
    "#txt_documento_siniestro_ajuste_autorizacion_terceros"
  ).val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_siniestro_ajuste_autorizacion_terceros")[0]
    .files[0];

  crear_overlay_ajuste_autorizacion_terceros_siniestro_vehiculo();

  var datos = new FormData();

  datos.append("idSiniestro", idSiniestro);
  datos.append("idContrato", idContrato);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append(
    "listaObservacionesSeguimientosSiniestro",
    listaObservacionesSeguimientosSiniestro
  );
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "/controller/siniestros-clientes/controlador_siniestro_vehiculo_individual_ajuste_autorizacion_terceros.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      // console.log(respuesta);
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Ajuste y Autorización de Siniestro Modificado Exitosamente",
          "success"
        ).then((value) => {
          eliminar_overlay_ajuste_autorizacion_terceros_siniestro_vehiculo();
          $("#modalAgregarAjusteAutorizacionTercerosSiniestro").modal("hide");
          table_listar_siniestros_vehiculo_individual.ajax.reload();
        });
      }
    },
  });
}
