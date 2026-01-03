$(document).on("hidden.bs.modal", function (event) {
  if ($(".modal:visible").length) {
    $("body").addClass("modal-open");
  }
});

//  function lista1(){

//   var f=new Date();
//   fecha=(f.getFullYear()+'-'+(f.getMonth()+1)+'-'+f.getDate());

//   var fecha_actual = $("#txt_fecha_atencion").val();

//     if (fecha_actual == "") {
//       fecha_envio = fecha;
//     } else {
//       fecha_envio = fecha_actual;
//     }

//     $.ajax({

//         url:"controller/contratos-clientes-empresariales/controlador_contrato_cliente_asistencia_medica_individual_listar_seleccionar.php?fecha="+fecha_envio,
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
function listar_reembolsos_cliente_asistencia_medica_individual() {
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
    dom: "BPfrtip",
    columnDefs: [
      {
        searchPanes: {
          show: true,
        },
        targets: [3, 4, 6],
      },
      {
        searchPanes: {
          show: false,
        },
        targets: [
          0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19,
          20,
        ],
      },
    ],
    ajax: "controller/reembolsos-clientes-empresariales/controlador_reembolsos_cliente_asistencia_medica_individual_listar.php",
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
      $($(nRow).find("td")[18]).css("text-align", "center");
      $($(nRow).find("td")[20]).css("text-align", "center");
    },
    language: idioma_espanol,
  });
}

$("#txt_documento_reembolso").change(function () {
  var documento = this.files[0];

  // Tamaño correcto en bytes (25MB reales)
  var maxSizeMB = 25;
  var maxSizeBytes = maxSizeMB * 1024 * 1024;
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  if (documento["type"] != "application/pdf") {
    $("#txt_documento_reembolso").val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir el documento",
      text: "¡El documento debe estar en formato PDF!",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (documento["size"] > maxSizeBytes) {
    $("#txt_documento_reembolso").val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir el documento",
      text: "¡El documento no debe pesar más de " + maxSizeMB + "MB!",
      confirmButtonText: "¡Cerrar!",
    });
  }
});

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
  $("#cbm_nombre_colaborador").empty();
  $("#cbm_nombre_colaborador").append(
    "<option value=''>SIN REGISTROS</option>"
  );
  $("#cbm_nombre_paciente").empty();
  $("#cbm_nombre_paciente").append("<option value=''>SIN REGISTROS</option>");
  $("#txt_fecha_atencion").val("");
  $("#txt_valor_presentado").val("");
  $("#txt_diagnostico").val("");
  $("#txt_documento_reembolso").val("");
}

/*=============================================
  RECARGAR ETIQUETAS LISTAR OBSERVACIONES
  =============================================*/
function listarDatosReembolso() {
  var listaDatosReembolso = [];

  var nombre_colaborador = $(".cbm_nombre_colaborador");
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
      nombre_colaborador: $(nombre_colaborador[i]).val().toUpperCase(),
      nombre_paciente: $(nombre_paciente[i]).val().toUpperCase(),
      fecha_atencion: $(fecha_atencion[i]).val(),
      valor_presentado: $(valor_presentado[i]).val(),
      diagnostico: diagnostico_valor,
    });
  }

  $("#listaDatosReembolso").val(JSON.stringify(listaDatosReembolso));
}

/*=============================================
  ACTUALIZAR LISTADO DATOS REEMBOLSO
  =============================================*/

$(".nuevoDatosReembolso").on(
  "change",
  "select.cbm_nombre_colaborador",
  function () {
    cargar_lista_pacientes();
    listarDatosReembolso();
  }
);

$(".nuevoDatosReembolso").on(
  "change",
  "select.cbm_nombre_paciente",
  function () {
    listarDatosReembolso();
  }
);

$(".nuevoDatosReembolso").on("keyup", "input.fecha_atencion", function () {
  listarDatosReembolso();
});

$(".nuevoDatosReembolso").on("keyup", "input.valor_presentado", function () {
  listarDatosReembolso();
});

$(".nuevoDatosReembolso").on(
  "keyup",
  "textarea.diagnostico_reembolso",
  function () {
    listarDatosReembolso();
  }
);

/*=============================================
  LISTAR CONTRATOS EXISTENTES
  =============================================*/

$(".fecha_atencion").change(function () {
  $("#txt_contrato_aplicar").val("");
  $("#txt_idBayer").val("");
  $("#txt_idContrato").val("");
  $("#txt_nombre_paciente").val("");
  $("#cbm_nombre_paciente").empty();
  $("#cbm_nombre_paciente").append("<option value=''>SIN REGISTROS</option>");
  $("#txt_valor_presentado").val("");
});

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
  fecha = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();

  var fecha_actual = $("#txt_fecha_atencion").val();

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
      "controller/contratos-clientes-empresariales/controlador_contrato_cliente_asistencia_medica_individual_listar_seleccionar.php?fecha=" +
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
        var nombre_colaborador = data[i]["nombre_colaborador"];
        var nombre_paciente = data[i]["nombre_paciente"];
        var fecha_atencion = data[i]["fecha_atencion"];
        var valor_presentado = data[i]["valor_presentado"];
        var diagnostico = data[i]["diagnostico"];

        if (
          nombre_colaborador.length == 0 ||
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

var numObservacion = 0;
/*********************************
 ABRIR MODAL OBSERVACIONES REEMBOLSO
 *********************************/
$("#tabla-listar-reembolsos-asistencia-medica-individual").on(
  "click",
  ".btnVerObservaciones",
  function () {
    $("#modalObservaciones").modal({ backdrop: "static", keyboard: false });
    $("#modalObservaciones").modal("show");

    numObservacion = 0;

    $("#todoObservaciones").empty();

    var idReembolso = $(this).attr("idReembolso");

    var datos = new FormData();

    datos.append("idReembolso", idReembolso);

    $.ajax({
      url: "controller/reembolsos-clientes-empresariales/controlador_observacion_reembolso_adicionales_listar.php",
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
  ".btnVerDocumentoLiquidacion",
  function () {
    var documentoRuta = $(this).attr("ruta");
    window.open(documentoRuta, "Documento", "width=1024,height=1024");
  }
);
