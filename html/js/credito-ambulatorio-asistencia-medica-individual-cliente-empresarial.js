$(document).on("hidden.bs.modal", function (event) {
  if ($(".modal:visible").length) {
    $("body").addClass("modal-open");
  }
});

//  function lista1(){

//     $.ajax({

//         url:"controller/creditos-ambulatorios-clientes/controlador_credito_ambulatorio_cliente_asistencia_medica_individual_listar.php",
//         method: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(respuesta){

//             console.log(respuesta);

//         }
//     });
//  }

/*=============================================
AGREGAR RESPONSIVE A DATABLE
=============================================*/
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

var table_listar_credito_ambulatorio_asistencia_medica_individual;
function listar_credito_ambulatorio_cliente_asistencia_medica_individual() {
  table_listar_credito_ambulatorio_asistencia_medica_individual = $(
    "#tabla-listar-creditos-ambulatorios-asistencia-medica-individual"
  ).DataTable({
    scrollX: true,
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
    dom: "BPfrtip",
    columnDefs: [
      {
        searchPanes: {
          show: true,
        },
        targets: [2, 3, 6],
      },
      {
        searchPanes: {
          show: false,
        },
        targets: [0, 1, 2, 3, 4, 5],
      },
    ],
    ajax: "controller/creditos-ambulatorios-clientes-empresariales/controlador_credito_ambulatorio_cliente_asistencia_medica_individual_listar.php",
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
    },
    language: idioma_espanol,
  });
}

/*=============================================
  LISTAR CONTRATOS EXISTENTES
  =============================================*/

$(".fecha_credito_ambulatorio").change(function () {
  $("#txt_contrato_aplicar").val("");
  $("#txt_idBayer").val("");
  $("#txt_idContrato").val("");
  $("#txt_nombre_paciente").val("");
  $("#cbm_nombre_paciente").empty();
  $("#cbm_nombre_paciente").append("<option value=''>SIN REGISTROS</option>");
  // $("#txt_valor_presentado_credito_ambulatorio").val("");
});

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
      "controller/contratos-clientes-empresariales/controlador_contrato_cliente_asistencia_medica_individual_listar_seleccionar.php?fecha=" +
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

/*********************************
 ABRIR MODAL REGISTRO DE CREDITO AMBULATORIO
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
  $("#cbm_nombre_colaborador").empty();
  $("#cbm_nombre_colaborador").append(
    "<option value=''>SIN REGISTROS</option>"
  );
  $("#cbm_nombre_paciente").empty();
  $("#cbm_nombre_paciente").append("<option value=''>SIN REGISTROS</option>");
  $("#txt_fecha_credito_ambulatorio").val("");
  // $("#txt_valor_presentado_credito_ambulatorio").val("");
  $("#txt_diagnostico_credito_ambulatorio").val("");
  $("#txt_documento_credito_ambulatorio").val("");
}

/*=============================================
  RECARGAR ETIQUETAS LISTAR OBSERVACIONES
  =============================================*/
function listarDatosCreditoAmbulatorio() {
  var listaDatosCreditoAmbulatorio = [];

  var nombre_colaborador = $(".cbm_nombre_colaborador");
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
      nombre_colaborador: $(nombre_colaborador[i]).val().toUpperCase(),
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

/*=============================================
  ACTUALIZAR LISTADO DATOS CREDTIO AMBULATORIO
  =============================================*/
$(".nuevoDatosCreditoAmbulatorio").on(
  "change",
  "select.cbm_nombre_colaborador",
  function () {
    cargar_lista_pacientes();
    listarDatosCreditoAmbulatorio();
  }
);

$(".nuevoDatosCreditoAmbulatorio").on(
  "change",
  "select.cbm_nombre_paciente",
  function () {
    listarDatosCreditoAmbulatorio();
  }
);

$(".nuevoDatosCreditoAmbulatorio").on(
  "keyup",
  "input.fecha_credito_ambulatorio",
  function () {
    listarDatosCreditoAmbulatorio();
  }
);

// $(".nuevoDatosCreditoAmbulatorio").on("keyup", "input.valor_presentado", function () {
//   listarDatosCreditoAmbulatorio();
// })

$(".nuevoDatosCreditoAmbulatorio").on(
  "keyup",
  "textarea.diagnostico_credito_ambulatorio",
  function () {
    listarDatosCreditoAmbulatorio();
  }
);

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
  var idBayer = $("#txt_idBayer").val().toUpperCase();
  var idContrato = $("#txt_idContrato").val().toUpperCase();
  var listaDatosCreditoAmbulatorio = $("#listaDatosCreditoAmbulatorio").val();
  var documento;

  var cont = 0;

  if (listaDatosCreditoAmbulatorio.length > 0) {
    var data = JSON.parse(listaDatosCreditoAmbulatorio);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var nombre_colaborador = data[i]["nombre_colaborador"];
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
          nombre_colaborador.length == 0 ||
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
    url: "controller/creditos-ambulatorios-clientes-empresariales/controlador_credito_ambulatorio_asistencia_medica_individual_registro.php",
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
          "Datos correctamente, Nuevo Petición Credito Ambulatorio Registrado",
          "success"
        ).then((value) => {
          eliminar_overlay_credito_ambulatorio_cliente_asistencia_medica();
          $("#modalAgregarCreditoAmbulatorio").modal("hide");
          table_listar_credito_ambulatorio_asistencia_medica_individual.ajax.reload();
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

var numObservacion = 0;
/*********************************
 ABRIR MODAL OBSERVACIONES REEMBOLSO
 *********************************/
$("#tabla-listar-creditos-ambulatorios-asistencia-medica-individual").on(
  "click",
  ".btnVerObservaciones",
  function () {
    $("#modalObservaciones").modal({ backdrop: "static", keyboard: false });
    $("#modalObservaciones").modal("show");

    numObservacion = 0;

    $("#todoObservaciones").empty();

    var idCreditoAmbulatorio = $(this).attr("idCreditoAmbulatorio");

    var datos = new FormData();

    datos.append("idCreditoAmbulatorio", idCreditoAmbulatorio);

    $.ajax({
      url: "controller/creditos-ambulatorios-clientes-empresariales/controlador_observacion_credito_ambulatorio_adicionales_listar.php",
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
                '<div class="row">' +
                "<!-- Fecha de Registro -->" +
                '<div class="col-6 order-md-1 my-1 ' +
                estado +
                ' etiquetaFechaObservacion" id="etiquetaFechaObservacion' +
                numObservacion +
                '" style="padding-right:0px">' +
                "<label>Fecha Registro</label>" +
                "</div>" +
                '<div class="col-6 order-md-3 my-1" style="padding-right:0px">' +
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
                '<div class="col-6 order-md-2 my-1 ' +
                estado +
                ' etiquetaDescripcionObservacion" id="etiquetaDescripcionObservacion' +
                numObservacion +
                '">' +
                "<label>Observaci&oacute;n</label>" +
                "</div>" +
                '<div class="col-6 order-md-4 my-1">' +
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
  ".btnVerDocumentoAutorizacion",
  function () {
    var documentoRuta = $(this).attr("ruta");
    window.open(documentoRuta, "Documento", "width=1024,height=1024");
  }
);
