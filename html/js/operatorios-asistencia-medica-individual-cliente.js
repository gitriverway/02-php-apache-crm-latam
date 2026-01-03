$(document).on("hidden.bs.modal", function (event) {
  if ($(".modal:visible").length) {
    $("body").addClass("modal-open");
  }
});

//  function lista1(){

//   var f=new Date();
//     fecha=(f.getFullYear()+'-'+f.getMonth()+'-'+f.getDate());

//     var fecha_actual = $("#txt_fecha_operacion").val();

//     if (fecha_actual == "") {
//       fecha_envio = fecha;
//     } else {
//       fecha_envio = fecha_actual;
//     }

//     $.ajax({

//         url:"controller/contratos-clientes/controlador_contrato_cliente_asistencia_medica_individual_listar_seleccionar.php?fecha="+fecha_envio,
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
function listar_operatorios_cliente_asistencia_medica_individual() {
  table_listar_operatorios_asistencia_medica_individual = $(
    "#tabla-listar-operatorios-asistencia-medica-individual"
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
    ajax: "controller/operatorios-clientes/controlador_operatorio_cliente_asistencia_medica_individual_listar.php",
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
    },
    language: idioma_espanol,
  });
}

/*=============================================
  LISTAR CONTRATOS EXISTENTES
  =============================================*/

$(".fecha_operacion").change(function () {
  $("#txt_contrato_aplicar").val("");
  $("#txt_idBayer").val("");
  $("#txt_idContrato").val("");
  $("#txt_nombre_paciente").val("");
  $("#cbm_nombre_paciente").empty();
  $("#cbm_nombre_paciente").append("<option value=''>SIN REGISTROS</option>");
  $("#txt_lugar_hospitalario_operatorio").val("");
  // $("#txt_valor_presentado_operatorio").val("");
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
  fecha = f.getFullYear() + "-" + f.getMonth() + "-" + f.getDate();

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
      [5, 10, 25, 50, 100, -1],
      [5, 10, 25, 50, 100, "All"],
    ],
    pageLength: 5,
    destroy: true,
    async: false,
    processing: true,
    ajax:
      "controller/contratos-clientes/controlador_contrato_cliente_asistencia_medica_individual_listar_seleccionar.php?fecha=" +
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
  $("#txt_idContrato").val("");
  $("#txt_contrato_aplicar").val("");
  $("#cbm_nombre_paciente").empty();
  $("#cbm_nombre_paciente").append("<option value=''>SIN REGISTROS</option>");
  $("#txt_fecha_operacion").val("");
  $("#txt_lugar_hospitalario_operatorio").val("");
  // $("#txt_valor_presentado_operatorio").val("");
  $("#txt_diagnostico_operatorio").val("");
  $("#txt_lugar_procedimiento_operatorio").val("");
  $("#txt_fecha_procedimiento_operatorio").val("");
  $("#txt_documento_operatorio").val("");
}

/*=============================================
  RECARGAR ETIQUETAS LISTAR OBSERVACIONES
  =============================================*/
function listarDatosOperatorio() {
  var listaDatosOperatorio = [];

  var nombre_paciente = $(".cbm_nombre_paciente");
  var fecha_atencion = $(".fecha_operacion");
  // var valor_presentado = $(".valor_presentado");
  var lugar_hospitalario = $(".lugar_hospitalario");
  var diagnostico = $(".diagnostico_operatorio");
  var lugar_procedimiento = $(".lugar_procedimiento_operatorio");
  var fecha_procedimiento_operatorio = $(".fecha_procedimiento_operatorio");

  for (var i = 0; i < nombre_paciente.length; i++) {
    listaDatosOperatorio.push({
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
        var nombre_paciente = data[i]["nombre_paciente"];
        var fecha_atencion = data[i]["fecha_atencion"];
        var valor_presentado = data[i]["valor_presentado"];
        var lugar_hospitalario = data[i]["lugar_hospitalario"];
        var diagnostico = data[i]["diagnostico"];
        var lugar_procedimiento = data[i]["lugar_procedimiento"];
        var fecha_procedimiento_operatorio =
          data[i]["fecha_procedimiento_operatorio"];

        if (
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
    url: "controller/operatorios-clientes/controlador_operatorio_asistencia_medica_individual_registro.php",
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

var numObservacion = 0;
/*********************************
 ABRIR MODAL OBSERVACIONES REEMBOLSO
 *********************************/
$("#tabla-listar-operatorios-asistencia-medica-individual").on(
  "click",
  ".btnVerObservaciones",
  function () {
    $("#modalObservaciones").modal({ backdrop: "static", keyboard: false });
    $("#modalObservaciones").modal("show");

    numObservacion = 0;

    $("#todoObservaciones").empty();

    var idOperatorio = $(this).attr("idOperatorio");

    var datos = new FormData();

    datos.append("idOperatorio", idOperatorio);

    $.ajax({
      url: "controller/operatorios-clientes/controlador_observacion_operatorio_adicionales_listar.php",
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
  ".btnVerDocumentoAutorizacion",
  function () {
    var documentoRuta = $(this).attr("ruta");
    window.open(documentoRuta, "Documento", "width=1024,height=1024");
  }
);
